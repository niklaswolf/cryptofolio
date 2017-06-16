<template>
	<div>
		<div>Investment: {{data.investment}}&euro;</div>
		<h2>Kontostand</h2>
		<div> {{ data.value_btc }} BTC</div>
		<b>{{ data.value_eur }} &euro;</b>
		<div id="profit">Profit: {{data.profit}} &euro;</div>
	</div>
</template>

<script>
export default {
	name: 'Overall',
	props: ['data']
}
</script>

<style>

</style>