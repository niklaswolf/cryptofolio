<template>
	<nav id="navigation" class="nav nav-pills">
		<li><router-link to="/">Dashboard</router-link></li>
		<li><router-link to="/currencies">Currencies</router-link></li>
		<li><router-link to="/transactions">Transactions</router-link></li>
	</nav>
</template>

<script>
export default {
	name: 'Navigation',
}
</script>

<style>
</style>