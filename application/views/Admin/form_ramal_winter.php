<?php

?>
<div class="container-fluid">
  <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
  <!-- Page Heading -->
  <div class="row">
    <div class="col-xl-12 col-md-12 mb-12">

      <div class="card shadow mb-4 col-md-12">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Form Peramalan Holt Winter</h6>
        </div>
        <div class="card-body">

          <form class="user" action="<?php echo base_url('admin/peramalan_winter/perhitungan') ?>" method="post">
            <!-- <div class="form-group row">
                  <div class="col-md-4">
                    Nama Barang :
                  </div>
                  <div class="col-md-8">
                    <select class="form-control" name="kode_barang" id="kd">
                      <option>Pilih Kode Barang ...</option>
                    <?php
                    foreach ($user as $u) { ?>
                          <option value='<?php echo $u->kode_barang; ?>'><?php echo $u->kode_barang . '/' . $u->nama_barang; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div> -->
            <div class="form-group row">
              <div class="col-md-4">
                Periode :
              </div>
              <?php
              $Bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
              $Tahun = array();
              // $Tahun = array("2015", "2016", "2017", "2018","2019");
              $stahun = $this->db->query("SELECT DISTINCT YEAR(tgl_pendapatan) as tahun FROM tbl_pendapatan ORDER BY YEAR(tgl_pendapatan) ASC")->result();
              foreach ($stahun as $th) {
                $Tahun[] = $th->tahun;
              }
              $kons = array("0.1", "0.2", "0.3", "0.4", "0.5", "0.6", "0.7", "0.8", "0.9");
              $arrlength1 = count($Bulan);
              $arrlength2 = count($Tahun);
              $arrlength3 = count($kons);
              ?>
              <div class="col-md-4">
                <select class="form-control" id="bln" name="bln">
                  <option>Pilih Bulan ...</option>
                  <option value="1"><?php echo $Bulan[1] . ', ' . $Bulan[2] . ', ' . $Bulan[3] ?></option>
                  <option value="4"><?php echo $Bulan[4] . ', ' . $Bulan[5] . ', ' . $Bulan[6] ?></option>
                  <option value="7"><?php echo $Bulan[7] . ', ' . $Bulan[8] . ', ' . $Bulan[9] ?></option>
                  <option value="10"><?php echo $Bulan[10] . ', ' . $Bulan[11] . ', ' . $Bulan[12] ?></option>
                </select>
              </div>
              <div class="col-md-4">
                <select class="form-control" id="thn" name="thn">
                  <option>Pilih Tahun ...</option>
                  <?php
                  for ($y = 0; $y < $arrlength2; $y++) {
                    echo "<option value='" . $Tahun[$y] . "'>";
                    echo $Tahun[$y];
                    echo "</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                Pilih Alpha, Beta, & Gamma :
              </div>
              <!-- Alpha -->
              <div class="col-md-2">
                <select class="form-control" name="alpha" id="alpha" required>
                  <option value="">Pilih Alpha</option>
                  <option value="0.1">0.1</option>
                  <option value="0.2">0.2</option>
                  <option value="0.3">0.3</option>
                  <option value="0.4">0.4</option>
                  <option value="0.5">0.5</option>
                  <option value="0.6">0.6</option>
                  <option value="0.7">0.7</option>
                  <option value="0.8">0.8</option>
                  <option value="0.9">0.9</option>
                </select>
              </div>
              <!-- End Alpa -->

              <!-- Beta -->
              <div class="col-md-2">
                <select class="form-control" name="beta" id="beta" required>
                  <option value="">Pilih Beta</option>
                  <option value="0.1">0.1</option>
                  <option value="0.2">0.2</option>
                  <option value="0.3">0.3</option>
                  <option value="0.4">0.4</option>
                  <option value="0.5">0.5</option>
                  <option value="0.6">0.6</option>
                  <option value="0.7">0.7</option>
                  <option value="0.8">0.8</option>
                  <option value="0.9">0.9</option>
                </select>
              </div>
              <!-- End Beta -->

              <!-- Gamma -->
              <div class="col-md-4">
                <select class="form-control" name="gamma" id="gamma" required>
                  <option value="">Pilih Gamma</option>
                  <option value="0.1">0.1</option>
                  <option value="0.2">0.2</option>
                  <option value="0.3">0.3</option>
                  <option value="0.4">0.4</option>
                  <option value="0.5">0.5</option>
                  <option value="0.6">0.6</option>
                  <option value="0.7">0.7</option>
                  <option value="0.8">0.8</option>
                  <option value="0.9">0.9</option>
                </select>
              </div>
              <!-- End Gamma -->
            </div>
            <div class="form-group row" id="dtmad">
            </div>
            <button type="submit" class="d-none d-md-inline-block btn btn-md btn-info shadow-md"><i class="fas fa-calculator fa-md text-white-50"></i> Hitung Peramalan</button>
            <!--  <button type="button" class="d-none d-md-inline-block btn btn-md btn-warning shadow-md" onclick="cek_mad_3_tahun()"><i class="fas fa-calculator fa-md text-white-50"></i> Cek Mad</button> -->
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Hasil -->
  <div class="row">
    <div class="col-xl-12 col-md-12 mb-12">
      <div class="card shadow mb-4 col-md-12">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Hasil Peramalan Holt Winter</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Periode</th>
                  <!-- <th>Alpha</th> -->
                  <th>Data Aktual</th>
                  <th>a, B, Y</th>
                  <th>St</th>
                  <th>Bt</th>
                  <th>It</th>
                  <th>Ft+m</th>
                  <th>RMSE</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $x = 1;
                foreach ($user2 as $u) {
                  /*echo '<br>'.*/
                  $tglb = date("Y-m", strtotime($u->tgl_peramalan_winter));
                  $a = $u->alpha_winter;
                  $b = $u->beta;
                  $c = $u->gamma;
                ?>
                  <tr>
                    <td><?php echo $x; ?>.</td>
                    <td><?php echo date("Y/m", strtotime($u->tgl_peramalan_winter)); ?></td>
                    <!-- <td><?php echo $u->alpha_winter; ?></td> -->
                    <td><?php
                        $dt1 = $this->db->query("SELECT SUM(jumlah_pendapatan) as jumlah FROM tbl_pendapatan WHERE DATE_FORMAT(tgl_pendapatan,'%Y-%m') = '$tglb'")->num_rows();
                        if ($dt1 > 0) {
                          $dt = $this->db->query("SELECT SUM(jumlah_pendapatan) as jumlah FROM tbl_pendapatan WHERE DATE_FORMAT(tgl_pendapatan,'%Y-%m') = '$tglb'")->result();
                          foreach ($dt as $dtk) {
                            echo number_format($dtk->jumlah);
                            # code...
                          }
                        } else {
                          echo '0';
                        }
                        ?></td>
                    <td><?php echo $a . ', ' . $b . ', ' . $c; ?></td>
                    <td><?php echo number_format($u->st_winter); ?></td>
                    <td><?php echo number_format($u->bt_winter); ?></td>
                    <td><?php echo number_format($u->lt_winter); ?></td>
                    <td><?php echo number_format($u->ftm_winter); ?></td>
                    <td><?php echo number_format($u->rmse_winter); ?></td>
                    <td>
                      <center>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" href="<?php echo base_url('Admin/peramalan_winter/hapus/') . $u->id_peramalan_winter ?>"><i class="fas fa-trash fa-sm text-white-50"></i> Hapus</a>
                      </center>
                    </td>
                  </tr>
                <?php $x++;
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function cek_mad() {
      var alp = document.getElementById('alpha').value;
      var kd = document.getElementById('kd').value;
      var bln = document.getElementById('bln').value;
      var thn = document.getElementById('thn').value;
      $.ajax({
        type: "POST",
        data: ({
          alp: "" + alp,
          kd: "" + kd,
          bln: "" + bln,
          thn: "" + thn
        }),
        url: "<?php echo base_url('admin/forecast/cek_mad') ?>",
        success: function(data) {
          $("#dtmad").html(data);

        }
      });
    }

    function cek_mad_3_tahun() {
      var alp = document.getElementById('alpha').value;
      var kd = document.getElementById('kd').value;
      $.ajax({
        type: "POST",
        data: ({
          alp: "" + alp,
          kd: "" + kd
        }),
        url: "<?php echo base_url('admin/forecast/cek_mad_3_tahun') ?>",
        success: function(data) {
          $("#dtmad").html(data);

        }
      });
    }
  </script>