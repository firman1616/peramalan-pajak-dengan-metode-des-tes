<div class="container-fluid">
  <div class="row">
  <div class="col-xl-12 col-md-12 mb-12">

  <div class="card shadow mb-4 col-md-12">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Keuntungan</h6>
    </div>
    <div class="card-body">
      
        <div class="form-group row">
          <div class="col-md-2">
           Pilih Tahun
          </div>
          <div class="col-md-4">
            <select name="thn" id="thn" class="form-control">
              <option>-- Pilih Obat --</option>
              <?php 
        $sql = $this->db->query("SELECT b.nama_barang, YEAR(f.periode) as Tahun 
          FROM tbl_penjualan1 f 
          JOIN tbl_barang b ON  b.kode_barang = f.kode_barang
          GROUP BY f.kode_barang, YEAR(f.periode)")->result();
        foreach ($sql as $sq) {
        ?>
        <option value="<?php echo $sq->nama_barang.''.$sq->Tahun?>"><?php echo $sq->nama_barang.' - Tahun '.$sq->Tahun?></option>
        <?php } ?>
            </select>
          </div>
          
        </div>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="get_lap()"><i class="fas fa-search fa-sm text-white-50"></i> Cari</button>
    </div>
</div>
</div>
<!-- <div class="col-xl-6 col-md-6 mb-6">
  <div class="card shadow mb-4 col-md-12">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tips</h6>
    </div>
    <div class="card-body">
      <form>
        <div class="form-group row">
          <div class="col-md-4">
            Kode Barang :
          </div>
          <div class="col-md-8">
            <input type="text" class="form-control" name="kd_barang" placeholder="002" disabled="disabled">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-4">
            Nama Barang :
          </div>
          <div class="col-md-8">
            <input type="text" class="form-control" name="nm_barang" placeholder="Enervon" disabled="disabled">
          </div>
        </div>
      </form>
    </div>
</div>
</div> -->
</div>
</div>

<div class="container-fluid" id="dtgraf">

          <!-- Page Heading -->
<!--           <h1 class="h3 mb-2 text-gray-800">Tabel data barang</h1> -->
<!-- DataTales Example -->

        </div>
        <!-- /.container-fluid -->

      </div>

<script type="text/javascript">
  function get_lap(){
    var brg = document.getElementById('thn').value;
    $.ajax({
        type: "POST",
        data: ({barang : ""+brg}),
        url: "<?php echo base_url()?>Admin/Lap_Keuntungan/get_lap",
        success: function(data) {
            $("#dtgraf").html(data);
            
        }
    });
    // alert(brg);
  }
</script>