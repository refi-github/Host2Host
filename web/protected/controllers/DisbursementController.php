<?php

namespace app\controllers;

use Yii;
use app\models\Disbursement;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * DisbursementController implements the CRUD actions for Disbursement model.
 */
class DisbursementController extends Controller
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

    /**
     * Lists all Disbursement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $params = [
            'partner_id' => Yii::$app->request->get('partner_id'),
            'debtor_name' => Yii::$app->request->get('debtor_name'),
            'application_number' => Yii::$app->request->get('application_number'),
            'contract_number' => Yii::$app->request->get('contract_number'),
            'disbursement_date_from' => Yii::$app->request->get('disbursement_date_from'),
            'disbursement_date_until' => Yii::$app->request->get('disbursement_date_until'),
        ];

        $totalModel = Disbursement::countAll($params);

        $pagination = new Pagination([
            'totalCount' => $totalModel,
            'pageSize' => Disbursement::PAGE_SIZE,
            'pageSizeParam' => false,
        ]);

        $params = array_merge($params, [
            'offset' => $pagination->offset,
            'limit' => $pagination->limit,
        ]);

        $models = Disbursement::getAll($params);

        return $this->render('index', [
            'models' => $models,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Disbursement model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Disbursement::getById($id),
        ]);
    }
}
