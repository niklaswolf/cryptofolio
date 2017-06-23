<template>
  <div id="dashboard" class="wrapper">
  	<div id="overall">
  		<overall
  			v-bind:data="this.$store.state.overallData">
  		</overall>
  	</div>
  	<div id="currencies">
  		<currency-list
  			v-bind:currencies="this.$store.state.currencies"
  			v-bind:lastUpdate="this.$store.state.lastUpdate">
  		</currency-list>
  	</div>
  </div>
</template>

<script>
import CurrencyList from './CurrencyList.vue'
import Overall from './Overall.vue'

export default {
	name: 'Dashboard',
	components: {
		CurrencyList,
		Overall
	},
	computed: {
		
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
	.wrapper {
		padding: 0 5%;
	}
	.flexbox {
		display: -webkit-flex;
		display: flex;
		-webkit-flex-wrap: wrap;
		flex-wrap: wrap;
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
