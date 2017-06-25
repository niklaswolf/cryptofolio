<template>
  <div id="transactions" class="wrapper">
  	<h1>Transactions</h1>
  	<table class="table table-hover">
  		<thead>
	  		<tr>
	  			<th>Transaction ID</th>
	  			<th>From Currency</th>
	  			<th>Amount From</th>
	  			<th>To Currency</th>
	  			<th>Amount To</th>
	  			<th>Exchange BTC</th>
	  			<th>Exchange BTC/EUR</th>
	  			<th>Value EUR</th>
	  			<th>Timestamp</th>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		<transaction 
	  			v-for="transaction in transactions"
	  			v-bind:transaction="transaction"
	  			:key="transaction.transaction_id"
	  		>
	  		</transaction>
	  	</tbody>
  	</table>
  </div>
</template>

<script>
import Transaction from './Transaction.vue';

export default {
	name: 'Transactions',
	data () {
		return {
			transactions: {},
		}
	},
	components: {
		Transaction,
	},
	mounted: function(){
		// get data every 60s
		this.getData();
	},
	methods: {
		getData: function(){
			console.log("Fetching transaction data!");
			fetch('http://localhost/cryptofolio/frontend/web/index.php?r=transaction/data')
				.then(response => {
					if(!response.ok){
						//this.$store.commit('setOnline', false);
						alert("Error in transaction-API-fetch!");
						return Promise.reject("Error");
					}
					this.$store.commit('setOnline', true);
					return response;
				})
				.then(response => response.json())
				.then(res => {
				    this.transactions = res;
				})
				.catch(err => {
					this.$store.commit('setOnline', false);
			    });
		},
	}
}
</script>

<style>
</style>
