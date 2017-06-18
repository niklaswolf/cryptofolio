<template>
	<div>
		<div>Investment: {{data.investment}}&euro;</div>
		<h2>Kontostand</h2>
		<div> {{ data.value_btc }} BTC</div>
		<b>{{ data.value_eur }} &euro;</b>
		<div id="profit">Profit: {{data.profit}} &euro; 
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
		margin-top: 1em;
		font-size: 1.1em;
	}
</style>