<template >
	<div>
		<currency-overview
			v-for="(currency, index) in currencies"
			v-bind:currency="currency"
			v-bind:index="index"
			v-bind:key="index">
		</currency-overview>
		<div id="last-update" class="col-md-12">Last Update: {{lastUpdate}}</div>
	</div>
</template>

<script>
import CurrencyOverview from './CurrencyOverview.vue'

export default {
	name: 'CurrencyList',
	props: ['currencies', 'lastUpdate'],
	components: {
		CurrencyOverview
	},
}
</script>

<style>

</style>
