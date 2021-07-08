<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Partner;
use app\models\User;

?>

<style>
    #partner-area {
        display: none;
    }
</style>

<div class="User-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'role')->dropDownList(
		User::getRoles(),
		[
            'prompt' => '- Pilih Role -',
            'onchange' => 'showRole()',
        ]
	) ?>

    <div id="partner-area">
        <?= $form->field($model, 'partner_id')->dropDownList(
            ArrayHelper::map(Partner::find()->all(), 'id', 'name'),
            ['prompt' => '- Pilih Mitra -']
        ) ?>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
function showRole() {
  var userRole = document.getElementById("user-role");
  var partnerArea = document.getElementById("partner-area");

  if (userRole.value == <?= User::ROLE_PARTNER; ?>) {
    partnerArea.style.display = "block";
  } else {
    partnerArea.style.display = "none";
  }
}
</script>