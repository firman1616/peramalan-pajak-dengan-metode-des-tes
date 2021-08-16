<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Ayam Brewok</h1>

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pendapatan Ayam Brewok</h6>
                        </div>
                        <div class="card-body">
                            <!-- <div class="row">
                                <div class="col-md-4 col-lg-4 col-xs-4">
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="">Pilih Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Febuari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>

                                <div class="col-md-4 col-lg-4 col-xs-4">
                                  <?php
                                    $now=date('Y');
                                    $ymin=$now-5;
                                    echo "<select name='tahun' class=form-control required>";
                                    echo "<option value=''>Pilih Tahun</option>";
                                    for($a=$now;$a>=$ymin;--$a)
                                    {
                                        echo "<option value='$a'>$a</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </div>

                                <button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Cari Data
                                </button>
                            </div> -->

                            <br>
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tgl Pendapatan</th>
                      <th>ID Usaha</th>
                      <th>Nama Usaha</th>
                      <th>Jumlah Pendapatan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=1;
                    foreach ($bw as $u) {
                      $idu = $u->id_usaha;
                      $tgl = date("m-Y",strtotime($u->tgl_pendapatan));
                      ?>
                      <tr>
                        <td><?php echo $no++; ?>.</td>
                        <td><?php echo date("F Y", strtotime($u->tgl_pendapatan));?></td>
                        <td><?php echo $u->id_usaha; ?></td>
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
                                  <!-- id="dataTable2" -->
                                    <table class="table table-bordered" width="100%" cellspacing="0">
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