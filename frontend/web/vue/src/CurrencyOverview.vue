<template >
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

<script>
export default {
	name: 'CurrencyOverview',
	props: ['currency']
}
</script>

<style>

</style>
