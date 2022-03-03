<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- Conten -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-12">

            <div class="card shadow mb-4 col-md-12">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Peramalan</h6>
                </div>
                <div class="card-body">

                    <form class="user" action="<?php echo base_url('admin/peramalan/hitung') ?>" method="post">
                        <div class="form-group row">
                            <div class="col-md-4">
                                Periode :
                            </div>
                            <?php
                            $Bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                            $Tahun = array();
                            // $Tahun = array("2015", "2016", "2017", "2018","2019");
                            $stahun = $this->db->query("SELECT DISTINCT YEAR(tgl_pendapatan) as tahun FROM tbl_pendapatan ORDER BY YEAR(tgl_pendapatan) ASC")->result();
                            foreach ($stahun as $th) {
                                $Tahun[] = $th->tahun;
                            }
                            $kons = array("0.1", "0.2", "0.3", "0.4", "0.5", "0.6", "0.7", "0.8", "0.9");
                            $arrlength1 = count($Bulan);
                            $arrlength2 = count($Tahun);
                            $arrlength3 = count($kons);
                            ?>
                            <div class="col-md-4">
                                <select class="form-control" id="bln" name="bln" required>
                                    <option>Pilih Bulan</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Febuari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" id="thn" name="thn" required>
                                    <option>Pilih Tahun ...</option>
                                    <?php
                                    for ($y = 0; $y < $arrlength2; $y++) {
                                        echo "<option value='" . $Tahun[$y] . "'>";
                                        echo $Tahun[$y];
                                        echo "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                Pilih Alpha :
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="alpha" id="alpha" required>
                                    <option value="0.1">0.1</option>
                                    <option value="0.2">0.2</option>
                                    <option value="0.3">0.3</option>
                                    <option value="0.4">0.4</option>
                                    <option value="0.5">0.5</option>
                                    <option value="0.6">0.6</option>
                                    <option value="0.7">0.7</option>
                                    <option value="0.8">0.8</option>
                                    <option value="0.9">0.9</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="dtmad">
                        </div>
                        <button type="submit" class="d-none d-md-inline-block btn btn-md btn-info shadow-md"><i class="fas fa-calculator fa-md text-white-50"></i> Hitung Peramalan</button>
                        <!--  <button type="button" class="d-none d-md-inline-block btn btn-md btn-warning shadow-md" onclick="cek_mad_3_tahun()"><i class="fas fa-calculator fa-md text-white-50"></i> Cek Mad</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-12">

            <div class="card shadow mb-4 col-md-12">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Peramalan</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Periode</th>
                                <th scope="col">Data Aktual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->