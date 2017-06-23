import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
	state: {
		currencies: {},
		lastUpdate: "",
		online: false,
		overallData: {}
	},
	mutations: {
		updateCurrencies (state, payload) {
			state.currencies = payload;
		},
		updateOverall (state, payload) {
			state.overallData = payload;
		},
		updateLastUpdate (state, lastUpdate) {
			state.lastUpdate = lastUpdate;
		},
		setOnline (state, value){
			state.online = value;
		}
	}
})