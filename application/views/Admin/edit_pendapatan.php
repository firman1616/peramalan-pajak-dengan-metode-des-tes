<?php
foreach ($user->result() as $u){
  $id_pendapatan = $u->id_pendapatan;
  $tgl_pendapatan = $u->tgl_pendapatan;
  $id_usaha = $u->id_usaha;
  $jumlah = $u->jumlah_pendapatan;
}
?>
<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Ubah Data Pendapatan</h1>
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
<!-- DataTales Example -->
          <div class="card shadow mb-4 col-md-6">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Ubah Pendapatan</h6>
            </div>
            <div class="card-body">
              <form class="user" action="<?php echo base_url('admin/Pendapatan/update_data/').$id_pendapatan ?>" method="post">
                <div class="form-group row">
                  <div class="col-md-4">
                    Tgl Pendapatan :
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="tgl_pendapatan" value="<?php echo date("d F Y", strtotime($tgl_pendapatan));?>" placeholder="Periode" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    ID Usaha :
                  </div>
                  <div class="col-md-8">
                    <select class="form-control" name="id_usaha">
                    <?php
                      foreach ($user2 as $u) {?>
                          <option value='<?php echo $u->id_usaha.'*'.$u->nama_usaha;?>' <?php if ($u->id_usaha==$id_usaha) { echo "selected" ;}?>><?php echo $u->id_usaha.'/'.$u->nama_usaha;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                 <div class="form-group row">
                  <div class="col-md-4">
                    Jumlah :
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="jumlah" value="<?php echo $jumlah?>" placeholder="Jumlah">
                  </div>
                </div>
                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Ubah</button>
              </form>
            </div>
        </div>
    </div>
