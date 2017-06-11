<?php

/* @var $this yii\web\View */

$this->title = 'Dashboard';

$this->registerJsFile(Yii::$app->request->baseUrl . "/js/vue.js", ['depends' => 'frontend\assets\AppAsset']);
?>
<div id="overall" class="col-xs-12 col-md-3 col-md-push-9">
	<h2>Kontostand</h2>
	<div> {{ value_btc }} BTC</div>
	<b>{{ value_eur }} €</b>
</div>
<div id="currencies" class="col-xs-12 col-md-9 col-md-pull-3">
    <template v-for="currency in currencies">
    	<div class="col-md-6">
    		<h2>{{ currency.name }} ({{ currency.symbol }})</h2>
    		<div>
    			<b>Exchange BTC: {{ currency.price_btc }}</b>
    			<div>Exchange Euro: {{ currency.price_eur }}</div>
    		</div>
    		<div>
    			<div>Amount: {{ currency.amount }}</div>
    			<div>Value BTC: {{ currency.value_btc }}</div>
    			<b>Value Euro: {{ currency.value_eur }}</b>
    		</div>
    	</div>
    	
    </template>
</div>

<style>
	#overall {
		background: #444;
		color: #eee;
		padding: 1em;
	}
</style>