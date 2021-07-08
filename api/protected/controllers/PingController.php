<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class PingController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'message' => 'Server is running',
        ];
    }

}
