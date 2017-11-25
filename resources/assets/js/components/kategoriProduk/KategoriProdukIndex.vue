<style scoped>
.pencarian {
	color: red;

	float: right;
	padding-bottom: 10px;
}
</style>

<template>  
	<div class="panel panel-default">
		<div class="panel-heading">Kategori Produk</div>
		<div class="panel-body">
			<div class="table-responsive">
				<p> <router-link :to="{name: 'createKategoriProduk'}" class="btn btn-primary">Create Kategori Produk</router-link></p>        
				<div class="pencarian">
					<input type="text" class="form-control" name="pencarian"placeholder="Pencarian"  v-model="pencarian" >
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<th>Nama Kategori Produk</th>
						<th>Aksi</th>
					</thead>
					<tbody v-if="kategoriProduks.length > 0 && loading == false" class="data-ada">
						<tr v-for="kategoriProduk , index in kategoriProduks" >
							<td>{{kategoriProduk.nama_produk}}</td>
							<td>
							</td>
						</tr>
					</tbody>

					<tbody v-else class="data-tidak-ada">
						<tr></tr>
						<td colspan="3" class="text-center">Tidak Ada Data</td>
					</tr>
				</tbody>
			</table>

		</div>
		<vue-simple-spinner v-if="loading"></vue-simple-spinner>

		<div align="right">
			<pagination :data="kategoriProduksData" v-on:pagination-change-page="getKategoriProduks"></pagination>
		</div>

	</div>
</div>
</template>


<script>
export default {
	data: function () {
		return {
      // buat nampilin data dlm bentuk array
      kategoriProduks: [],
      // buat paginations
      kategoriProduksData: {},
      pencarian: '',
      message : '',
      url : window.location.origin+(window.location.pathname).replace("home", "kategoriProduk"),
      loading : true
  }
},
mounted() {
	var app = this;
	app.getKategoriProduks();
},
watch: {
        // whenever question changes, this function will run
        pencarian: function (newQuestion) {
        	var irul = this;
        	irul.searchData()
        }
    },
    methods: {
        // method getkategoriProduk
        getKategoriProduks(page) {
        	var app = this;
        	if (typeof page === 'undefined') {
        		page = 1;
        	}
        	axios.get(app.url+'/view?page='+page)
        	.then(function (resp) {
        		app.kategoriProduks = resp.data.data;
        		app.kategoriProduksData = resp.data;
        		app.loading = false;
        // buat cek ddi console
        console.log(app.kategoriProduks)
    })
        	.catch(function (resp) {
        		alert("Could not load kategoriProduks");
        		app.loading = false
        	});
        },
        searchData(page) {
        	var app = this;
        	app.loading == true;
        	if (typeof page === 'undefined') {
        		page = 1;
        	}
        	axios.get(app.url+'/search?pencarian='+app.pencarian+'&page='+page)
        	.then(function(resp) {
        		app.kategoriProduks = resp.data.data;
        		app.kategoriProduksData = resp.data;
        		app.loading = false;

        	})
        	.catch(function(resp) {
        		alert("data tidak ditemukan");
        		app.loading = false
        	});
        },
        deleteKategoriProduk(id, index,nama_produk) {
        	if (confirm("Yakin Ingin Menghapus kategoriProduk "+nama_produk+" ?")) {
        		var app = this;
        		axios.delete(app.url+'/' + id)
        		.then(function (resp) {
        			app.getkategoriProduks();
        			app.message = 'Sukses : Berhasil menghapus kategoriProduk '+ nama_produk;
        			app.alert(app.message)
        		})
        		.catch(function (resp) {
        			alert("Could not delete kategoriProduk");
        		});
        	}
        },
        alert(pesan) {
        	this.$swal({
        		title: "Berhasil!",
        		text: pesan,
        		icon: "success",
        	});
        }
    }
}
</script>