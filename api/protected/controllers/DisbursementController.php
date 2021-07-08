<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Disbursement;
use app\models\Application;
use app\models\Partner;

class DisbursementController extends Controller
{
    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $model = new Disbursement();
        $modelData['Disbursement'] = Yii::$app->request->post();
        $model->load($modelData);

        $partner =  Partner::getBySecretKey(Yii::$app->request->post('secret_key'));
        if ($partner == null) {
            return [
                'message' => 'authentication failed',
            ];
        }

        if (!Application::checkIfExists($partner->id, $model->application_number)) {
            return [
                'message' => 'application not found',
            ];
        }

        if (Disbursement::checkIfExists($partner->id, $model->contract_number)) {
            return [
                'message' => $model->contract_number . ' already exists',
            ];
        }

        $model->partner_id = $partner->id;

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
