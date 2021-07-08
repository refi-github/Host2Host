<?php

namespace app\controllers;

use Yii;
use app\models\Partner;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use thamtech\uuid\helpers\UuidHelper;

/**
 * PartnerController implements the CRUD actions for Partner model.
 */
class PartnerController extends Controller
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
     * Lists all Partner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $params = [
            'name' => Yii::$app->request->get('name'),
        ];

        $totalModel = Partner::countAll($params);

        $pagination = new Pagination([
            'totalCount' => $totalModel,
            'pageSize' => Partner::PAGE_SIZE,
            'pageSizeParam' => false,
        ]);

        $params = array_merge($params, [
            'offset' => $pagination->offset,
            'limit' => $pagination->limit,
        ]);

        $models = Partner::getAll($params);

        return $this->render('index', [
            'models' => $models,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Partner model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Partner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Partner();

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('alert', '<div class="alert alert-success">Data berhasil disimpan</div>');

            $model->secret_key = UuidHelper::uuid();
            $model->generatePrefix();
            $currentDate = new \DateTime();
            $model->created_at = $currentDate->format('Y-m-d H:i:s');
            if (!$model->save()) {
                Yii::$app->session->setFlash('alert', '<div class="alert alert-danger">Data gagal disimpan</div>');
            }

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Partner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('alert', '<div class="alert alert-success">Data berhasil disimpan</div>');

            $currentDate = new \DateTime();
            $model->updated_at = $currentDate->format('Y-m-d H:i:s');
            if (!$model->save()) {
                Yii::$app->session->setFlash('alert', '<div class="alert alert-danger">Data gagal disimpan</div>');
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Partner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->session->setFlash('alert', '<div class="alert alert-success">Data berhasil dihapus</div>');
        if (!$this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('alert', '<div class="alert alert-gagal">Data gagal dihapus</div>');
        }
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Partner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Partner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Partner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
