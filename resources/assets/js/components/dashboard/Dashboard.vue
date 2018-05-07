<style type="text/css">
.ct-series-a .ct-line {
  /* Set the colour of this series line */
  stroke: #578CA9;
  /*fill: hsl(120, 40%, 60%);*/
  /*Control the thikness of your lines */
  stroke-width: 5px;
  /* Create a dashed line with a pattern */
  stroke-dasharray: 10px 7px;
  stroke-linecap: square;
}

.ct-series-a .ct-area {
  fill: #578CA9;
}
.ct-series-a .ct-bar {
  /* Colour of your bars */
  stroke: #578CA9;
}
.ct-series-a .ct-point {
  /* Colour of your points */
  stroke: #578CA9;
  /* Size of your points */
  stroke-width: 10px;
  /* Make your points appear as squares or round */
  stroke-linecap: square;
}

.ct-label {
  font-size: 10px;
}

#chartdiv {
  width : 100%;
  height  : 5000px;
}
.card {
  display: inline-block;
  position: relative;
  width: 100%;
  margin-top: 20px;
  /*border-radius: 10px;*/
  color: rgba(0,0,0, 0.87);
  background: #fff;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}
.card .header-primary {
  /*background: linear-gradient(60deg, #ab47bc, #7b1fa2);*/
  background: #578CA9;
}
.card .header-info {
  background: linear-gradient( #4C6A92);
}
/*color typografy*/
.card [class*="header-"] {
  color: #FFFFFF;
}

.card .header {
  /*box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);*/
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
  margin-bottom: 40px;
  margin-left: 15px;
  margin-right: 15px;
  margin-top: -30px;
  /*border-radius: 10px;*/
  padding: 10px 0;
  background-color: #FFFFFF;
}
h4 {
  padding-left: 20px;
}
.chat-bottom{
  margin-top: 15px;
}
.chat-penjualan-tertinggi{
  margin-top: 15px;
}
.chat-penjualan-produk-teratas{
  margin-top: 15px;
}
/*.card-signup .text-divider {
  margin-top: 30px;
  margin-bottom: 0px;
  text-align: center;
}
.card-signup .content {
  padding: 0px 30px 0px 10px;
}
.card-nav-tabs .nav-tabs {
  background: transparent;
}
.card .content {
  padding: 15px;
}
.card .card-body {
  height: 30%;
  padding: 18px;
}
.card .card-footer {
  height: 10%;
  padding: 18px;
}
*/
</style>
<template>
  <div class="container">
    <div class="panel panel-default">
      <h4 class="panel-heading"><B>DASHBOARD</B></h4>
    </div>
    <div class="row">
      <div class="col-md-2 ">
        <p>{{ msg }}</p>
      </div>
      <div class="form-group col-md-2  ">
        <selectize-component class="form-control" v-model="filter.priode" :settings="placeholder_priode" id="pilih_priode"> 
          <option v-bind:value=0>Semua</option>                 
          <option v-bind:value=1>Hari ini</option>
          <option v-bind:value=2>7 hari terakhir</option>
          <option v-bind:value=3>30 hari terakhir</option>
          <option v-bind:value=4>1 tahun terakhir</option>
        </selectize-component>
      </div>
      <div class=" col-md-1">
        <button class="btn btn-md btn-primary" @click="rentangWaktu()">Rentang Waktu</button>
      </div>
    </div>
    <div class="row">  
      <div class="form-group col-md-12">
        <div class="waktu">
          <div class="form-group col-md-2 " id="rentang_waktu1" style="display:none">
            <datepicker :input-class="'form-control'" placeholder="Dari Tanggal" v-model="filter.dari_tanggal" name="dari_tanggal" v-bind:id="'dari_tanggal'"></datepicker>     
          </div>
          <div class="form-group col-md-2 " id="rentang_waktu2" style="display:none">
            <datepicker :input-class="'form-control'" placeholder="Sampai Tanggal" v-model="filter.sampai_tanggal" name="sampai_tanggal" v-bind:id="'sampai_tanggal'"></datepicker>
          </div>
          <div class="form-group col-md-1" id="rentang_waktu3" style="display:none">
            <button class="btn btn-primary" id="btnSubmit" type="submit" style="margin: 0px 0px;" @click="submitPostRiwayatTransaksi()"> Cari</button>
          </div>
        </div>  
      </div>
    </div>
    <div class="row">
      <div>
        <chartist ratio=".ct-minor-seventh" type="Line" :data="chartData" :options="chartOptions" > </chartist>
      </div>
    </div>
    <div class="col-md-6 chat-penjualan-produk-teratas">
      <div class="card card-nav-tabs">
        <div class="header header-info">
          <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
          <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
              <h4><i class="fa fa-area-chart" aria-hidden="true"></i> Penjualan Produk Teratas</h4>
            </div>
          </div>
        </div>
        <div class="content">
          <div class="tab-content text-center">
            <div class="tab-pane active" id="profile2">
              <chartist ratio=".ct-golden-section" type="Bar" :data="chartData2" :options="chartOptions2" > </chartist>
            </div>
          </div>
        </div>
      </div>
    </div>           
    <div class="col-md-6 chat-penjualan-tertinggi">
      <div class="card card-nav-tabs">
        <div class="header header-info">
          <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
          <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
              <h4><i class="fa fa-area-chart" aria-hidden="true"></i> Nominal Penjualan Tertinggi</h4>
            </div>
          </div>
        </div>
        <div class="content">
          <div class="tab-content text-center">
            <div class="tab-pane active" id="profile4">
              <chartist ratio=".ct-golden-section" type="Bar" :data="chartData4" :options="chartOptions4" > </chartist>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3 chat-bottom" >
        <div class="card card-nav-tabs">
          <div class="header header-info">
            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <h4><i class="fa fa-area-chart" aria-hidden="true"></i> Penjualan Per Kategori</h4>
              </div>
            </div>
          </div>
          <div class="content">
            <div class="tab-content text-center">
              <div class="tab-pane active" id="profile3">
                <chartist ratio=".ct-minor-seventh" type="Pie" :data="chartData3" :options="chartOptions3 " :responsiveOptions="responsiveOptions3" > </chartist>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
  <!-- <line-chart :data="datacollection" :options="{responsive: true, maintainAspectRatio: false}"></line-chart> -->
</template>
<script>
import LineChart from './LineChart'
export default {
  components: { LineChart },
  data() {
    return {
      datacollection: {
        labels: [""],
        datasets: [
        {
          label: 'Data One',
          backgroundColor: '#f87979',
          data: [40]
        }
        ]
      },
      filter:{
        priode:'',
        dari_tanggal:'',
        sampai_tanggal:''
      },
      placeholder_priode:{
        placeholder: 'PILIH PRIODE'
      },
      url : window.location.origin+(window.location.pathname).replace("home","laporan"),
      riwayat_penjualan: [],
      msg: 'Grafik Penjualan harian',
            // chart penualan harian
            chartData: {
              labels:[],
              series: [],
            },
            chartOptions: {
              low: 0,
              showArea: true,
              lineSmooth: true,
        // stretch: true,
        fullWidth: false,
        axisX: {
          // We can disable the grid for this axis
          showGrid: true,
          // and also don't show the label
          showLabel: true,
        },
        // Y-Axis specific configuration
        axisY: {
          // Lets offset the chart a bit from the labels
          offset: 60,
          // The label interpolation function enables you to modify the values
          // used for the labels on each axis. Here we are converting the
          // values into million pound.
          labelInterpolationFnc: function(value) {
            return 'Qty ' + value;
          }
        }
      },
      // chart penjualan produk teratas
      chartData2: {
        labels: [],
        series: []
      },
      chartOptions2:{
        chartPadding: {
          right: 60
        },
        fullWidth: false,
        seriesBarDistance: 10,
        reverseData: true,
        horizontalBars: true,
        axisX: {
          // We can disable the grid for this axis
          showGrid: true,
          // and also don't show the label
          showLabel: true,
          labelInterpolationFnc: function(value) {
            return 'Qty '+value;
          }
        },
        axisY: {
          offset: 70,
        }
      },
      chartData3:{
        labels:[],
        series: []
      },
      chartOptions3: {
        data: {
          // labels:['ddd', 'dds', 'ff'],
          series: [5, 3, 2]
        },
        labelInterpolationFnc: function(value) {
          return Math.round(value / this.data.series.reduce(function(a, b) { return a + b }) * 100) + '%';
        }
      },
      responsiveOptions3:[
      ['screen and (min-width: 100px)', {
        chartPadding: 10,
        labelOffset: 10,
        labelDirection: 'explode',
        labelInterpolationFnc: function(value) {
          return value;
        }
      }],
      ['screen and (min-width: 100px)', {
        labelOffset: 40,
        chartPadding: 20
      }]
      ],
      chartData4: {
        labels: [],
        series: []
      },
      chartOptions4:{
        chartPadding: {
          right: 60
        },
        seriesBarDistance: 10,
        reverseData: true,
        horizontalBars: true,
        axisX: {
          // We can disable the grid for this axis
          showGrid: true,
          // and also don't show the label
          showLabel: true,
          labelInterpolationFnc: function(value) {
            return value + ' k';
          }
        },

        axisY: {
          offset: 70,
        }
      },
    }
  },
  mounted(){

  },
  watch: {
    'filter.priode': function(value) {
      this.submitPriode();
    }
  },
  methods: {
    submitPriode()
    {
      var app = this;
      app.filter.dari_tanggal = '';
      app.filter.sampai_tanggal = '';
      var filter = app.filter;
      app.getGrafikPenjualanHarian();
      app.getGrafikPenjualanProdukTeratas();
      app.getGrafikPenjualanProdukKategori();
    },
    // menampilkan data simpan penjualan
    getGrafikPenjualanHarian() {
      var app = this;
      var filter = app.filter;
      axios.post(app.url+'/grafik-penjualan-harian', filter)
      .then(function (resp) {
        // app.datacollection.labels = resp.data.labels;
        app.chartData.labels = resp.data.labels;
        app.chartData.series = resp.data.series;
        // console.log(app.datacollection.labels)
      })
      .catch(function (resp) {
        alert("Could not load riwayat_penjualan");
      });
    },
    getGrafikPenjualanProdukTeratas() {
      var app = this;
      var filter = app.filter;
      axios.post(app.url+'/grafik-penjualan-produk-teratas', filter)
      .then(function (resp) {
        app.chartData2.labels = resp.data.labels;
        app.chartData2.series = resp.data.series;
        // chart nominal tertinggi
        app.chartData4.labels = resp.data.labels;
        app.chartData4.series = resp.data.series2;
        // console.log('hha',resp.data.labels)
      })
      .catch(function (resp) {
        alert("Could not load riwayat_penjualan");
      });
    },
    getGrafikPenjualanProdukKategori() {
      var app = this;
      var filter = app.filter;
      axios.post(app.url+'/grafik-penjualan-produk-kategori', filter)
      .then(function (resp) {
        app.chartData3.labels = resp.data.labels;
        app.chartData3.series = resp.data.series;
        console.log('hha',resp.data.labels)
      })
      .catch(function (resp) {
        alert("Could not load riwayat_penjualan");
      });
    },
    rentangWaktu(){
      var app = this;
      var awal_tanggal = new Date();
      awal_tanggal.setDate(1);
      app.filter.dari_tanggal = awal_tanggal;
      app.filter.sampai_tanggal = new Date();
      $('#rentang_waktu1').toggle();
      $('#rentang_waktu2').toggle();
      $('#rentang_waktu3').toggle();
    },
    submitPostRiwayatTransaksi()
    {
      var app = this;
      var filter = app.filter;
      app.getGrafikPenjualanHarian();
      app.getGrafikPenjualanProdukTeratas();
    },
  }
}
</script>