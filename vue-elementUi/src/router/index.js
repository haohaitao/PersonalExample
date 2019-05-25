import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/home/Home'
import Sellcars from '@/pages/home/components/SellCars'
import Buycars from '@/pages/home/components/Buycars'
import Recruit from '@/pages/home/components/Recruit'
import Job from '@/pages/home/components/Job'
Vue.use(Router)

export default new Router({
	mode: 'history', //去掉连接上的井号 更美观一点
	base: '/water',  //线上使用history需要配合base使用
	routes: [
	{
		path: '/',
		name: 'Home',
		component: Home
	},
	{
		path: '/sellcars',
		name: 'Sellcars',
		component: Sellcars
	},
	{
		path: '/buycars',
		name: 'Buycars',
		component: Buycars
	},
	{
		path: '/recruit',
		name: 'Recruit',
		component: Recruit
	},
	{
		path: '/job',
		name: 'Job',
		component: Job
	}
	]
})
