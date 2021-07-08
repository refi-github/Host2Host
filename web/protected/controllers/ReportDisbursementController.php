<?php

namespace app\controllers;

use Yii;
use app\models\Disbursement;
use app\models\Partner;
use app\models\User;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii2tech\spreadsheet\Spreadsheet;
use yii\data\ArrayDataProvider;

class ReportDisbursementController extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest || !User::findIdentityByAccessToken(Yii::$app->user->identity->access_token)) {
            return $this->redirect(['login/index']);
        }

        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->request->post('partner_id') == '' 
            || Yii::$app->request->post('date_from') == '' 
            ||  Yii::$app->request->post('date_until') == '') {
            return $this->render('index');
        }

        $partner = Partner::findOne([
            'id' => Yii::$app->request->post('partner_id')
        ]);
        if ($partner == null) {
            Yii::$app->session->setFlash('alert', '<div class="alert alert-danger">Mitra tidak ditemukan</div>');
            return $this->render('index');
        }

        $params = [
            'partner_id' => Yii::$app->request->post('partner_id'),
            'date_from' => Yii::$app->request->post('date_from'),
            'date_until' => Yii::$app->request->post('date_until'),
        ];

        $models = Disbursement::getReportDisbursement($params);
        if ($models == null) {
            Yii::$app->session->setFlash('alert', '<div class="alert alert-danger">Data tidak ditemukan</div>');
            return $this->render('index');
        }

        $exporter = new Spreadsheet([
            'title' => 'Disbursement',
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $models,
            ]),
        ]);

        $filename = 'Disbursement ' . Yii::$app->request->post('date_from') . ' s.d ' . Yii::$app->request->post('date_until') . '.xlsx';

        return $exporter->send($filename);
    }
}
