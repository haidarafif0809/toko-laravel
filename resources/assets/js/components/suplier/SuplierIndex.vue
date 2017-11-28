<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Suplier</li>
		</ul>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Table Suplier</p>
					</div>
					<div class="panel-body">
						<div class="tambah-suplier">
							<p>
								<router-link :to="{name: 'createSuplier'}" type="button" class="btn btn-primary">
									Tambah Suplier
								</router-link>
							</p>
						</div>
						<div class="pencarian">
							<input class="form-control" type="text" name="pencarian" v-model="pencarian" placeholder="pencarian..">
						</div>
						<table class="table table-striped">
							<thead>
								<th>Nama Suplier</th>
								<th>Alamat Suplier</th>
								<th>Nomer Telpon</th>
								<th>Aksi</th>
							</thead>
							<tbody v-if="supliers.length > 0 && loading == false" class="data-ada">
								<tr v-for="suplier , index in supliers">
									<td>{{suplier.nama_suplier}}</td>
									<td>{{suplier.alamat_suplier}}</td>
									<td>{{suplier.no_telp_suplier}}</td>
									<td>   <router-link :to="{name: 'editSuplier', params: {id: suplier.id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + suplier.id" >
										Edit 
									</router-link> 
									<a href="#"
									class="btn btn-xs btn-danger" 
									v-on:click="deleteEntry(suplier.id, index,suplier.nama_suplier)">
									Delete
								</a></td>
							</tr>
						</tbody>
						<tbody v-else class="data-tidak-ada">
							<tr>
								<td colspan="4" class="text-center">Data-tidak-ada</td>
							</tr>
						</tbody>
					</table>
				</div>
				<vue-simple-spinner v-if="loading"></vue-simple-spinner>
				<vue-simple-spinner v-if="loading"></vue-simple-spinner>
				<div align="right"><pagination :data="supliersData" v-on:pagination-change-page="getItems" v-if="pencarian == '' "></pagination></div>
				<div align="right"><pagination :data="supliersData" v-on:pagination-change-page="getsearchData" v-if="pencarian != '' "></pagination></div>
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
			supliers: [],
			supliersData: {},
			url : window.location.origin+(window.location.pathname).replace("home","suplier"),
			pencarian : '',
			loading : true

		}
	},

	watch: {
    // whenever question changes, this function will run
    pencarian: function (newQuestion) {
    	this.searchData()
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
			app.loading = false
			app.supliers = resp.data.data;
			app.SupliersData = resp.data

		})
		.catch(function (resp) {
			alert("Could not load suplier");
		});
	},
	searchData(page) {
		var app = this;
		app.loading = true;
		if (typeof page === 'undefined') {
			page = 1;
		}

		axios.get(app.url+'/search?pencarian='+app.pencarian+'&page='+page)
		.then(function (resp) {
			app.supliers = resp.data.data;
			app.supliersData = resp.data;
			app.loading = false    
		})
		.catch(function (resp) {
			alert("Tidak dapat memuat suplier..");
			app.loading = false;
		})
	},

	deleteEntry(id, index,nama_suplier) {
		if (confirm("Yakin Ingin Menghapus Suplier "+nama_suplier+" ?")) {
			var app = this;
			axios.delete(app.url+'/' + id)
			.then(function (resp) {
				app.getItems();
				app.alert(nama_suplier)
			})
			.catch(function (resp) {
				alert("Tidak bisa menghapus suplier");
			});
		}
	},

	alert(nama_suplier) {
		this.$swal({
			title: "Berhasil!",
			text: "Berhasil Menghapus Suplier "+ nama_suplier,
			icon: "success",
		});
	}
}

}
</script>