<div class="container-fluid">
  <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
  <div class="row">
    <div class="col-xl-12 col-md-12 mb-12">

      <div class="card shadow mb-4 col-md-12">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pendapatan</h6>
        </div>
        <div class="card-body">
          <form class="user" action="<?php echo base_url('admin/pendapatan/tambah_data') ?>" method="post">
            <div class="form-group row">
              <div class="col-md-4">
                Periode Tahun / Bulan:
              </div>
              <div class="col-md-4">
                <input type="date" class="form-control" name="tgl_pendapatan" required>
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
                <select class="form-control" name="id_usaha" required>
                  <option>Pilih Salah Satu ...</option>
                  <?php
                  foreach ($ush as $u) { ?>
                    <option value='<?php echo $u->id_usaha . '*' . $u->nama_usaha; ?>'><?php echo $u->id_usaha . '/' . $u->nama_usaha; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                Jumlah :
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" name="jumlah" placeholder="Jumlah" required>
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

<div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg1">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url('index.php/admin/Pendapatan/import/') ?>" enctype="multipart/form-data" accept-charset="utf-8">
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
                foreach ($ush as $u) { ?>
                  <option value='<?php echo $u->id_usaha . '*' . $u->nama_usaha; ?>'><?php echo $u->id_usaha . '/' . $u->nama_usaha; ?></option>
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
  });
</script>