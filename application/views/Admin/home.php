<script src="<?php echo base_url()?>assets/grafik/code/highcharts.js"></script>
<script src="<?php echo base_url()?>assets/grafik/code/modules/exporting.js"></script>
<script src="<?php echo base_url()?>assets/grafik/code/modules/export-data.js"></script>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">
  <div class="col-xl-12 col-md-12 mb-12">

  <div class="card shadow mb-4 col-md-12">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Dashboard Aplikasi Potensi Pajak</h5>
      <div class="offset-8">
        
      <select class="form-control" id="tahun" onchange="getgraf(this.value)">
        <option>-- Pilih Tahun --</option>
        <?php 
        $sql2 = $this->db->query("SELECT DISTINCT YEAR(tgl_peramalan) as tahun FROM tbl_peramalan")->result();
        foreach ($sql2 as $sq2) {
        ?>
        <option value="<?php echo $sq2->tahun?>"><?php echo $sq2->tahun?></option>
        <?php } ?>
      </select>
      </div>
    </div>
    <div class="card-body">
      <div id="dtgraf">
          <!-- <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div> -->
      </div>
    </div>
</div>
</div>
</div>
</div>

    <script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Grafik Perbandingan'
    },
    subtitle: {
        text: 'Penjualan aktual dan hasil peramalan'
    },
    xAxis: {
        categories: 
        [
        <?php foreach ($bulan as $bln) {
        ?>
        '<?php echo date("M Y", strtotime($bln->bln))?>',
        <?php }?>
        ]
    },
    yAxis: {
        title: {
            text: 'Jumlah Penjualan'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Penjualan Aktual',
        data: 
        [
        <?php foreach ($pnj as $pj) { ?>
          <?php echo $pj->total;?>,
        <?php }?>
        ]
    }, {
        name: 'Peramalan Penjualan',
        data: 
        [
        <?php foreach ($prm as $pr) { ?>
          <?php echo $pr->total;?>,
        <?php }?>
        ]
    }]
});
    </script>

<script type="text/javascript">
  function getgraf(val){
    var tahun = document.getElementById('tahun').value;
    $.ajax({
        type: "POST",
        data: ({tahun : ""+val}),
        url: "<?php echo base_url()?>Admin/Home/get_graf",
        success: function(data) {
            $("#dtgraf").html(data);
            
        }
    });
    //alert(val);
  }
</script>