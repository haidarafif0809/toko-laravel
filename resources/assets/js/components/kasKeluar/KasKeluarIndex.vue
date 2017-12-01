<template>
    <div class="container">
        <ul class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
            <li class="active">Kas Keluar</li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">Table Kas Keluar</p>
                    </div>
                    <div class="panel-body">
                        <div class="tambah">
                            <p>
                                <router-link :to="{name: 'createKasKeluar'}" type="button" class="btn btn-primary">
                                    Tambah Kas Keluar
                                </router-link>
                            </p>
                        </div>
                        <div class="pencarian">
                         <input type="text" class="form-control" name="search" placeholder="Pencarian"  v-model="search" >
                     </div>
                     <table class="table table-striped table-hover">
                        <thead>
                            <th>No Faktur</th>
                            <th>Kas</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody v-if="kasKeluars.length > 0 && loading == false" class="data-ada">
                            <tr v-for="kasKeluar , index in kasKeluars" >
                                <td>{{kasKeluar.kas_keluar.id}}</td>
                                <td>{{kasKeluar.nama_kas}}</td>
                                <td>{{kasKeluar.nama_kategori_transaksi}}</td>
                                <td>{{kasKeluar.kas_keluar.jumlah}}</td>
                                <td>{{kasKeluar.kas_keluar.keterangan}}</td>
                                <td>{{kasKeluar.kas_keluar.created_at}}</td>
                                <td>
                                     <router-link :to="{name: 'editKasKeluar', params: {id: kasKeluar.kas_keluar.id}}" class="btn btn-xs btn-default">
                                    Edit  </router-link> 
                                    <a href="#"
                                    class="btn btn-xs btn-danger" 
                                    v-on:click="deleteKasKeluar(kasKeluar.kas_keluar.id, index,kasKeluar.kas_keluar.id)">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else-if="loading == true" class="data-ada" >
                            <tr >
                                <td colspan="4"  class="text-center">
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
                    <vue-simple-spinner v-if="loading"></vue-simple-spinner>
                    <div align="right"><pagination :data="kasKeluarsData" v-on:pagination-change-page="getKasKeluars" v-if="search == '' "></pagination></div>
                    <div align="right"><pagination :data="kasKeluarsData" v-on:pagination-change-page="getHasilPencarian" v-if="search != '' "></pagination></div>
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
      // buat nampilin data dlm bentuk array
      kasKeluars: [],
      // buat paginations
      kasKeluarsData: {},
      search: '',
      message : '',
      url : window.location.origin+(window.location.pathname).replace("home", "kas-keluar"),
      loading : true
  }
},
mounted() {
	var app = this;
    app.loading = true
    app.getKasKeluars();
},
watch: {
        // whenever question changes, this function will run
        pencarian: function (newQuestion) {
            this.getHasilPencarian();
        }
    },
    methods: {
     getKasKeluars(page) {
        	var app = this;
        	if (typeof page === 'undefined') {
        		page = 1;
        	}
        	axios.get(app.url+'/view?page='+page)
        	.then(function (resp) {
        		app.kasKeluars = resp.data.data;
        		app.kasKeluarsData = resp.data;
        		app.loading = false;
                //console.log(resp.data.data)
            })
        	.catch(function (resp) {
        		alert("Could not load Kas Keluars");
        		app.loading = false
        	});
        },
        deleteKasKeluar(id, index,kas_id) {
            if (confirm("Yakin Ingin Menghapus Satuan "+kas_id+" ?")) {
                var app = this;
                axios.delete(app.url+'/' + kas_id)
                .then(function (resp) {
                    app.getKasKeluars();
                    app.alert(kas_id)
                    app.$router.replace('/kas-keluar');
                })
                .catch(function (resp) {
                    alert("Could not delete Satuan");
                });
            }
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
                app.kasKeluars = resp.data.data;
                app.kasKeluarsData = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                app.loading = false
                alert("Could not load kas keluars");
            });

        },
        alert(kas_id) {
        	this.$swal({
        		title: "Berhasil!",
        		text: 'Sukses : Berhasil menghapus Kas Keluar '+ kas_id,
        		icon: "success",
        	});
        }
    }
}
</script>