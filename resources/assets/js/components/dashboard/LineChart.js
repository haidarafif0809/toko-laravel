import VueChartJs from 'vue-chartjs'
window.Vue = require('vue');
window.Vue.use(VueChartJs)
export default {
	extends: VueChartJs.Line,
	props: ['data', 'options'],
	mixins: [VueChartJs.mixins.reactiveProp],
	data() {
		return {
			url : window.location.origin+(window.location.pathname).replace("home","laporan"),
		}
	},
	mounted() {
		this.renderChart(this.data, {responsive: true, maintainAspectRatio: false});
	},
}
