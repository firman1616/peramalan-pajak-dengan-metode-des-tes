<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_peramalan extends CI_Controller
{

  public function index()
  {
    $data['title'] = 'Laporan Peramalan';
    $data['navigation'] = 'navigation/nav';
    $data['content'] = 'admin/lap_peramalan';
    $this->load->view('template/content', $data);
  }

  function get_lap()
  {
    /* echo '<br>'.*/
    $tahun = $this->input->post('tahun');
    $bulan = $this->input->post('bulan');
    /* echo '<br>'.*/
    $th = substr($tahun, -4, 4);
    /* echo '<br>'.*/
    $brg = substr($tahun, 0, -4); // PHP di Dunia

    $brown = $this->db->query("
            SELECT tf.tgl_peramalan, tf.alpha, tf.step1, tf.step2, tf.step3, tf.step4, tf.step5, tf.id_peramalan, tf.rmse
            FROM tbl_peramalan tf 
            GROUP BY DATE_FORMAT(tf.tgl_peramalan, '%Y-%m')
            ORDER BY DATE_FORMAT(tf.tgl_peramalan, '%Y-%m') ASC
            ")->result();

    $winter = $this->db->query("
            SELECT tf.tgl_peramalan_winter, tf.alpha_winter, tf.abg_winter, tf.st_winter, tf.bt_winter, tf.lt_winter, tf.ftm_winter, tf.id_peramalan_winter, tf.rmse_winter
            FROM tbl_peramalan_winter tf 
            GROUP BY DATE_FORMAT(tf.tgl_peramalan_winter, '%Y-%m')
            ORDER BY DATE_FORMAT(tf.tgl_peramalan_winter, '%Y-%m') ASC
            ")->result();
?>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Peramalan Brown</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Alpha</th>
                <th>Data Aktual</th>
                <th>S <sup>'</sup><sub>t</sub></th>
                <th>S <sup>''</sup><sub>t</sub></th>
                <th>a <sub>t</sub></th>
                <th>b <sub>t</sub></th>
                <th>f <sub>t + m</sub></th>
                <th>RMSE</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $x = 1;
              foreach ($brown as $u) {
                /*echo '<br>'.*/
                $tglb = date("Y-m", strtotime($u->tgl_peramalan));
              ?>
                <tr>
                  <td><?php echo $x; ?>.</td>
                  <td><?php echo date("Y/m", strtotime($u->tgl_peramalan)); ?></td>
                  <td><?php echo $u->alpha; ?></td>
                  <td>Rp. <?php
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
                  <td><?php echo $u->step1; ?></td>
                  <td><?php echo $u->step2; ?></td>
                  <td><?php echo $u->step3; ?></td>
                  <td><?php echo $u->step4; ?></td>
                  <td><?php echo $u->step5; ?></td>
                  <td><?php echo $u->rmse; ?></td>
                </tr>
              <?php $x++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Peramalan Holt Winter</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
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
              </tr>
            </thead>
            <tbody>
              <?php
              $xx = 1;
              foreach ($winter as $w) {
                /*echo '<br>'.*/
                $tglb = date("Y-m", strtotime($w->tgl_peramalan_winter));
              ?>
                <tr>
                  <td><?php echo $xx; ?>.</td>
                  <td><?php echo date("Y/m", strtotime($w->tgl_peramalan_winter)); ?></td>
                  <!-- <td><?php echo $w->alpha_winter; ?></td> -->
                  <td>Rp. <?php
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
                  <td><?php echo $w->abg_winter; ?></td>
                  <td><?php echo $w->st_winter; ?></td>
                  <td><?php echo $w->bt_winter; ?></td>
                  <td><?php echo $w->lt_winter; ?></td>
                  <td><?php echo $w->ftm_winter; ?></td>
                  <td><?php echo $w->rmse_winter; ?></td>
                </tr>
              <?php $xx++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<?php
  }
}
