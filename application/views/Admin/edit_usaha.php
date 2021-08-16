<?php
foreach ($user->result() as $u){
  $id_usaha = $u->id_usaha;
  $nama_usaha = $u->nama_usaha;
}
?>
<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Ubah data Usaha</h1>
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
<!-- DataTales Example -->
          <div class="card shadow mb-12 col-md-12">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form ubah usaha</h6>
            </div>
            <div class="card-body">
              <form class="user" action="<?php echo base_url('index.php/admin/usaha/update_data/').$id_usaha ?>" method="post">
                <div class="form-group row">
                <div class="col-md-2">
                  Nama Usaha :
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="nama_usaha" placeholder="Nama Usaha" value="<?php echo $nama_usaha;?>">
                </div>
              </div>
                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Ubah</button>
              </form>
            </div>
        </div>
    </div>
