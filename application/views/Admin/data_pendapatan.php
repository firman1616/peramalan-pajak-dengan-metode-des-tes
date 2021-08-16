<div class="container-fluid">
  <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
  <div class="row">
  <div class="col-xl-12 col-md-12 mb-12">

  <div class="card shadow mb-4 col-md-12">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pendapatan</h6>
    </div>
    <div class="card-body">
      <form class="user" action="<?php echo base_url('admin/pendapatan/tambah_data')?>" method="post">
        <div class="form-group row">
          <div class="col-md-4">
            Periode Tahun / Bulan:
          </div>
          <div class="col-md-4">
            <input type="date" class="form-control" name="tgl_pendapatan">
          </div>
          <!-- <div class="col-md-2">
            <h4 style="padding-top: 5px"><center>/</center></h4>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" name="bulan" placeholder="04">
          </div> -->
        </div>
        <div class="form-group row">
          <div class="col-md-4">
            ID Usaha :
          </div>
          <div class="col-md-4">
            <select class="form-control" name="id_usaha">
              <option>Pilih Salah Satu ...</option>
            <?php
              foreach ($ush as $u) {?>
                  <option value='<?php echo $u->id_usaha.'*'.$u->nama_usaha;?>'><?php echo $u->id_usaha.'/'.$u->nama_usaha;?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-4">
            Jumlah :
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah">
          </div>
        </div>
        <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> Simpan</button>
         <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target=".bs-example-modal-lg1"><i class="fas fa-upload fa-sm text-white-50"></i> Import Data</button>
         
      </form>
    </div>
</div>
</div>
</div>
</div>

<div class="container-fluid">

          <!-- Page Heading -->
<!--           <h1 class="h3 mb-2 text-gray-800">Tabel Data Penjualan</h1> -->
<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Pendapatan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tgl Pendapatan</th>
                      <!-- <th>ID Usaha</th> -->
                      <th>Nama Usaha</th>
                      <th>Jumlah Pendapatan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                    $no=1;
                    foreach ($user as $u) {
                      $idu = $u->id_usaha;
                      $tgl = date("m-Y",strtotime($u->tgl_pendapatan));
                      ?>
                      <tr>
                        <td><?php echo $no++; ?>.</td>
                        <td><?php echo date("F Y", strtotime($u->tgl_pendapatan));?></td>
                        <!-- <td><?php echo $u->id_usaha; ?></td> -->
                        <td><?php echo $u->nama_usaha; ?></td>
                        <td>Rp. <?php echo number_format($u->ttl) ?></td>
                        <td>
                          <a class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#myModal<?php echo $u->id_pendapatan;?>"><i class="fas fa-eye fa-sm text-white-50"></i> Detail</a>
                          <!-- Modal -->
                          <div id="myModal<?php echo $u->id_pendapatan;?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <span>Detail Pendapatan <?php echo $u->nama_usaha;?></span>
                                </div>
                                <div class="modal-body">
                                  <div class="table-responsive col-md-12">
                                    <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                      <thead>
                                        <tr>
                                          <th>No</th>
                                          <th>Tgl Pendapatan</th>
                                          <th>Jumlah Pendapatan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php 
                                        $noo = 1;
                                        $sq = $this->db->query("SELECT * FROM tbl_pendapatan WHERE id_usaha = '$idu' AND DATE_FORMAT(tgl_pendapatan,'%m-%Y') = '$tgl' ORDER BY tgl_pendapatan ASC")->result();
                                        foreach ($sq as $sq1) {
                                        ?>
                                        <tr>
                                          <td><?php echo $noo++;?></td>
                                          <td><?php echo date('d F Y', strtotime($sq1->tgl_pendapatan));?></td>
                                          <td>Rp. <?php echo number_format($sq1->jumlah_pendapatan);?></td>
                                        </tr>
                                        <?php }?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Tutup</button>
                                </div>
                              </div>

                            </div>
                          </div>
                         <!--  <a class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" href="<?php echo base_url('index.php/admin/Pendapatan/edit_data/').$u->id_pendapatan ?>"><i class="fas fa-edit fa-sm text-white-50"></i> Ubah</a> -->
                          <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" href="<?php echo base_url('index.php/admin/Pendapatan/hapus_data/').$idu.''.$tgl ?>"><i class="fas fa-trash fa-sm text-white-50"></i> Hapus</a>
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
<div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg1">
                      <div class="modal-content">
                        <form method="post" action="<?php echo base_url('index.php/admin/Pendapatan/import/')?>" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="modal-header">
                         <!--  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        <h4 class="modal-title" id="myModalLabel">Import Data </h4> -->
                        </div>
                        <div class="modal-body">
                          <div class="form-group row">
                          <div class="col-md-4">
                            ID Usaha :
                          </div>
                          <div class="col-md-12">
                            <select class="form-control" name="id_usaha">
                              <option>Pilih Salah Satu ...</option>
                            <?php
                              foreach ($ush as $u) {?>
                                  <option value='<?php echo $u->id_usaha.'*'.$u->nama_usaha;?>'><?php echo $u->id_usaha.'/'.$u->nama_usaha;?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-4">
                            File :
                          </div>
                          <div class="col-md-12">
                            <input class="form-control" type="file" name="userfile" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-dabger" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('dataTable_2').DataTable();
} );
</script>