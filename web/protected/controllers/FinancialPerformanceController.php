<?php

namespace app\controllers;

use Yii;
use app\models\FinancialPerformance;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * FinancialPerformanceController implements the CRUD actions for FinancialPerformance model.
 */
class FinancialPerformanceController extends Controller
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
     * Lists all FinancialPerformance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $totalModel = FinancialPerformance::countAll();

        $pagination = new Pagination([
            'totalCount' => $totalModel,
            'pageSize' => FinancialPerformance::PAGE_SIZE,
            'pageSizeParam' => false,
        ]);

        $params = [
            'offset' => $pagination->offset,
            'limit' => $pagination->limit,
        ];

        $models = FinancialPerformance::getAll($params);

        return $this->render('index', [
            'models' => $models,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single FinancialPerformance model.
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
     * Creates a new FinancialPerformance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FinancialPerformance();

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('alert', '<div class="alert alert-success">Data berhasil disimpan</div>');
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
     * Updates an existing FinancialPerformance model.
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
     * Deletes an existing FinancialPerformance model.
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
     * Finds the FinancialPerformance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FinancialPerformance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FinancialPerformance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
