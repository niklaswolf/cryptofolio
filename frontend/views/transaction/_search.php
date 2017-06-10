<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transactions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transaction_id') ?>

    <?= $form->field($model, 'from_currency_id') ?>

    <?= $form->field($model, 'to_currency_id') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'exchange_btc') ?>

    <?php // echo $form->field($model, 'exchange_btc_eur') ?>

    <?php // echo $form->field($model, 'value_eur') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
