require('./bootstrap');

import Vue from 'vue'

import vSelect from 'vue-select'
import App from './App.vue'
import router from './router'
import bar from './components/progress'

router.beforeEach((to, from, next) => {
    bar.start()
    next()
});

Vue.component('v-select', vSelect);
Vue.filter('formatMoney', (value) => {
    return Number(value)
        .toFixed(2)
        .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
});

const app = new Vue({
	el: '#root',
	template: `<app></app>`,
	components: { App },
	router
});
