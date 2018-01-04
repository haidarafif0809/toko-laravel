<template>
    <div class="container">
        <ol class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}" >Dashboard</router-link></li>
            <li class="active">Produk</li>
        </ol>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Import Produk</h4>
                    </div>
                    <div class="modal-body">
                        <form v-on:submit.prevent="importProduk()" class="form-horizontal">

                            <div class="form-group">
                                <label for="template" class="col-md-2 control-label">Template</label>
                                <div class="col-md-4">
                                    Gunakan <a name="template" :href="url_template_import_produk">Template</a> untuk Import Produk
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="excel" class="col-md-2 control-label">Pilih file</label>
                                <div class="col-md-4">
                                    <input name="excel" type="file" id="excel">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    <input class="btn btn-primary" type="submit" value="Simpan">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Produk</div>

            <div class="panel-body">
                <div class="table-responsive">
                    <p>
                        <router-link :to="{name: 'createProduk'}" class="btn btn-primary">Tambah Produk</router-link>
                        <span class="btn btn-primary" data-toggle="modal" data-target="#myModal">Import Produk</span>
                    </p>
                    <!-- <button type="button" class="btn btn-info btn-lg">Open Modal</button> -->

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
                                <td>
                                    <router-link :to="{name: 'editProduk', params: {id: produk.produk_id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + produk.produk_id" >
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
            import_produk: {
                excel: '',
            },
            pencarian: "",
            url : window.location.origin + (window.location.pathname).replace("home", "produk"),
            url_template_import_produk : window.location.origin + (window.location.pathname).replace("home", "produk/template_import"),
            url_import_produk : window.location.origin + (window.location.pathname).replace("home", "produk/import_produk"),
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
            this.$swal({
                title: "Hapus?", 
                text: "Yakin Ingin Menghapus produk "+ nama_produk +" ?", 
                icon: "warning",
                buttons: ['Batal', 'Hapus'],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var app = this;
                    axios.delete(app.url+'/' + id)
                    .then(function (resp) {
                        app.getProduks();
                        app.alert('Berhasil!', 'Berhasil Menghapus produk '+nama_produk, 'success')
                    })
                    .catch(function (resp) {
                        app.alert('Gagal!', 'Tidak dapat menghapus produk!', 'warning');
                    });
                } 
                else {
                    return;
                }
            });
        },
        importProduk() {
            var app = this;
            let newProduk = new FormData();
            let file = document.getElementById('excel').files[0];
            if (file != undefined) {
                newProduk.append('excel', file);
            }
            else {
                app.alert('Kosong!', 'Tolong masukkan file.', 'warning');
                return;
            }

            axios.post(app.url_import_produk, newProduk)
            .then(function (resp) {
                app.alert('Berhasil!', 'Excel berhasil diupload.', 'success');
            })
            .catch(function (resp) {
                console.log(resp)
                app.alert('Gagal!', 'ada yang salah dengan proses uploadnya', 'warning');
            });
        },
        alert(title, pesan, icon) {
            this.$swal({
                title: title,
                text: pesan,
                icon: icon,
            });
        }
    }
}
</script>