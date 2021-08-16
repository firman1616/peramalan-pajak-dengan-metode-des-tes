<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_Keuntungan extends CI_Controller {

	public function index(){
		$data['navigation'] = 'navigation/nav';
    	$data['content']= 'admin/lap_keuntungan';
		$this->load->view('template/content',$data);
	}
	
	function get_lap(){
       /* echo '<br>'.*/$tahun = $this->input->post('barang');
       /* echo '<br>'.*/$th = substr($tahun,-4,4);
       /* echo '<br>'.*/$brg = substr($tahun,0,-4); // PHP di Dunia

        $dt = $this->db->query("
            SELECT *
            FROM tbl_barang WHERE nama_barang = '$brg'")->result();
        foreach ($dt as $d) {
        $idb = $d->kode_barang;
        }
        $bulan = $this->db->query("
            SELECT *, SUM(pj.jumlah) as jml
            FROM tbl_penjualan1  pj 
            JOIN tbl_barang tb ON tb.kode_barang = pj.kode_barang
            WHERE YEAR(pj.periode) = '$th' AND pj.kode_barang = '$idb'
            GROUP BY DATE_FORMAT(pj.periode, '%Y-%m')
            ORDER BY DATE_FORMAT(pj.periode, '%Y-%m') ASC
            ")->result();
    ?>
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Harga Beli</th>
                      <th>Harga Jual</th>
                      <th>Jumlah Penjualan</th>
                      <th>Jumlah Keuntungan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=1;
                    foreach ($bulan as $u) {?>
                      <tr>
                        <td><?php echo $no++; ?>.</td>
                        <td>Rp. <?php echo number_format($u->harga_beli); ?></td>
                        <td>Rp. <?php echo number_format($u->harga_jual); ?></td>
                        <td><?php echo $u->jml; ?></td>
                        <td>Rp. <?php echo number_format(($u->jml*$u->harga_jual)-($u->jml*$u->harga_beli)); ?></td>
                      </tr>
                    <?php }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
    <?php
    }
}
