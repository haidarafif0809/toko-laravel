<template>  
  <div class="container">
    <ol class="breadcrumb">
      <li><router-link :to="{name: 'indexDashboard'}" >Dashboard</router-link></li>
      <li class="active">Produk</li>
    </ol>
    <div class="panel panel-default">
      <div class="panel-heading">Produk</div>

      <div class="panel-body">
        <div class="table-responsive">
          <div class="tambah">
            <p> <router-link :to="{name: 'createProduk'}" class="btn btn-primary">Tambah Produk</router-link></p>
          </div>
          <div class="pencarian">
            <input type="text" class="form-control" name="pencarian" placeholder="Pencarian"  v-model="pencarian">
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <th>Nama Produk</th>
              <th>Aksi</th>
            </thead>
            <tbody v-if="produks.length > 0 && loading == false" class="data-ada">
              <tr v-for="produk , index in produks">
                <td>
                  <router-link :to="{name: 'detailProduk', params: {id: produk.produk_id}}">
                    {{produk.nama_produk}}
                  </router-link>
                </td>
                <td><router-link :to="{name: 'editProduk', params: {id: produk.produk_id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + produk.produk_id" >
                  Edit 
                </router-link> 
                <a href="#" class="btn btn-xs btn-danger" v-bind:id="'delete-' + produk.produk_id" v-on:click="deleteEntry(produk.produk_id, index,produk.nama_produk)">
                  Hapus
                </a>
              </td>
            </tr>
          </tbody>

          <tbody v-else class="data-tidak-ada">
            <tr>
              <td colspan="2" class="text-center">Tidak Ada Data</td>
            </tr>
          </tbody>
        </table>
      </div>

      <vue-simple-spinner v-if="loading"></vue-simple-spinner>
      <div align="right">
        <pagination :data="produksData" v-on:pagination-change-page="getProduks"></pagination>
      </div>

    </div>
  </div>
</div>
</template>


<script>
export default {
  data: function () {
    return {
      produks: [],
      produksData: {},
      pencarian: "",
      url : window.location.origin + (window.location.pathname).replace("home", "produk"),
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
    app.getProduks();
  },
  methods: {
    getProduks(page) {
      var app = this;
      if (typeof page === 'undefined') {
        page = 1;
      }

      axios.get(app.url+'/view?page='+page)
      .then(function (resp) {
        app.produks = resp.data.data;
        app.produksData = resp.data;
        app.loading = false;
      })
      .catch(function (resp) {
        alert("Could not load produks");
        app.loading = false
      });
    },
    searchData(page) {
      var app = this;
      app.loading = true;
      if (typeof page === 'undefined') {
        page = 1;
      }

      axios.get(app.url+'/cari?pencarian='+app.pencarian+'&page='+page)
      .then(function (resp) {
        app.produks = resp.data.data;
        app.produksData = resp.data;
        app.loading = false    
      })
      .catch(function (resp) {
        alert("Tidak dapat memuat produk..");
        app.loading = false;
      })
    },
    deleteEntry(id, index,nama_produk) {
      if (confirm("Yakin Ingin Menghapus produk "+nama_produk+" ?")) {
        var app = this;
        axios.delete(app.url+'/' + id)
        .then(function (resp) {
          app.getProduks();
          app.alert("Berhasil Menghapus produk "+nama_produk)
        })
        .catch(function (resp) {
          alert("Tidak dapat menghapus produk!");
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