<style type="text/css">
#chartdiv {
  width : 100%;
  height  : 5000px;
}
.card {
  display: inline-block;
  position: relative;
  width: 100%;
  margin-top: 100px;
  border-radius: 10px;
  color: rgba(0,0,0, 0.87);
  background: #fff;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}
.card .header-primary {
  background: linear-gradient(60deg, #ab47bc, #7b1fa2);
}
.card .header-info {
  background: linear-gradient(60deg, #29b6f6, #0288d1);
}
.card .header-success {
  background: linear-gradient(60deg, #66bb6a, #388e3c);
}
.card .header-warning {
  background: linear-gradient(60deg, #fdd835, #fbc02d);
}
.card .header-danger {
  background: linear-gradient(60deg, #ef5350, #d32f2f);
}
.card [class*="header-"] {
  color: #FFFFFF;
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
.card .header {
  box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
  margin-bottom: 60px;
  margin-left: 15px;
  margin-right: 15px;
  margin-top: -30px;
  border-radius: 10px;
  padding: 10px 0;
  background-color: #FFFFFF;
}
h4 {
  padding-left: 20px;
}
</style>
<template>
  <div class="container">
    <div class="row">
      <div class="">
        <p>{{ msg }}</p>
        <div id="chartdiv" style="width: 100%; height: 400px;"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
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
              <div class="tab-pane active" id="profile">
                <h1><chartjs-horizontal-bar></chartjs-horizontal-bar></h1>
              </div>
              <div class="tab-pane" id="messages">
                <p> I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
              </div>
              <div class="tab-pane" id="settings">
                <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
              </div>
            </div>
          </div>
        </div>
      </div>      
      <div class="col-md-4">
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
              <div class="tab-pane active" id="profile">
                <h1><chartjs-polar-area></chartjs-polar-area></h1>
              </div>
              <div class="tab-pane" id="messages">
                <p> I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
              </div>
              <div class="tab-pane" id="settings">
                <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
              </div>
            </div>
          </div>
        </div>
      </div>      
      <div class="col-md-4">
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
              <div class="tab-pane active" id="profile">
                <h1><chartjs-horizontal-bar></chartjs-horizontal-bar></h1>
              </div>
              <div class="tab-pane" id="messages">
                <p> I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
              </div>
              <div class="tab-pane" id="settings">
                <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      msg: 'Laporan Penjualan per hari'
    }
  },
  created () {
   var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "marginRight": 40,
    "marginLeft": 40,
    "autoMarginOffset": 20,
    "mouseWheelZoomEnabled":true,
    "dataDateFormat": "YYYY-MM-DD",
    "valueAxes": [{
      "id": "v1",
      "axisAlpha": 0,
      "position": "left",
      "ignoreAxisWidth":true
    }],
    "balloon": {
      "borderThickness": 1,
      "shadowAlpha": 0
    },
    "graphs": [{
      "id": "g1",
      "balloon":{
        "drop":true,
        "adjustBorderColor":false,
        "color":"#ffffff"
      },
      "bullet": "round",
      "bulletBorderAlpha": 1,
      "bulletColor": "#FFFFFF",
      "bulletSize": 5,
      "hideBulletsCount": 50,
      "lineThickness": 2,
      "title": "red line",
      "useLineColorForBulletBorder": true,
      "valueField": "value",
      "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
    }],
    "chartScrollbar": {
      "graph": "g1",
      "oppositeAxis":false,
      "offset":30,
      "scrollbarHeight": 80,
      "backgroundAlpha": 0,
      "selectedBackgroundAlpha": 0.1,
      "selectedBackgroundColor": "#888888",
      "graphFillAlpha": 0,
      "graphLineAlpha": 0.5,
      "selectedGraphFillAlpha": 0,
      "selectedGraphLineAlpha": 1,
      "autoGridCount":true,
      "color":"#AAAAAA"
    },
    "chartCursor": {
      "pan": true,
      "valueLineEnabled": true,
      "valueLineBalloonEnabled": true,
      "cursorAlpha":1,
      "cursorColor":"#258cbb",
      "limitToGraph":"g1",
      "valueLineAlpha":0.2,
      "valueZoomable":true
    },
    "valueScrollbar":{
      "oppositeAxis":false,
      "offset":50,
      "scrollbarHeight":10
    },
    "categoryField": "date",
    "categoryAxis": {
      "parseDates": true,
      "dashLength": 1,
      "minorGridEnabled": true
    },
    "export": {
      "enabled": true
    },
    "dataProvider": [{
      "date": "2012-07-27",
      "value": 13
    }, {
      "date": "2012-07-28",
      "value": 11
    }, {
      "date": "2012-07-29",
      "value": 15
    }, {
      "date": "2012-07-30",
      "value": 16
    }, {
      "date": "2012-07-31",
      "value": 18
    }, {
      "date": "2012-08-01",
      "value": 13
    }, {
      "date": "2012-08-02",
      "value": 22
    }, {
      "date": "2012-08-03",
      "value": 50
    }]
  });

   chart.addListener("rendered", zoomChart);

   zoomChart();

   function zoomChart() {
    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
  }
}
}
</script>