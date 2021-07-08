<?php

namespace app\controllers;

use Yii;
use app\models\Aging;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AgingController implements the CRUD actions for Aging model.
 */
class AgingController extends Controller
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
     * Lists all Aging models.
     * @return mixed
     */
    public function actionIndex()
    {
        $params = [
            'partner_id' => Yii::$app->request->get('partner_id'),
            'debtor_name' => Yii::$app->request->get('debtor_name'),
            'application_number' => Yii::$app->request->get('application_number'),
            'contract_number' => Yii::$app->request->get('contract_number'),
        ];

        $totalModel = Aging::countAll($params);

        $pagination = new Pagination([
            'totalCount' => $totalModel,
            'pageSize' => Aging::PAGE_SIZE,
            'pageSizeParam' => false,
        ]);

        $params = array_merge($params, [
            'offset' => $pagination->offset,
            'limit' => $pagination->limit,
        ]);

        $models = Aging::getAll($params);

        return $this->render('index', [
            'models' => $models,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Aging model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Aging::getById($id),
        ]);
    }
}
