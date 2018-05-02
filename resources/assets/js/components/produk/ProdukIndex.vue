<style scoped>
.animated {
    -webkit-animation-duration: 0.35s; /* Safari 4.0 - 8.0 */
    animation-duration: 0.35s;
    -webkit-animation-fill-mode: both; /* Safari 4.0 - 8.0 */
    animation-fill-mode: both;
}

/* Safari 4.0 - 8.0 */
@-webkit-keyframes fadeIn {
    0% {opacity: 0;}
    100% {opacity: 1;}
}

@keyframes fadeIn {
    0% {opacity: 0;}
    100% {opacity: 1;}
}

.fadeIn {
    -webkit-animation-name: fadeIn;
    animation-name: fadeIn;
}

.bold {
    font-weight: bold;
}

.tablePenjelasan, .tableContoh {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    margin-bottom: 30px;
}

.tablePenjelasan td {
    padding-right: 5.5px;
    padding-bottom: 10px;
}

.tableContoh {
    width: 95%;
}

.tableContoh th, .tableContoh td {
    padding: 2.5px 6px 2.5px 6px;
    border: 1px groove #eee;
}

.leftSmall {
    background: #000;
    text-align: left;
    font-size: 4px;
}
.table-responsive {
    border: 0;
}
</style>
<template>
    <div class="container">
        <ol class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}" >Dashboard</router-link></li>
            <li class="active">Produk</li>
        </ol>

        <!-- Modal untuk import produk -->
        <div id="modalImportProduk" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Import Produk</h4>
                    </div>
                    <div class="modal-body">
                        <form v-on:submit.prevent="importProduk()" class="form-horizontal">

                            <div class="form-group">
                                <label for="template" class="col-md-2 control-label">Template</label>
                                <div class="col-md-6">
                                    Gunakan <a name="template" :href="url_template_import_produk">Template</a> untuk Import Produk. Lihat <a style="color: blue;" data-toggle="modal" data-target="#modalCaraPengisianExcel" href="#">contoh</a> pengisian untuk lebih detail.
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal Cara Pengisian Excel -->
        <div id="modalCaraPengisianExcel" class="modal animated fadeIn" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Cara Pengisian</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="table-responsive">
                                <table class="tablePenjelasan">
                                    <tbody>
                                        <tr>
                                            <td class="bold">Nama Produk</td>
                                            <td>:</td>
                                            <td>Nama Produk Anda.</td>
                                        </tr>

                                        <tr>
                                            <td class="bold">Kategori Produk</td>
                                            <td>:</td>
                                            <td>Masukkan Kategori Produk yang sudah ada atau masukkan yang lain untuk membuat yang baru.</td>
                                        </tr>

                                        <tr>
                                            <td class="bold">Harga Jual</td>
                                            <td>:</td>
                                            <td>Harga Jual Produk Anda.</td>
                                        </tr>

                                        <tr>
                                            <td class="bold">Satuan</td>
                                            <td>:</td>
                                            <td>Isi satuan produk anda, contoh Pcs, Porsi, Pack, atau yang lainnya.</td>
                                        </tr>

                                        <tr>
                                            <td class="bold">Bisa Dijual</td>
                                            <td>:</td>
                                            <td>Menentukan apakah Produk Anda dapat dijual atau tidak ( <b>ya</b> / <b>tidak</b> ).</td>
                                        </tr>

                                        <!-- <tr>
                                            <td class="bold">Tambahan</td>
                                            <td>:</td>
                                            <td>Isi Tambahan apabila ada tambahan bahan dalam produk anda</td>
                                        </tr>
 -->                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">Contoh seperti tabel di bawah:</div>
                                </div>
                                <br>
                                <div align="center">
                                    <table class="tableContoh">
                                        <thead>
                                            <th>Nama Produk</th>
                                            <th>Kategori Produk</th>
                                            <th>Harga Jual</th>
                                            <th>Satuan</th>
                                            <th>Bisa Dijual</th>
                                            <!-- <th>Tambahan</th> -->
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Mie Goreng</td>
                                                <td>Makanan</td>
                                                <td align="right">25.000</td>
                                                <td>Porsi</td>
                                                <td>ya</td>
                                                <!-- <td>Cumi</td> -->
                                            </tr>
                                            <tr>
                                                <td>Nasi Goreng</td>
                                                <td>Makanan</td>
                                                <td align="right">23.000</td>
                                                <td>Piring</td>
                                                <td>ya</td>
                                                <!-- <td>ayam</td> -->
                                            </tr>
                                            <tr>
                                                <td>Jus Jeruk</td>
                                                <td>Minuman</td>
                                                <td align="right">12.000</td>
                                                <td>Porsi</td>
                                                <td>ya</td>
                                                <!-- <td>Susu Coklat</td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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
                        <span class="btn btn-primary" data-toggle="modal" data-target="#modalImportProduk">Import Produk</span>
                        <router-link :to="{name: 'indexKategoriProduk'}" class="btn btn-info">Kategori Produk</router-link>
                    </p>
                    <!-- <button type="button" class="btn btn-info btn-lg">Open Modal</button> -->

                    <div class="pencarian">
                        <input type="text" class="form-control" name="pencarian" placeholder="Pencarian"  v-model="pencarian">
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Nama Produk</th>
                            <th>Harga Jual</th>
                            <th>Kategori</th>
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
                                    {{ "Rp" }}{{ new Intl.NumberFormat().format(produk.harga_jual) }}
                                </td>
                                <td>
                                    {{ produk.kategori_produk }}
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
                                <td colspan="4" class="text-center">Tidak Ada Data</td>
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
            errors: [],
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
            swal({
                title: "Hapus?", 
                text: "Yakin Ingin Menghapus produk "+ nama_produk +" ?", 
                type: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            })
            .then((result) => {
                if (result.value) {
                    var app = this;
                    axios.delete(app.url+'/' + id)
                    .then(function (resp) {
                        app.getProduks();

                        if (resp.data.error == 1){
                            swal({
                                title: 'Gagal!',
                                type: 'warning',
                                text: nama_produk+' sudah pernah dijual'
                            });
                        }else{
                            swal({
                                title: 'Berhasil!',
                                type: 'success',
                                text: 'Berhasil menghapus '+ nama_produk
                            })
                        }
                        
                    })
                    .catch(function (resp) {
                        app.$router.replace('/produk/');
                        swal({
                            title: 'Gagal!',
                            type: 'warning',
                            text: 'Tidak dapat menghapus produk!'
                        })
                    });
                } 
                // else {
                //     return;
                // }
                this.$router.replace('/produk/');
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
                swal({
                    title: 'Kosong!',
                    type: 'warning',
                    text: 'Tolong masukkan file.'
                })
                return;
            }

            axios.post(app.url_import_produk, newProduk)
            .then(function (resp) {
                console.log(resp);
                // return;

                // Menampilkan pesan error jika nilai dari kolom Bisa Dijual
                // bukan bernilai ya atau tidak atau bahkan kosong
                if (resp.data.errorMsg != undefined) {

                    return swal({
                        title: 'Gagal!',
                        type: 'warning',
                        html: '<div style="text-align: left; font-size: 14px;">'+ resp.data.errorMsg +'</div>',
                    });
                }

                swal({
                    title: 'Berhasil!',
                    type: 'success',
                    text: resp.data.jumlahProduk + ' Produk berhasil diupload.'
                })
                app.getProduks();
            })
            .catch(function (resp) {
                console.log(resp.response)
                if (resp.response.data.errors != undefined) {
                    app.errors = resp.response.data.errors.excel[0];
                }
                else {
                    app.errors = "Ukuran file terlalu besar!";
                }
                return swal({
                    title: 'Gagal!',
                    type: 'warning',
                    text: app.errors,
                })
            });
        }
    }
}
</script>