<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Currencies;

/* @var $this yii\web\View */
/* @var $model common\models\Transactions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transactions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'from_currency_id')->dropDownList(
    		Currencies::find()->select('name')->indexBy('currency_id')->column(),
    		['prompt' => "Select currency"]
    	) ?>
    	
    <?= $form->field($model, 'amount_from')->textInput() ?>

    <?= $form->field($model, 'to_currency_id')->dropDownList(
    		Currencies::find()->select('name')->indexBy('currency_id')->column(),
    		['prompt' => "Select currency"]
    	) ?>

    <?= $form->field($model, 'amount_to')->textInput() ?>

    <?= $form->field($model, 'exchange_btc')->textInput() ?>

    <?= $form->field($model, 'exchange_btc_eur')->textInput() ?>

    <?= $form->field($model, 'value_eur')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
