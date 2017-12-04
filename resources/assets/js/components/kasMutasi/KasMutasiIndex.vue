<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Kas Mutasi</li>
		</ul>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-body">
							<table class="table table-striped table-hover">
								<thead>
									<th>No Faktur</th>
									<th>Dari Kas</th>
									<th>Ke Kas</th>
									<th>Jumlah</th>
									<th>Keterangan</th>
								</thead>
								<tbody v-if="kasMutasis.length > 0 && loading ==false" class="data-ada">
									<tr v-for="kasMutasi, index in kasMutasis">
										<td>kasMutasi.kas_mutasi.kas_mutasi.id</td>
										<td>kasMutasi.kas_mutasi.dari_kas</td>
										<td>kasMutasi.kas_mutasi.ke_kas</td>
										<td>kasMutasi.kas_mutasi.jumlah</td>
										<td>kasMutasi.kas-mutasi.keterangan</td>
									</tr>
								</tbody>
								<tbody v-else-if="loading == true" class="data-ada" >
									<tr >
										<td colspan="4"  class="text-center">
											Sedang Memuat Data
										</td>
									</tr>
								</tbody>
								<tbody v-else class="data-tidak-ada">
									<tr>
										<td colspan="4" class="text-center">
											Tidak ada data
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<vue-simple-spinner v-if="loading"></vue-simple-spinner>
						<div align="right">
							<pagination :data="kasMutasisData" v-on:pagination-change-page="getItems"></pagination>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	data: function () {
		return {
			kasMutasis: [],
			kasMutasisData: {},
			url : window.location.origin+(window.location.pathname).replace("home", "kas-mutasi"),
			loading : true
		}
	},
	mounted() {
		var app = this;
		app.loading = true
		app.getItems();
	},
	methods: {
		getItems(page) {
			var app = this;
			if (typeof page === 'undefined') {
				page = 1;
			}
			axios.get(app.url+'/view?page='+page)
			.then(function (resp) {
				app.kasMutasis = resp.data.data;
				app.kasMutasisData = resp.data;
				app.loading = false;
                //console.log(resp.data.data)
            })
			.catch(function (resp) {
				alert("Could not load Kas Mutasis");
				app.loading = false
			});
		},
	}
}
</script>