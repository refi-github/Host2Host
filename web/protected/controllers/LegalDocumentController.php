<?php

namespace app\controllers;

use Yii;
use app\models\LegalDocument;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * LegalDocumentController implements the CRUD actions for LegalDocument model.
 */
class LegalDocumentController extends Controller
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
     * Lists all LegalDocument models.
     * @return mixed
     */
    public function actionIndex()
    {
        $totalModel = LegalDocument::countAll();

        $pagination = new Pagination([
            'totalCount' => $totalModel,
            'pageSize' => LegalDocument::PAGE_SIZE,
            'pageSizeParam' => false,
        ]);

        $params = [
            'offset' => $pagination->offset,
            'limit' => $pagination->limit,
        ];

        $models = LegalDocument::getAll($params);

        return $this->render('index', [
            'models' => $models,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single LegalDocument model.
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
     * Creates a new LegalDocument model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LegalDocument();

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
     * Updates an existing LegalDocument model.
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
     * Deletes an existing LegalDocument model.
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
     * Finds the LegalDocument model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LegalDocument the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LegalDocument::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
