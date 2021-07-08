<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Application;
use app\models\Debtor;
use app\models\Partner;

class ApplicationController extends Controller
{
    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $model = new Application();
        $modelData['Application'] = Yii::$app->request->post();
        $model->load($modelData);

        $partner =  Partner::getBySecretKey(Yii::$app->request->post('secret_key'));
        if ($partner == null) {
            return [
                'message' => 'authentication failed',
            ];
        }

        if (!Debtor::checkIfExists($partner->id, $model->debtor_number)) {
            return [
                'message' => 'debtor not found',
            ];
        }

        if (Application::checkIfExists($partner->id, $model->application_number)) {
            return [
                'message' => $model->application_number . ' already exists',
            ];
        }

        $model->partner_id = $partner->id;
        $model->status = Application::STATUS_APPROVED;

        $currentDate = new \DateTime();
        $model->created_at = $currentDate->format('Y-m-d H:i:s');        
        if (!$model->save()) {
            return [
                'message' => 'an error occurred while processing data',
            ];
        }

        return [
            'message' => 'data is successfully saved',
        ];
    }
}
