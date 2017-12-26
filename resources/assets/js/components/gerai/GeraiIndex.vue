<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexGerai'}">Gerai</router-link></li>
		</ul>

		<div class="panel panel-default">
			<div class="panel-heading">Gerai</div>
			<div class="panel-body">
				<div class="tambah">
					<p>
						<router-link :to="{name: 'createGerai'}" class="btn btn-primary">Tambah Gerai</router-link>
					</p>
				</div>

				<div class="pencarian">
					<input type="text" class="form-control" placeholder="Cari gerai.." 
					v-model="search">
				</div>
				
				<table class="table table-striped">
					<thead>
						<th>Nama</th>
						<th>Kota</th>
						<th>Aksi</th>
					</thead>
					<tbody v-if="gerais.length > 0 && loading == false" class="data-ada">
						<tr v-for="gerai, index in gerais">
							<td>{{gerai.nama_gerai}}</td>
							<td>{{gerai.kota}}</td>
							<td>
								<router-link :to="{name: 'editGerai', params: {id: gerai.id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + gerai.id" >
									Edit 
								</router-link> 
								<a href="#"
								class="btn btn-xs btn-danger" 
								v-on:click="deleteEntry(gerai.id, index,gerai.nama_gerai)">
								Delete
							</a>
						</td>
					</tr>
				</tbody>
				<tbody v-else-if="loading == true" class="data-ada">
					<tr>
						<td colspan="4" class="text-center">
							Sedang Memuat Data
						</td>
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
		</div>
		<vue-simple-spinner v-if="loading"></vue-simple-spinner>
		<div align="right"><pagination :data="geraisData" v-on:pagination-change-page="getGerai":limit="1" v-if="search == '' "></pagination></div>
		<div align="right"><pagination :data="geraisData" v-on:pagination-change-page="getGerai":limit="1" v-if="search != '' "></pagination></div>
	</div>
</div>
</template>
<script>
export default {
	data: function () {
		return {
			gerais: [],
			geraisData: {},
			url : window.location.origin+(window.location.pathname).replace("home","gerai"),
			search : '',
			loading : true

		}
	},
	watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
        	this.getHasilPencarian();  
        }
    },
    mounted() {
    	var app = this;
    	app.loading = true
    	app.getGerai();	

    },
    methods: { 
    	getGerai(page) {
    		var app = this;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/view?page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.gerais = resp.data.data;
    			app.geraisData = resp.data
               // console.log(app.kas)


           })
    		.catch(function (resp) {
    			alert("Could not load gerai");
    		});

    	},
    	getHasilPencarian(page){
    		var app = this;
    		app.loading = true;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/pencarian?search='+app.search+'&page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.gerais = resp.data.data;
    			app.geraisData = resp.data;
    		})
    		.catch(function (resp) {
    			console.log(resp);
    			app.loading = false
    			alert("Could not load gerais");
    		});
    	},

    	deleteEntry(id, index,nama_gerai) {
    		if (confirm("Yakin Ingin Menghapus Gerai "+nama_gerai+" ?")) {
    			var app = this;
    			axios.delete(app.url+'/' + id)
    			.then(function (resp) {
    				app.getGerai();
    				app.alert(nama_gerai)
    			})
    			.catch(function (resp) {
    				alert("Tidak bisa menghapus gerai");
    			});
    		}
    	},

    	alert(nama_gerai) {
    		this.$swal({
    			title: "Berhasil!",
    			text: "Berhasil Menghapus Gerai "+ nama_gerai,
    			icon: "success",
    		});
    	}
    }
}	
</script>
