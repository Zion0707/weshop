import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const state = {
	//菜单聚焦
	menu:{
		currentNum:0
	}
}
const getters = {
	menu: state => {
		return state.menu ;
	}	
}
const mutations = {

}
const actions = {

}

export default new Vuex.Store({
 	state:state,
 	mutations:mutations,
    getters:getters,
    actions:actions
});
