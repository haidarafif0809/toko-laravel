<template>
    <div class="container">
        <ul class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
            <li class="active">Kas</li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">Kas</p>
                    </div>
                    <div class="panel-body">
                        <div class="tambah">
                            <p>
                                <router-link :to="{name: 'createKas'}" type="button" class="btn btn-primary">
                                    Tambah Kas
                                </router-link>
                            </p>
                        </div>
                        <div class="pencarian">
                         <input type="text" class="form-control" name="search" placeholder="Pencarian"  v-model="search" >
                     </div>
                     <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                         <thead>
                            <th>Kode Kas</th>
                            <th>Nama Kas</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody v-if="kas.length > 0 && loading == false" class="data-ada">
                            <tr v-for="dataKas ,index in kas">
                                <td>{{ dataKas.kode_kas }}</td>
                                <td>{{ dataKas.nama_kas }}</td>
                                <td>
                                    <router-link :to="{name: 'editKas', params: {id:dataKas.id}}" class="btn btn-xs btn-default">
                                        Edit
                                    </router-link>
                                    <a href="#"
                                    class="btn btn-xs btn-danger" 
                                    v-on:click="deleteEntry(dataKas.id, index,dataKas.nama_kas)">
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
                <div align="right"><pagination :data="kasData" v-on:pagination-change-page="getKas" v-if="search == '' "></pagination></div>
                <div align="right"><pagination :data="kasData" v-on:pagination-change-page="getHasilPencarian" v-if="search != '' "></pagination></div>
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
   kas: [],
   kasData: {},
   url : window.location.origin+(window.location.pathname).replace("home","kas"),
   search : '',
   loading : true

}
},
mounted() {
  var app = this;
  app.loading = true
  app.getKas();	

},
watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
        	this.getHasilPencarian();  
        }
    },
    methods: { 
    	getKas(page) {
    		var app = this;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/view?page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.kas = resp.data.data;
    			app.kasData = resp.data
               // console.log(app.kas)


           })
    		.catch(function (resp) {
    			alert("Could not load kas");
    		});
    	},
    	deleteEntry(id, index,nama_kas) {
    		if (confirm("Yakin Ingin Menghapus Kas "+nama_kas+" ?")) {
    			var app = this;
    			axios.delete(app.url+'/' + id)
    			.then(function (resp) {
    				app.getKas();
    				app.alert(nama_kas)
                    app.$router.replace('/kas');
                })
    			.catch(function (resp) {
    				alert("Could not delete kas");
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
    			app.kas = resp.data.data;
    			app.kasData = resp.data;
    		})
    		.catch(function (resp) {
    			console.log(resp);
    			app.loading = false
    			alert("Could not load kas");
    		});


    	},
    	alert(nama_kas) {
    		this.$swal({
    			title: "Berhasil!",
    			text: "Berhasil Menghapus "+ nama_kas,
    			icon: "success",
    		});
    	}
    }

}
</script>

