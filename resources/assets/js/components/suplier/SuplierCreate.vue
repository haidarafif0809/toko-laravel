<template>
    <div class="container">
        <ul class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
            <li><router-link :to="{name: 'indexSuplier'}">Suplier</router-link></li>
            <li class="active">Tambah Suplier</li>
        </ul>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">Tambah Suplier</p>
                    </div>
                    <div class="panel-body">
                        <form v-on:submit.prevent="saveForm()" class="form-horizontal"> 
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">
                                    Nama Suplier
                                </label>
                                <div class="col-md-4">
                                    <input class="form-control" required autocomplete="off" placeholder="Nama Suplier" type="text" v-model="suplier.nama_suplier" name="name"  autofocus="">
                                    <span v-if="errors.name" id="name_error" class="label label-danger">
                                        {{ errors.nama_suplier[0] }}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">
                                    Alamat Suplier
                                </label>
                                <div class="col-md-4">
                                    <input class="form-control" required autocomplete="off" placeholder="Alamat Suplier" type="text" v-model="suplier.alamat_suplier" name="alamat"  autofocus="">
                                    <span v-if="errors.name" id="name_error" class="label label-danger">
                                        {{ errors.alamat_suplier[0] }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">
                                    Nomer Telpon 
                                </label>
                                <div class="col-md-4">
                                    <input class="form-control" required autocomplete="off" placeholder="Nomer Telpon" type="number" v-model="suplier.no_telp_suplier" name="No"  autofocus="">
                                    <span v-if="errors.name" id="name_error" class="label label-danger">
                                        {{ errors.no_telp_suplier[0] }}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    <button class="btn btn-primary" id="btnSimpanUser" type="submit"> 
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

</template>
<script>
export default {
    data: function () {
        return {
            errors: [],
            url : window.location.origin+(window.location.pathname).replace("home", "suplier"),
            suplier: {
                nama_suplier: '',
                alamat_suplier: '',
                no_telp_suplier: ''
            },
            message : ''
        }

    },
    methods: {
        saveForm() {
            var app = this;
            var newsuplier = app.suplier;
            axios.post(app.url, newsuplier)
            .then(function (resp) {
                app.message = 'Sukses : Berhasil Menambah Suplier '+ app.suplier.nama_suplier;
                app.alert(app.message);
                app.suplier.nama_suplier = ''
                app.suplier.alamat_suplier = ''
                app.suplier.no_telp_suplier = ''
                app.errors = '';
                app.$router.replace('/suplier');
            })
            .catch(function (resp) {
                app.success = false;
                app.errors = resp.response.data.errors;
            });
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
