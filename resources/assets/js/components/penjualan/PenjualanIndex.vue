<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Penjualan</li>
		</ul>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel-heading">
							<div class="table-responsive">
								<table class="table table-striped">
									<tbody v-if="penjualans.length > 0 && loading == false" class="data-ada">
										<tr v-for="penjualan ,index in penjualans">
											<td class="nav-link">{{kategoriproduk.$kategori_produk}}</td>
										</tr>
									</tbody>
									<tbody v-else-if="loading == true" class="data-ada">
										<tr>
											<td colspan="4" class="text-center">Sedang memuat</td>
										</tr>	
									</tbody>
									<tbody v-else class="tidak-ada-data">
										<tr>
											<td colspan="4"  class="text-center">
												Tidak Ada Data
											</td>
										</tr>
									</tbody>
								</table>
								<vue-simple-spinner v-if="loading"></vue-simple-spinner>
								<div align="right">
									<pagination :data="penjualansData" v-on:pagination-change-page="getPenjualans"></pagination>
								</div>
							</div>
						</div>
					</div>
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
			penjualans: [],
			penjualansData: {},
			url : window.location.origin + (window.location.pathname).replace("home", "penjualan"),
			loading : true
		}
	},

	mounted() {
		var app = this;
		app.getPenjualans();
	},
	methods: {
		getPenjualans(page) {
			var app = this;
			if (typeof page === 'undefined') {
				page = 1;
			}

			axios.get(app.url+'/view?page='+page)
			.then(function (resp) {
				app.penjualans = resp.data.data;
				app.penjualansData = resp.data;
				app.loading = false;
			})
			.catch(function (resp) {
				alert("Could not load penjualans");
				app.loading = false
			});
		},
	}
}
</script>