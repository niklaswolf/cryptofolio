<template >
	<div class="col-md-6 currency">
		<div class="head">
			<h2 class="title">{{ currency.name }} ({{ currency.symbol }})</h2>
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
		</div>
  		<div class="body">
	  		<div class="price">
	  			<div class="section-head">Price</div>
	  			<div class="price-btc">{{ currency.price_btc }} BTC</div>
	  			<div class="price-eur">{{ currency.price_eur }} €</div>
	  		</div>
	  		
	  		<div class="amount">
	  			<div class="section-head">Amount</div>
	  			<div class="amount-currency">{{ currency.amount }}</div>
	  		</div>
	  		
	  		<div class="value">
	  			<div class="section-head">Value</div>
	  			<div class="amount-btc">{{ currency.value_btc }} BTC</div>
	  			<div class="value-eur">{{ currency.value_eur }} €</b>
	  		</div>
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
	.currency .title {
	    background: #999;
	    color: #f9f9f9;
	    padding: 0.1em 0.2em;
	    margin-bottom: 0;
	    border-bottom: #f9f9f9 2px solid;
	}
	.currency .changes {
	    margin: 0 0 0.2em;
	    font-size: .9em;
	    padding: 2px 5px;
	}
	.currency .section-head {
	    font-weight: 300;
	    font-size: .9em;
	    line-height: 1;
	    flex-basis: 100%;
	}
	
	.currency .body {
		color: #7e7e7e;
	    font-weight: 300;
	}
	.price {
	    margin-top: 0.5em;
	}
	.price-btc {
	    font-size: 1.6em;
	    line-height: 1;
	}
	.price-eur {
		font-size: 1.1em;
	}
	
	.amount {
	    margin-top: 0.5em;
	}
	
	.value {
	    margin-top: .5em;
	    display: -webkit-flex;
	    display: flex;
	    -webkit-flex-wrap: wrap;
	    flex-wrap: wrap;
	    -webkit-justify-content: space-between;
	    justify-content: space-between;
	}
</style>
