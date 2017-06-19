<template>
  <div id="app">
  	<div id="overall" class="col-xs-12 col-md-3 col-md-push-9">
  		<overall
  			v-bind:data="overallData">
  		</overall>
  	</div>
  	<div id="currencies" class="col-xs-12 col-md-9 col-md-pull-3">
  		<currency-list
  			v-bind:currencies="currencies"
  			v-bind:lastUpdate="lastUpdate">
  		</currency-list>
  	</div>
  </div>
</template>

<script>
import CurrencyList from './CurrencyList.vue'
import Overall from './Overall.vue'

export default {
	name: 'app',
	data () {
		return {
			msg: 'Welcome to Your Vue.js App',
			currencies: {},
			overallData: {},
			lastUpdate: ""
		}
	},
	components: {
		CurrencyList,
		Overall
	},
	mounted: function(){
		// get data every 60s
		this.getData();
		setInterval(this.getData.bind(this), 60*1000);
	},
	methods: {
		getData: function(){
			console.log("Fetching data!");
			fetch('http://localhost/cryptofolio/frontend/web/index.php?r=site/currencies')
				.then(response => response.json())
				.then(res => {
				    this.processData(res);
				    this.currencies =  res;
				    var d = new Date();
				    
				    this.lastUpdate = d.toLocaleDateString()+", "+d.toLocaleTimeString();
				})
				.catch(err => {
					alert("Error while querying the API. Error: " + err);
			        console.error('An error ocurred', err);
			    });
		},
		processData: function (data){
			var valueBTC = 0;
			var valueEUR = 0;
			var euroAmount = 0;
			data.forEach((item, index) => {
				valueBTC += item.value_btc;
				valueEUR += item.value_eur;
				
				if(item.name == "Euro"){
					euroAmount = item.amount;
				}
			})
			
			var roundEuro = function (value){
				return Math.round(value*100) / 100;
			};
			
			this.overallData = {
				value_btc: valueBTC,
				value_eur: roundEuro (valueEUR),
				investment: roundEuro(-euroAmount),
				profit: roundEuro (valueEUR + euroAmount)
			}
		}
	}
}
</script>

<style>
	#overall {
		background: #444;
		color: #eee;
		padding: 1em;
	}
	#last-update {
		text-align: right;
	}
	.positive {
		color: #fff;
		background: green;
		padding: 0 6px;
		border-radius: 10px;
	}
	.negative {
		color: #fff;
		background: red;
		padding: 0 6px;
		border-radius: 10px;
	}
</style>
