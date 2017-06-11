<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transactions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Transactions'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'transaction_id',
        	[
        		'attribute' => 'timestamp',
        		'format' => 'date',
        		'label' => "Date"
    		],
        	[
        		'attribute' => 'fromCurrency.name',
        		'label' => "From",
    		],
        	'amount_from',
        	[
        		'attribute' => 'toCurrency.name',
        		'label' => "To",
        	],
            'amount_to',
            'exchange_btc',
            'exchange_btc_eur',
            'value_eur',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
