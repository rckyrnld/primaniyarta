<section id="main-content">
    <div class="wrapper site-min-height">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mb-2">
                    <div class="card rounded-0">
                        <div class="card-body">
                            <div class="bc">
                                <ul>
                                    <li><a href="<?php echo base_url('main/beranda'); ?>">Beranda</a></li>
                                    <li>Penjualan</li>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">PENJUALAN</p>
                                <?php
                                if(!empty($this->session->sessupdatepenjualan)) {
                                    ?>
                                    <div class="alert alert-<?php echo $this->session->sesscw; ?> rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdatepenjualan; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdatepenjualan');
                                            $this->session->unset_userdata('sesscw');
                                        ?>
                                    </div>
                                    <?php
                                }
                                if($this->primamod->cekform('penjualan', $this->decrypt_profilid)==FALSE) {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Form Nilai Penjualan belum diisi.
                                    </div>
                                    <?php
                                }
                                if($this->primamod->cekform('ekspor', $this->decrypt_profilid)==FALSE) {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Form Kegiatan Ekspor belum diisi.
                                    </div>
                                    <?php
                                }
                                if($this->primamod->cekform('survey_jual', $this->decrypt_profilid)==FALSE) {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Form Survey Penjualan belum diisi.
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="card rounded-0">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs" id="nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($page=="nilai") echo "active"; ?>"  href="<?php echo base_url('main/penjualan/nilai'); ?>">NILAI PENJUALAN</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($page=="ekspor") echo "active"; ?>" href="<?php echo base_url('main/penjualan/ekspor'); ?>">KEGIATAN EKSPOR</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($page=="survey") echo "active"; ?>" href="<?php echo base_url('main/penjualan/survey'); ?>">SURVEY PENJUALAN</a>
                                        </li>
                                        </ul>
                                    </div>
                                    <?php
                                    if($page=="nilai") {
                                        ?>
                                        <!-- nilai penjualan start -->
                                        <div class="card-body">
                                            <div class="row py-2">
                                                <form id="frmjual" name="frmjual" method="post" action="<?php echo base_url('main/simpannilai'); ?>">
                                                <input type="hidden" id="idjual" name="idjual" value="<?php echo $idjual; ?>">
                                                <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $idprofil; ?>">
                                                    <div class="row mb-2">
                                                        <label for="tahun" class="col-md-3 mb-2">Tahun</label>
                                                        <div class="col-md-2">
                                                            <select class="form-control rounded-0" id="tahun" name="tahun">
                                                                <option value=""></option>
                                                                <?php
                                                                $dt = date("Y");
                                                                $dt1 = $dt-1;
                                                                $dt2 = $dt-6; 
                                                                if(!empty($idjual)) {
                                                                    ?>
                                                                    <option value="<?php echo $vtahun; ?>" selected><?php echo $vtahun; ?></option>
                                                                    <?php
                                                                }
                                                                for ($i = $dt1; $i > $dt2; --$i) {
                                                                    if($this->primamod->cektahunpenjualan($idprofil, $i)==FALSE) {
                                                                        ?>
                                                                        <option value="<?php echo $i; ?>" <?php if($vtahun==$i) echo "selected"; ?>><?php echo $i; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="total_penjualan" class="col-md-3 mb-2">Total Penjualan (US$)</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control rounded-0" id="total_penjualan" name="total_penjualan" maxlength="20" value="<?php echo $vtotaljual; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="persen_ekspor" class="col-md-3 mb-2">Persen Ekspor (%)</label>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control rounded-0" id="persen_ekspor" name="persen_ekspor" maxlength="3" value="<?php echo $vpersenekspor; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="persen_ekspor" class="col-md-3 mb-2">Penjualan Ekspor (US$)</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control rounded-0" id="nilai_ekspor" name="nilai_ekspor" maxlength="20" value="<?php echo $vnilaiekspor; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="persen_lokal" class="col-md-3 mb-2">Persen Lokal (%)</label>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control rounded-0" id="persen_lokal" name="persen_lokal" maxlength="3" value="<?php echo $vpersenlokal; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="nilai_lokal" class="col-md-3 mb-2">Penjualan Lokal (US$)</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control rounded-0" id="nilai_lokal" name="nilai_lokal" maxlength="20" value="<?php echo $vnilailokal; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group py-2">
                                                        <div class="row">
                                                            <div class="col-lg-6 my-2">
                                                                <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                            </div>
                                                            <div class="col-lg-6 my-2">
                                                                <a class="btn btn-warning col-lg-6 form-control rounded-0" href="<?php echo base_url('main/penjualan/nilai'); ?>"><i class="fa-solid fa-rotate"></i> Reset</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="table-responsive py-3">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Tahun</th>
                                                            <th scope="col">Total Penjualan (US$)</th>
                                                            <th scope="col">Ekspor (US$)</th>
                                                            <th scope="col">Lokal (US$)</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $d = $jual->result();
                                                        $n = $jual->num_rows();
                                                        if($n > 0) {
                                                            for ($i = 0; $i < count($d); ++$i) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1; ?></td>
                                                                <td><?php echo $d[$i]->tahun; ?></td>
                                                                <td><?php echo number_format($d[$i]->total_penjualan); ?></td>
                                                                <td><?php echo number_format($d[$i]->nilai_ekspor)." (".$d[$i]->persen_ekspor."%)"; ?></td>
                                                                <td><?php echo number_format($d[$i]->nilai_lokal)." (".$d[$i]->persen_lokal."%)"; ?></td>
                                                                <td class="text-end">
                                                                    <a href="<?php echo base_url('main/penjualan/nilai/'.$this->secure->encrypt_url($d[$i]->idpenjualan)); ?>" class="text-success">Edit</a> | 
                                                                    <a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?php echo $i; ?>">Hapus</a>
                                                                </td>
                                                            </tr>
                                                            <!-- modal hapus start -->
                                                            <div class="modal fade rounded-0" tabindex="-1" id="modalhapus<?php echo $i; ?>" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
                                                                <div class = "modal-dialog">
                                                                    <div class = "modal-content">
                                                                    <form role="form" method="post" action="<?=base_url()?>main/hapusnilai">
                                                                        <input type="hidden" name="idprofil" id="idprofil" value="<?php echo $d[$i]->idprofil; ?>" />
                                                                        <input type="hidden" name="idjual" id="idjual" value="<?php echo $d[$i]->idpenjualan; ?>" />
                                                                            <div class = "modal-header">
                                                                            <p class = "modal-title" id = "modallabel"><i class="fa fa-trash"></i> HAPUS DATA</p>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                            </div>
                                                                            <div class = "modal-body">
                                                                                <p>YAKIN DATA AKAN <span class="text-danger">DIHAPUS</span> ?</p>
                                                                            </div>
                                                                            <div class = "modal-footer">
                                                                                <button type = "submit" class = "btn btn-success"><i class="fa fa-check"></i> Ya</button>
                                                                                <button type = "button" class = "btn btn-danger" data-dismiss = "modal" data-bs-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                                                                            </div>
                                                                        </form>   
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->   
                                                            </div><!-- modal hapus end -->
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- nilai penjualan end -->
                                        <?php
                                    }
                                    if($page=="ekspor") {
                                        if(!empty($idproduk)) { $ro = "disabled"; }
                                        else { $ro = ""; }
                                        ?>
                                        <!-- kegiatan ekspor start -->
                                        <div class="card-body">
                                            <div class="row py-2">
                                                <form id="frmekspor" name="frmekspor" method="post" action="<?php echo base_url('main/simpanekspor'); ?>">
                                                    <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $idprofil; ?>">
                                                    <input type="hidden" id="idproflink" name="idproflink" value="<?php echo $idproflink; ?>">
                                                    <div class="row mb-2">
                                                        <label for="produk" class="col-md-3 mb-2">Produk</label>
                                                        <div class="col-md-4">
                                                            <select class="form-control rounded-0" id="idproduk" name="idproduk" <?php echo $ro; ?>>
                                                                <option value=""></option>
                                                                <?php
                                                                $d = $prod->result();
                                                                $n = $prod->num_rows();
                                                                if($n>0) {
                                                                    for ($i = 0; $i < count($d); ++$i) {
                                                                        ?>
                                                                        <option value="<?php echo $d[$i]->idproduk; ?>" <?php if($d[$i]->idproduk==$vprod) { echo "selected"; } ?>><?php echo $d[$i]->produk; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <?php if(!empty($idproduk)) {
                                                                ?>
                                                                <input type="hidden" id="idproduk" name="idproduk" value="<?php echo $idproduk; ?>">
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="negekspor" class="col-md-3 mb-2">Negara Tujuan Ekspor</label>
                                                        <div class="col-md-4">
                                                            <select class="form-control rounded-0" id="idnegara" name="idnegara" <?php echo $ro; ?>>
                                                                <option value=""></option>
                                                                <?php
                                                                $d = $neg->result();
                                                                $n = $neg->num_rows();
                                                                if($n > 0) {
                                                                    for ($i = 0; $i < count($d); ++$i) {
                                                                    ?>
                                                                    <option value="<?php echo $d[$i]->idnegara; ?>" <?php if($d[$i]->idnegara==$vnegekspor) { echo "selected"; } ?>><?php echo $d[$i]->negara; ?></option>
                                                                    <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <?php if(!empty($idproduk)) {
                                                                ?>
                                                                <input type="hidden" id="idnegara" name="idnegara" value="<?php echo $idneglink; ?>">
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="rasio_<?php echo $i; ?>" class="col-md-3 mb-2">Rasio Ekspor 2019 (%)</label>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control rounded-0" id="rasio_2019" name="rasio_2019" maxlength="3" value="<?php echo $vrasio2019; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="rasio_2020" class="col-md-3 mb-2">Rasio Ekspor 2020 (%)</label>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control rounded-0" id="rasio_2020" name="rasio_2020" maxlength="3" value="<?php echo $vrasio2020; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="rasio_2021" class="col-md-3 mb-2">Rasio Ekspor 2021 (%)</label>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control rounded-0" id="rasio_2021" name="rasio_2021" maxlength="3" value="<?php echo $vrasio2021; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group py-2">
                                                        <div class="row">
                                                            <div class="col-lg-6 my-2">
                                                                <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                            </div>
                                                            <div class="col-lg-6 my-2">
                                                                <a class="btn btn-warning col-lg-6 form-control rounded-0" href="<?php echo base_url('main/penjualan/ekspor'); ?>"><i class="fa-solid fa-rotate"></i> Reset</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="table-responsive py-3">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" rowspan="2">#</th>
                                                            <th scope="col" rowspan="2">Produk</th>
                                                            <th scope="col" rowspan="2">Kode HS</th>
                                                            <th scope="col" rowspan="2">Negara</th>
                                                            <th scope="col" colspan="3" class="text-center">Rasio Ekspor (%)</th>
                                                            <th scope="col" rowspan="2"></th>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            $dt = date("Y");
                                                            for($i=$dt-3; $i<$dt; $i++) {
                                                                ?>
                                                                <th scope="col" class="text-center"><?php echo $i; ?></th>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $d = $eks->result();
                                                        $n = $eks->num_rows();
                                                        if($n > 0) {
                                                            for ($i = 0; $i < count($d); ++$i) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1; ?></td>
                                                                <td><?php echo $d[$i]->produk; ?></td>
                                                                <td><?php echo $d[$i]->hscode; ?></td>
                                                                <td><?php echo $d[$i]->negara; ?></td>
                                                                <?php
                                                                $dt = date("Y");
                                                                for($x=$dt-3; $x<$dt; $x++) {
                                                                    ?>
                                                                    <th scope="col" class="text-center"><?php echo $this->primamod->ambilpersenekspor($idprofil, $d[$i]->idproduk, $d[$i]->idnegara, $x)->row()->persen_ekspor; ?></th>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <td class="text-end">
                                                                    <a href="<?php echo base_url('main/penjualan/ekspor/'.$this->secure->encrypt_url($d[$i]->idprofil).'/'.$this->secure->encrypt_url($d[$i]->idproduk).'/'.$this->secure->encrypt_url($d[$i]->idnegara)); ?>" class="text-success">Edit</a> | 
                                                                    <a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?php echo $i; ?>">Hapus</a>
                                                                </td>
                                                            </tr>
                                                            <!-- modal hapus start -->
                                                            <div class="modal fade rounded-0" tabindex="-1" id="modalhapus<?php echo $i; ?>" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
                                                                <div class = "modal-dialog">
                                                                    <div class = "modal-content">
                                                                    <form role="form" method="post" action="<?=base_url()?>main/hapusekspor">
                                                                        <input type="hidden" name="idprofil" id="idprofil" value="<?php echo $d[$i]->idprofil; ?>" />
                                                                        <input type="hidden" name="idproduk" id="idproduk" value="<?php echo $d[$i]->idproduk; ?>" />
                                                                        <input type="hidden" name="idnegara" id="idnegara" value="<?php echo $d[$i]->idnegara; ?>" />
                                                                            <div class = "modal-header">
                                                                            <p class = "modal-title" id = "modallabel"><i class="fa fa-trash"></i> HAPUS DATA</p>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                            </div>
                                                                            <div class = "modal-body">
                                                                                <p>YAKIN DATA AKAN <span class="text-danger">DIHAPUS</span> ?</p>
                                                                            </div>
                                                                            <div class = "modal-footer">
                                                                                <button type = "submit" class = "btn btn-success"><i class="fa fa-check"></i> Ya</button>
                                                                                <button type = "button" class = "btn btn-danger" data-dismiss = "modal" data-bs-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                                                                            </div>
                                                                        </form>   
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->   
                                                            </div><!-- modal hapus end -->
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- kegiatan ekspor end -->
                                        <?php
                                    }
                                    if($page=="survey") {
                                        ?>
                                        <!-- survey penjualan start -->
                                        <div class="card-body">
                                            <form id="frmsurvey" name="frmsurvey" method="post" action="<?php echo base_url('main/simpansurveypenjualan'); ?>">
                                                <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $idprofil; ?>">
                                                <div class="row mb-2">
                                                    <label for="frekuensi_kirim_barang" class="col-md-6 mb-2">Frekuensi Pengiriman Barang</label>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="frekuensi_kirim_barang1" name="frekuensi_kirim_barang" value="1" <?php if($vfrekkirim=="1") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Berkelanjutan</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="frekuensi_kirim_barang2" name="frekuensi_kirim_barang" value="0" <?php if($vfrekkirim=="0") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Tidak Berkelanjutan</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="metode_penjualan" class="col-md-6 mb-2">Metode Penjualan Saat Ini</label>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="metode_penjualan1" name="metode_penjualan" value="1" <?php if($vmetodejual=="1") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Langsung</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="metode_penjualan2" name="metode_penjualan" value="0" <?php if($vmetodejual=="0") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Tidak Langsung</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="punya_anak_perusahaan" class="col-md-6 mb-2">Memiliki Anak Perusahaan di Luar Negeri</label>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="punya_anak_perusahaan1" name="punya_anak_perusahaan" value="1" <?php if($vanakusaha=="1") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="punya_anak_perusahaan2" name="punya_anak_perusahaan" value="0" <?php if($vanakusaha=="0") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="punya_anak_perusahaan" class="col-md-6 mb-2">Jika Ya, di negara apa saja?</label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control rounded-0" id="negara_anak_perusahaan" name="negara_anak_perusahaan"  class="form-control" maxlength="200" value="<?php echo $vneganakperusahaan; ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="upaya_pemasaran" class="col-md-6 mb-2">Upaya Pemasaran Ekspor</label>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="upaya_pameran_dagang" name="upaya_pameran_dagang" value="1" <?php if($vpameran=="1") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Pameran Dagang</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="upaya_misi_dagang" name="upaya_misi_dagang" value="1" <?php if($vmisidagang=="1") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Misi Dagang</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="upayakatalog" name="upaya_katalog" value="1" <?php if($vkatalog=="1") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Penyebaran Katalog</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="upaya_binaan_instansi" name="upaya_binaan_instansi" value="1" <?php if($vbinaan=="1") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Menjadi Binaan Instansi</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="upaya_agen" name="upaya_agen" value=1" <?php if($vagen=="1") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Agen</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="upaya_online" name="upaya_online" value="1" <?php if($vonline=="1") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Online</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="upaya_langsung" name="upaya_langsung" value="1" <?php if($vlangsung=="1") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">One on One (Langsung)</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="upaya_iklan" name="upaya_iklan" value="1" <?php if($viklan=="1") echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">Media / Iklan</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label for="punya_anak_perusahaan" class="col-md-6 mb-2">Pelabuhan Muat Ekspor</label>
                                                    <div class="col-md-4">
                                                        <select class="form-control rounded-0" id="idpelabuhan" name="idpelabuhan">
                                                            <option value=""></option>
                                                            <?php
                                                            $d = $pel->result();
                                                            $n = $pel->num_rows();
                                                            if($n > 0) {
                                                                for ($i = 0; $i < count($d); ++$i) {
                                                                ?>
                                                                <option value="<?php echo $d[$i]->idpelabuhan; ?>" <?php if($d[$i]->idpelabuhan==$vpelabuhan) { echo "selected"; } ?>><?php echo $d[$i]->nmpelabuhan; ?></option>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group py-2">
                                                    <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- survey penjualan end -->
                                        <?php
                                    }
                                    ?>
                                </div>          
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('akun/tpl_progress'); ?>
            </div>
        </div>
    </div>
</section>
<script>
    $('#persen_ekspor').on('change', function() {
        var xtotal = document.getElementById("total_penjualan").value;
        var xpersen_ekspor = document.getElementById("persen_ekspor").value;

        var xnilai_ekspor = (xpersen_ekspor/100)*xtotal

        document.getElementById("nilai_ekspor").value = xnilai_ekspor; 

        var xnilai_ekspor = document.getElementById("nilai_ekspor").value;

        var xpersen_lokal = 100-xpersen_ekspor;
        var xnilai_lokal = xtotal-xnilai_ekspor;

        if(xpersen_lokal<0) {
            document.getElementById("persen_ekspor").value = ""; 
        }
        if(xnilai_lokal<0) {
            document.getElementById("nilai_ekspor").value = ""; 
        }

        document.getElementById("persen_lokal").value = xpersen_lokal; 
        document.getElementById("nilai_lokal").value = xnilai_lokal;   
   });

    // validasi form
    $("#frmjual").validate({
        rules: {  
            tahun: {
                required: true,
                number: true
            },
            total_penjualan: {
                required: true,
                number: true
            },
            persen_ekspor: {
                required: true,
                number: true
            },
            nilai_ekspor: {
                required: true,
                number: true
            },
            persen_lokal: {
                required: true,
                number: true
            },
            nilai_lokal: {
                required: true,
                number: true
            }
        },
        messages: {
            tahun: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            total_penjualan: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            persen_ekspor: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            nilai_ekspor: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            persen_lokal: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            nilai_lokal: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            }
        }
    });

    $("#frmekspor").validate({
        rules: {  
            idproduk: "required",
            idnegara: "required",
            rasio_2019: {
                required: true,
                number: true
            },
            rasio_2020: {
                required: true,
                number: true
            },
            rasio_2021: {
                required: true,
                number: true
            }
        },
        messages: {
            idproduk: "Harap dipilih",
            idnegara: "Harap dipilih",
            rasio_2019: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            rasio_2020: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            rasio_2021: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            }
        }
    });
  
    $("#frmsurvey").validate({
        rules: {
            frekuensi_kirim_barang: "required",
            metode_penjualan: "required",
            punya_anak_perusahaan: "required",
            idpelabuhan: "required"  
        },
        messages: {
            frekuensi_kirim_barang: "Harap dipilih",
            metode_penjualan: "Harap dipilih",
            punya_anak_perusahaan: "Harap dipilih",
            idpelabuhan: "Harap dipilih"  
        }
    });
</script>