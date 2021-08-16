<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pendapatan Sumber Hidup</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hari dan Tanggal</th>
                            <th>Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            if ($i < 10) {
                                $i = "0" . $i;
                            }
                        ?>
                            <tr>
                                <td scope="row"><?php echo $i; ?></td>
                                <td>
                                    <?php echo hari_helpers(date('l', strtotime($this->input->get("param") . "-" . $i))) . ", " . reverseNormalFormatDate_helper($this->input->get("param") . "-" . $i); ?>
                                </td>
                                <td>
                                    Rp. <?php
                                        $tgl = $this->input->get("param") . "-" . $i;
                                        $nama = $this->input->get("nama");
                                        $query_tgl = $this->db->query("SELECT SUM( jumlah_pendapatan ) AS total FROM tbl_pendapatan WHERE tgl_pendapatan LIKE '%$tgl%' AND id_usaha = '4'");
                                        foreach ($query_tgl->result() as $row) {
                                            echo number_format($row->total);
                                        }
                                        ?> ,-
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->