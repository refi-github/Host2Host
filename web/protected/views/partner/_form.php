<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Partner;
use app\models\BusinessScope;
use app\models\FinancialPerformance;

?>

<div class="partner-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-md-6">
    		<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'identity_number')->textInput(['maxlength' => true]) ?>
    	</div>
        <div class="col-md-6">
            <?= $form->field($model, 'addm_addb')->textInput(['maxlength' => true]) ?>
        </div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'establishment_number')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'establishment_place')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'establishment_date')->textInput([
    			'maxlength' => true, 
    			'class' => 'form-control datepicker', 
    			'autocomplete' => 'off',
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'last_change_number')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'last_change_date')->textInput([
    			'maxlength' => true, 
    			'class' => 'form-control datepicker', 
    			'autocomplete' => 'off',
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'financing_type')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'financing_scheme')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'cellphone_number')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'address')->textarea(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'sub_district')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'zip_code')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'country_code')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'business_field_code')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'reporter_relationship_code')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'go_public')->radioList([
    			Partner::GO_PUBLIC => 'YA', 
    			Partner::NOT_GO_PUBLIC => 'TIDAK', 
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'debtor_class_code')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'debtor_rating')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'rating_agency')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'rating_date')->textInput([
    			'maxlength' => true, 
    			'class' => 'form-control datepicker', 
    			'autocomplete' => 'off',
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'debtor_business_group')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'branch_office_code')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'fund_management_amount')->textInput([
    			'type' => 'number', 
    			'maxlength' => true,
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'interest_type')->radioList([
    			Partner::INTEREST_TYPE_ANNUITY => 'ANUITAS', 
    			Partner::INTEREST_TYPE_FLAT => 'FLAT', 
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'margin_percentage')->textInput([
    			'type' => 'number', 
    			'step' => 'any', 
    			'maxlength' => true,
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'start_date')->textInput([
    			'maxlength' => true, 
    			'class' => 'form-control datepicker', 
    			'autocomplete' => 'off',
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'end_date')->textInput([
    			'maxlength' => true, 
    			'class' => 'form-control datepicker', 
    			'autocomplete' => 'off',
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'due_date')->textInput([
    			'maxlength' => true, 
    			'class' => 'form-control datepicker', 
    			'autocomplete' => 'off',
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'establishment_date_according_to_ahu')->textInput([
    			'maxlength' => true, 
    			'class' => 'form-control datepicker', 
    			'autocomplete' => 'off',
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'business_scope_id')->dropDownList(
    			ArrayHelper::map(BusinessScope::find()->all(), 'id', 'name'),
    			['prompt' => '- Pilih Ruang Lingkup Usaha -']
    		) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'registered_on_ojk')->radioList([
    			Partner::REGISTERED_ON_OJK => 'YA', 
    			Partner::NOT_REGISTERED_ON_OJK => 'TIDAK', 
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'percentage_share_ownership')->textInput([
    			'type' => 'number', 
    			'maxlength' => true,
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'well_known_company')->radioList([
    			Partner::WELL_KNOWN_COMPANY => 'YA', 
    			Partner::NOT_WELL_KNOWN_COMPANY => 'TIDAK', 
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'financial_performance_id')->dropDownList(
    			ArrayHelper::map(FinancialPerformance::find()->all(), 'id', 'name'),
    			['prompt' => '- Pilih Kinerja Keuangan -']
    		) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'minimum_loan_amount')->textInput([
    			'type' => 'number', 
    			'maxlength' => true,
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'maximum_loan_amount')->textInput([
    			'type' => 'number', 
    			'maxlength' => true,
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'status')->dropDownList(
    			Partner::getStatuses(),
    			['prompt' => '- Pilih Status -']
    		) ?>
    	</div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
