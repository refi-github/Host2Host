<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\LoginForm;

class LoginController extends \yii\web\Controller
{
    public $layout = '/login';

    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return parent::beforeAction($action);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionIndex()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->login()) {
                Yii::$app->session->setFlash('alert', '<div class="alert alert-danger">Username atau password salah</div>');
            }
            return $this->goHome();
        }
        
        $model->password = '';
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
