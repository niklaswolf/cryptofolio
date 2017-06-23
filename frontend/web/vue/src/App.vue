<template>
  <div id="app">
  	<navigation></navigation>
  	<router-view></router-view>
  </div>
</template>

<script>
import Navigation from './Navigation.vue'

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
		Navigation
	},
}
</script>

<style>
	#navigation {
		margin-bottom: 1em;
	}
</style>
