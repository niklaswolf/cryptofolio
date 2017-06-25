<template>
	<tr>
		<td>{{transaction.transaction_id}}</td>
		<td>{{getCurrencyName(transaction.from_currency_id)}}</td>
		<td>{{transaction.amount_from}}</td>
		<td>{{getCurrencyName(transaction.to_currency_id)}}</td>
		<td>{{transaction.amount_to}}</td>
		<td>{{transaction.exchange_btc}}</td>
		<td>{{transaction.exchange_btc_eur}}</td>
		<td>{{transaction.value_eur}}</td>
		<td>{{transaction.timestamp}}</td>
	</tr>
</template>

<script>

export default {
	name: 'Transaction',
	props: ['transaction'],
	mounted: function(){
	},
	methods: {
		getCurrencyName : function(currencyId){
			var name = "";
			var currencies = this.$store.state.currencies;
			// loop over currencies to find name
			Object.keys(currencies).forEach(function(key) {
				if(currencyId == currencies[key].id){
					name = currencies[key].name;
				}
			}, this);
			return name;
		}
	}
}
</script>

<style>
</style>
