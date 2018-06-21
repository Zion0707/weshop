import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
	routes: [
		{
			path: '/',
			component: resolve => require(['@/components/index/index.vue'], resolve) ,
			children:[
				{
					path:'/recommend',
					component: resolve => require(['@/components/index/recommend.vue'], resolve)
				}
			]
		},
		{
			path: '/class',
			component: resolve => require(['@/components/class/index.vue'], resolve)
		},
		{
			path: '/cart',
			component: resolve => require(['@/components/cart/index.vue'], resolve) 
		},
		{
			path: '/my',
			component: resolve => require(['@/components/my/index.vue'], resolve)
		}
	]
})
