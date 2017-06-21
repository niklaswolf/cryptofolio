<template>
	<div class="row overall-container">
		<div class="col-lg-3">Investment: {{data.investment}}&euro;</div>
		<div class="col-lg-3">Kontostand</div>
		<div class="col-lg-3"> 
			<div class="overall-btc">{{ data.value_btc }} BTC</div>
			<div class="overall-eur">{{ data.value_eur }} &euro;</div>
		</div>
		<div id="profit" class="col-lg-3">Profit: {{data.profit}} &euro; 
			<span v-bind:class="[isPositive(profitPercent()) ? 'positive' : 'negative']">
				{{profitPercent()}}%
			</span>
		</div>
	</div>
</template>

<script>
export default {
	name: 'Overall',
	props: ['data'],
	methods: {
		profitPercent: function(){
			var value = (this.data.value_eur/this.data.investment -1)*100;
			return value.toFixed(2);
		},
		isPositive: function(value){
			return (value >= 0);
		}
	}
}
</script>

<style>
	#profit {
		font-size: 1.1em;
		text-align: right;
	}
</style>