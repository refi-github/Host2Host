<?php

namespace app\controllers;

use Yii;
use app\models\Debtor;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * DebtorController implements the CRUD actions for Debtor model.
 */
class DebtorController extends Controller
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
     * Lists all Debtor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $params = [
            'partner_id' => Yii::$app->request->get('partner_id'),
            'debtor_number' => Yii::$app->request->get('debtor_number'),
            'name' => Yii::$app->request->get('name'),
            'id_card_number' => Yii::$app->request->get('id_card_number'),
        ];

        $totalModel = Debtor::countAll($params);

        $pagination = new Pagination([
            'totalCount' => $totalModel,
            'pageSize' => Debtor::PAGE_SIZE,
            'pageSizeParam' => false,
        ]);

        $params = array_merge($params, [
            'offset' => $pagination->offset,
            'limit' => $pagination->limit,
        ]);

        $models = Debtor::getAll($params);

        return $this->render('index', [
            'models' => $models,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Debtor model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Debtor::getById($id),
        ]);
    }
}
