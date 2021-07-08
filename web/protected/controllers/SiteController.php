<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Dashboard;
use app\models\Partner;
use app\models\User;

class SiteController extends Controller
{
    public $layout = '/main';

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest || !User::findIdentityByAccessToken(Yii::$app->user->identity->access_token)) {
            return $this->redirect(['login/index']);
        }

        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $partnerId = Yii::$app->request->get('partner_id');

        $partnerName = 'Mitra';
        if (Yii::$app->request->get('partner_id') != '') {
            $partner = Partner::findOne(['id' => $partnerId]);
            $partnerName = $partner->name;
        }

        $dashboard = Dashboard::getAll($partnerId);

        // Config Chart
        $categories = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'];
        $series = [
                [
                    'name' => 'Application',
                    'data' => $dashboard['monthlyChart']['applications'],
                ],
                [
                    'name' => 'Approval',
                    'data' => $dashboard['monthlyChart']['approvals'],
                ],
                [
                    'name' => 'Disbursement',
                    'data' => $dashboard['monthlyChart']['disbursements'],
                ],
            ];

        return $this->render('index', [
                'partnerName' => $partnerName,
                'dashboard' => $dashboard,
                'chart' => [
                    'categories' => $categories,
                    'series' => $series,
                ],
            ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['login/index']);
    }
}
