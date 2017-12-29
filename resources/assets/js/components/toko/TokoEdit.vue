<template>
  <div class="container">
    <div class="row">
      <ul class="breadcrumb">
        <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
        <li><router-link :to="{name: 'indexToko'}">Toko</router-link></li>
        <li class="active"><EMBED></EMBED>Edit Toko</li>
      </ul>
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Edit Toko </h4>
          </div>
          <form v-on:submit.prevent="saveForm()" class="form-horizontal">
            <div class="form-group">
              <label for="nama_toko" class="col-md-2 control-label">Nama Toko</label>
              <div class="col-md-4">
                <input class="form-control" required autocomplete="off" placeholder="Nama Toko" type="text" v-model="toko.nama_toko" name="nama_toko"  autofocus="">
                <span v-if="errors.nama_toko" class="label label-danger">{{ errors.nama_toko[0] }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="nama_pemilik" class="col-md-2 control-label">Nama Pemilik</label>
              <div class="col-md-4">
                <input class="form-control" required autocomplete="off" placeholder="Nama Pemilik" type="text" v-model="toko.nama_pemilik" name="nama_pemilik"  autofocus="">
                <span v-if="errors.nama_pemilik" class="label label-danger">{{ errors.nama_pemilik[0] }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-md-2 control-label">Email</label>
              <div class="col-md-4">
                <input class="form-control" required autocomplete="off" placeholder="Nama Toko" type="text" v-model="toko.email" name="email"  autofocus="">
                <span v-if="errors.email" class="label label-danger">{{ errors.email[0] }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="no_telp" class="col-md-2 control-label">No. Telp</label>
              <div class="col-md-4">
                <input class="form-control" required autocomplete="off" placeholder="Nama Toko" type="text" v-model="toko.no_telp" name="no_telp"  autofocus="">
                <span v-if="errors.no_telp" class="label label-danger">{{ errors.no_telp[0] }}</span>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-2">
                <button class="btn btn-primary" id="btnSimpantoko" type="submit">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  mounted() {
    this.getItem();
  },

  data: function () {
    return {
      errors: [],
      url : window.location.origin+(window.location.pathname).replace("home", "toko"),
      toko: {
        nama_toko: '',
        nama_pemilik: '',
        email: '',
        no_telp: '',
      },
      tokoId: null,
      message: ''
    }
  },
  methods: {
    saveForm() {
      var app = this;
      var newtoko = app.toko;
      axios.patch(app.url+'/' + app.tokoId, newtoko)
      .then(function (resp) {
        app.message = 'Berhasil Merubah kategori Produk "'+app.toko.nama_toko+'"'
        app.alert(app.message);
        app.$router.replace('/toko');

      })
      .catch(function (resp) {
        app.errors = resp.response.data.errors;
      });
    },
    alert(pesan) {
      this.$swal({
        title: "Berhasil!",
        text: pesan,
        icon: "success",
      });
    },
    getItem(){

      let app = this;
      let id = app.$route.params.id;
      app.tokoId = id;

      axios.get(app.url+'/' + id + '/edit')
      .then(function (resp) {
        app.toko = resp.data;
      })
      .catch(function () {
        alert("Could not load your toko")
      });
    }

  }

}
</script>