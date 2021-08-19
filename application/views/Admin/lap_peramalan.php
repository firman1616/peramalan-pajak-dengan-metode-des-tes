<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12 col-md-12 mb-12">

      <div class="card shadow mb-4 col-md-12">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Laporan Peramalan</h6>
        </div>
        <div class="card-body">

          <div class="form-group row">
            <div class="col-md-2">
              Masukan Parameter
            </div>
            <!-- bulan -->
            <div class="col-md-4">
              <select name="bln" id="bln" class="form-control">
                <option>-- Bulan --</option>
                <?php
                $bulan = $this->db->query("SELECT DISTINCT MONTH( tgl_peramalan ) AS Bulan FROM tbl_peramalan")->result();
                foreach ($bulan as $bln) {
                ?>
                  <option value="<?php echo $bln->Bulan ?>"><?php echo $bln->Bulan ?></option>
                <?php } ?>
              </select>
            </div>
            <!-- End Bulan -->
            <div class="col-md-4">
              <select name="thn" id="thn" class="form-control">
                <option>-- Tahun --</option>
                <?php
                $sql = $this->db->query("SELECT DISTINCT YEAR(tgl_peramalan) as Tahun 
          FROM tbl_peramalan")->result();
                foreach ($sql as $sq) {
                ?>
                  <option value="<?php echo $sq->Tahun ?>"><?php echo $sq->Tahun ?></option>
                <?php } ?>
              </select>
            </div>

          </div>
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="get_lap()"><i class="fas fa-search fa-sm text-white-50"></i> Cari</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid" id="dtgraf">

</div>
<!-- /.container-fluid -->

</div>

<script type="text/javascript">
  function get_lap() {
    var thn = document.getElementById('thn').value;
    var bln = document.getElementById('bln').value;
    $.ajax({
      type: "POST",
      data: ({
        tahun: "" + thn,
        bulan: "" + bln
      }),
      url: "<?php echo base_url() ?>Admin/Lap_Peramalan/get_lap",
      success: function(data) {
        $("#dtgraf").html(data);

      }
    });
    // alert(brg);
  }
</script>