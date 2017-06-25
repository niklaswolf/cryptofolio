<template>
  <div id="app">
  	<navigation></navigation>
  	<router-view></router-view>
  	<div class="overlay" v-if="!this.$store.state.online">Application is offline! Try to connect!</div>
  </div>
</template>

<script>
import Navigation from './Navigation.vue'

export default {
	name: 'app',
	components: {
		Navigation
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
				.then(response => {
					if(!response.ok){
						//this.$store.commit('setOnline', false);
						alert("Error in API-fetch!");
						return Promise.reject("Error");
					}
					this.$store.commit('setOnline', true);
					return response;
				})
				.then(response => response.json())
				.then(res => {
				    this.processData(res);
				    this.$store.commit('updateCurrencies', res);
				    
				    var d = new Date();
				    var lastUpdate = d.toLocaleDateString()+", "+d.toLocaleTimeString();
				    this.$store.commit('updateLastUpdate', lastUpdate);
				})
				.catch(err => {
					this.$store.commit('setOnline', false);
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
			
			var overallData = {
				value_btc: valueBTC,
				value_eur: roundEuro (valueEUR),
				investment: roundEuro(-euroAmount),
				profit: roundEuro (valueEUR + euroAmount)
			}
			this.$store.commit('updateOverall', overallData);
		}
	}
}
</script>

<style>
	#navigation {
		margin-bottom: 1em;
	}
	.overlay {
		width: 100vw;
		height: 100vh;
		background: rgba(0,0,0,0.6);
		position: absolute;
		top: 0;
		left: 0;
		color: #eee;
		font-size: 2em;
		text-align: center;
	}
	.wrapper {
		padding: 0 5%;
	}
	.flexbox {
		display: -webkit-flex;
		display: flex;
		-webkit-flex-wrap: wrap;
		flex-wrap: wrap;
	}
</style>
