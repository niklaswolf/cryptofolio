<template >
	<div class="col-md-6 currency">
  		<h2>{{ currency.name }} ({{ currency.symbol }})</h2>
  		<div class="changes">
  			<span>24h: 
  				<span v-bind:class="[isPositive(currency.percent_change_24h) ? 'positive' : 'negative']">
  					{{currency.percent_change_24h}}%
  				</span>
  			</span>, 
  			<span>7d: 
  				<span v-bind:class="[isPositive(currency.percent_change_7d) ? 'positive' : 'negative']">
  					{{currency.percent_change_7d}}%
  				</span>
  			</span>
  		</div>
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
	props: ['currency'],
	methods: {
		isPositive: function(value){
			return (value >= 0);
		}
	},
}
</script>

<style>
	.currency .changes {
		margin: -0.5em 0 1em 0;
		font-size: 0.9em;
	}
</style>
