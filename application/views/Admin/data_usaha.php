<div class="container-fluid">
  <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
  <div class="row">

    <?php
    if ($usaha == '3') { ?>
      <!-- <div class="col-xl-12 col-md-12 mb-12">

        <div class="card shadow mb-4 col-md-12">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Usaha</h6>
          </div>
          <div class="card-body">
            <form class="user" action="<?php echo base_url('admin/usaha/tambah_data') ?>" method="post">
              <div class="form-group row">
                <div class="col-md-2">
                  Nama Usaha :
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="nama_usaha">
                </div>
              </div>
              <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> Simpan</button>
            </form>
          </div>
        </div>
      </div> -->
    <?php } else { ?>
      <div class="col-xl-12 col-md-12 mb-12">

        <div class="card shadow mb-4 col-md-12">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Usaha</h6>
          </div>
          <div class="card-body">
            <form class="user" action="<?php echo base_url('admin/usaha/tambah_data') ?>" method="post">
              <div class="form-group row">
                <div class="col-md-2">
                  Nama Usaha :
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="nama_usaha">
                </div>
              </div>
              <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> Simpan</button>
            </form>
          </div>
        </div>
      </div>
    <?php }
    ?>

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

<div class="container-fluid">

  <!-- Page Heading -->
  <!--           <h1 class="h3 mb-2 text-gray-800">Tabel data barang</h1> -->
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Usaha</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Usaha</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($user as $u) { ?>
              <tr>
                <td><?php echo $no++; ?>.</td>
                <td><?php echo $u->nama_usaha; ?></td>
                <td>
                  <a class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" href="<?php echo base_url('index.php/admin/usaha/edit_data/') . $u->id_usaha ?>"><i class="fas fa-edit fa-sm text-white-50"></i></a>
                  <!-- <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" href="<?php echo base_url('index.php/admin/usaha/hapus_data/') . $u->id_usaha ?>"><i class="fas fa-trash fa-sm text-white-50"></i></a> -->
                </td>
              </tr>
            <?php }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>