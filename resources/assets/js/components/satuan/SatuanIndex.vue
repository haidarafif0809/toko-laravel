<template>
    <div class="container">
        <ul class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
            <li class="active">Satuan</li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">Satuan</p>
                    </div>
                    <div class="panel-body">
                        <div class="tambah">
                            <p>
                                <router-link :to="{name: 'createSatuan'}" type="button" class="btn btn-primary">
                                    Tambah Satuan
                                </router-link>
                            </p>
                        </div>
                        <div class="pencarian">
                           <input type="text" class="form-control" name="search" placeholder="Pencarian"  v-model="search" >
                       </div>
                       <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                           <thead>
                            <th>Nama</th>

                            <th>Aksi</th>
                        </thead>
                        <tbody v-if="satuans.length > 0 && loading == false" class="data-ada">
                            <tr v-for="satuan ,index in satuans">
                             <td>{{ satuan.nama_satuan }}</td>

                             <td>
                                <router-link :to="{name: 'editSatuan', params: {id:satuan.id}}" class="btn btn-xs btn-default">
                                    Edit
                                </router-link>
                                <a href="#"
                                class="btn btn-xs btn-danger" 
                                v-on:click="deleteEntry(satuan.id, index,satuan.nama_satuan)">
                                Delete
                            </a>
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
            <div align="right"><pagination :data="satuansData" v-on:pagination-change-page="getSatuans":limit="1" v-if="search == '' "></pagination></div>
            <div align="right"><pagination :data="satuansData" v-on:pagination-change-page="getHasilPencarian":limit="1" v-if="search != '' "></pagination></div>
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
         satuans: [],
         satuansData: {},
         url : window.location.origin+(window.location.pathname).replace("home","satuan"),
         search : '',
         loading : true

     }
 },
 mounted() {
  var app = this;
  app.loading = true
  app.getSatuans();	

},
watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
        	this.getHasilPencarian();  
        }
    },
    methods: {
    	getSatuans(page) {
    		var app = this;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/view?page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.satuans = resp.data.data;
    			app.satuansData = resp.data

    		})
    		.catch(function (resp) {
    			alert("Could not load satuans");
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
                app.satuans = resp.data.data;
                app.satuansData = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                app.loading = false
                alert("Could not load satuans");
            });


        },

    	deleteEntry(id, index,nama_satuan) {
            swal({
                title: "Konfirmasi Hapus",
                text : "Anda Yakin Ingin Menghapus "+nama_satuan+" ?",
                icon : "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var app = this;
                    axios.delete(app.url+'/' + id)
                    .then(function (resp) {
                        app.getSatuans();
                        swal("Satuan Berhasil Dihapus!  ", {
                            icon: "success",
                        });
                    })
                    .catch(function (resp) {
                        app.$router.replace('/satuan/');
                        swal("Gagal Menghapus Satuan!", {
                            icon: "warning",
                        });
                    });
                }
                this.$router.replace('/satuan/');
            });
        },

    }

}
</script>

