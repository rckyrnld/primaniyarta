<section id="main-content">
    <div class="wrapper site-min-height">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mb-2">
                    <div class="card rounded-0">
                        <div class="card-body">
                            <div class="bc">
                                <ul>
                                    <li><a href="<?php echo base_url('akun/beranda'); ?>">Beranda</a></li>
                                    <li>Bahan Baku</LI>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">BAHAN BAKU</p>
                                <?php
                                if(!empty($this->session->sessupdatebahan)) {
                                    ?>
                                    <div class="alert alert-success rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdatebahan; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdatebahan');
                                        ?>
                                    </div>
                                    <?php
                                }
                                if($this->primamod->cek_form('bahanbaku', $this->session->sessprofilid)==FALSE) {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Form Bahan Baku belum diisi.
                                    </div>
                                    <?php
                                }
                                if($this->primamod->cek_form('survey_bahanbaku', $this->session->sessprofilid)==FALSE) {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Form Survey Bahan Baku belum diisi.
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="card rounded-0">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs" id="nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($page=="form") echo "active"; ?>"  href="<?php echo base_url('akun/bahanbaku/form'); ?>">BAHAN BAKU</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($page=="survey") echo "active"; ?>" href="<?php echo base_url('akun/bahanbaku/survey'); ?>">SURVEY BAHAN BAKU</a>
                                        </li>
                                        </ul>
                                    </div>
                                    <?php
                                    if($page=="form") {
                                        ?>
                                        <!-- form bahan baku start -->
                                        <div class="card-body">
                                            <div class="row py-2">
                                                <form id="frmbahan" name="frmbahan" method="post" action="<?php echo base_url('main/simpan_bahanbaku_eks'); ?>">
                                                <input type="hidden" id="idbahan" name="idbahan" value="<?php echo $vidbahan; ?>">
                                                <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $this->session->sessprofilid; ?>">
                                                    <div class="row mb-2">
                                                        <label for="tahun" class="col-md-3 mb-2">Tahun</label>
                                                        <div class="col-md-2">
                                                            <select class="form-control rounded-0" id="tahun" name="tahun">
                                                                <option value=""></option>
                                                                <?php
                                                                $dt = date("Y");
                                                                $dt1 = $dt-1;
                                                                $dt2 = $dt-6; 
                                                                if(!empty($idbahan)) {
                                                                    ?>
                                                                    <option value="<?php echo $vtahun; ?>" selected><?php echo $vtahun; ?></option>
                                                                    <?php
                                                                }
                                                                for ($i = $dt1; $i > $dt2; --$i) {
                                                                    if($this->primamod->cek_tahun_bahanbaku($this->session->sessprofilid, $i)==FALSE) {
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
                                                        <label for="persen_lokal" class="col-md-3 mb-2">Bahan Baku Lokal (%)</label>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control rounded-0" id="persen_lokal" name="persen_lokal" maxlength="3" value="<?php echo $vlokal; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="persen_impor" class="col-md-3 mb-2">Bahan Baku Impor (%)</label>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control rounded-0" id="persen_impor" name="persen_impor" maxlength="3" value="<?php echo $vimpor; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="telepon" class="col-md-3 mb-2">Nilai Impor (US$)</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control rounded-0" id="nilai_impor" name="nilai_impor" maxlength="20" value="<?php echo $vnilaiimpor; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group py-2">
                                                        <div class="row">
                                                            <div class="col-lg-6 my-2">
                                                                <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                            </div>
                                                            <div class="col-lg-6 my-2">
                                                                <a class="btn btn-warning col-lg-6 form-control rounded-0" href="<?php echo base_url('akun/bahanbaku'); ?>"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                                                            <th scope="col">Lokal (%)</th>
                                                            <th scope="col">Impor (%)</th>
                                                            <th scope="col">Nilai Impor (US$)</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $d = $bahanbaku->result();
                                                        $n = $bahanbaku->num_rows();
                                                        if($n > 0) {
                                                            for ($i = 0; $i < count($d); ++$i) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1; ?></td>
                                                                <td><?php echo $d[$i]->tahun; ?></td>
                                                                <td><?php echo $d[$i]->persen_lokal; ?></td>
                                                                <td><?php echo $d[$i]->persen_impor; ?></td>
                                                                <td><?php echo number_format($d[$i]->nilai_impor, 2); ?></td>
                                                                <td>
                                                                    <a href="<?php echo base_url('akun/bahanbaku/form/'.$d[$i]->idbahanbaku); ?>" style="text-decoration: none; color: green;">Edit</a> | 
                                                                    <a href="#" style="text-decoration: none; color: red;">Delete</a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- form bahan baku end -->
                                        <?php
                                    }
                                    if($page=="survey") {
                                        ?>
                                        <!-- survey start -->
                                        <div class="card-body">
                                            <div class="row py-2">
                                                <form id="frmsurvey" name="frmsurvey" method="post" action="<?php echo base_url('main/simpan_survey_bahanbaku'); ?>">
                                                    <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $this->session->sessprofilid; ?>">
                                                    <div class="row mb-2">
                                                        <label for="frekuensi_product_reject" class="col-md-6 mb-2">Frekuensi Product Reject > 5 Lot/tahun</label>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="frekuensi_product_reject1" name="frekuensi_product_reject" value="1" <?php if($vfrekreject=="1") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="frekuensi_product_reject2" name="frekuensi_product_reject" value="0" <?php if($vfrekreject=="0") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="quality_control" class="col-md-6 mb-2">Quality Control</label>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="quality_control1" name="quality_control" value="1" <?php if($vqc=="1") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="quality_control2" name="quality_control" value="0" <?php if($vqc=="0") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="rnd" class="col-md-6 mb-2">Research & Development</label>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="rnd1" name="rnd" value="1" <?php if($vrnd=="1") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="rnd2" name="rnd" value="0" <?php if($vrnd=="0") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="nama" class="col-md-6 mb-2">Pengolahan Limbah</label>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="olah_limbah1" name="olah_limbah" value="1" <?php if($volahlimbah=="1") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="olah_limbah2" name="olah_limbah" value="0" <?php if($volahlimbah=="0") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="nama" class="col-md-6 mb-2">Penerapan ISO 9001</label>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="iso_90011" name="iso_9001" value="1" <?php if($viso9001=="1") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="iso_90012" name="iso_9001" value="0" <?php if($viso9001=="0") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="nama" class="col-md-6 mb-2">Penerapan ISO 14001</label>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="iso_140011" name="iso_14001" value="1" <?php if($viso14001=="1") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="iso_140012" name="iso_14001" value="0" <?php if($viso14001=="0") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="nama" class="col-md-6 mb-2">Sertifikat Ecolabelling</label>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="sertifikat_ecolabelling1" name="sertifikat_ecolabelling" value="1" <?php if($vecolabel=="1") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="sertifikat_ecolabelling2" name="sertifikat_ecolabelling" value="0" <?php if($vecolabel=="0") echo "checked"; ?>>
                                                                <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group py-2">
                                                        <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- survey end -->
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('akun/eks_tpl_progress'); ?>
            </div>
        </div>
    </div>
</section>
<script>
    // validasi form
    $("#frmbahan").validate({
        rules: {  
            tahun: {
                required: true,
                number: true
            },
            persen_lokal: {
                required: true,
                number: true
            },
            persen_impor: {
                required: true,
                number: true
            },
            nilai_impor: {
                required: true,
                number: true
            }
        },
        messages: {
            tahun: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            persen_lokal: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            persen_impor: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            nilai_impor: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            }
        }
    });
  
    $("#frmsurvey").validate({
        rules: {
            frekuensi_product_reject: "required",
            quality_control: "required",
            rnd: "required",
            olah_limbah: "required",
            iso_9001: "required",
            iso_14001: "required",
            sertifikat_ecolabelling: "required"  
        },
        messages: {
            frekuensi_product_reject: "Harap dipilih",
            quality_control: "Harap dipilih",
            rnd: "Harap dipilih",
            olah_limbah: "Harap dipilih",
            iso_9001: "Harap dipilih",
            iso_14001: "Harap dipilih",
            sertifikat_ecolabelling: "Harap dipilih"  
        }
    });
</script>