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
                                    <li>Produk Ekspor</LI>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">PRODUK EKSPOR</p>
                                <?php
                                if(!empty($this->session->sessupdateproduk)) {
                                    ?>
                                    <div class="alert alert-success rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdateproduk; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdateproduk');
                                        ?>
                                    </div>
                                    <?php
                                }
                                if($this->primamod->cek_form('produk', $this->session->sessprofilid)==FALSE) {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Form Produk Ekspor belum diisi.
                                    </div>
                                    <?php
                                }
                                if($this->primamod->cek_form('survey_produk', $this->session->sessprofilid)==FALSE) {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Form Survey Produk Ekspor belum diisi.
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="card rounded-0">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs" id="nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($page=="form") echo "active"; ?>"  href="<?php echo base_url('akun/produk/form'); ?>">PRODUK EKSPOR</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($page=="survey") echo "active"; ?>" href="<?php echo base_url('akun/produk/survey'); ?>">SURVEY PRODUK EKSPOR</a>
                                        </li>
                                        </ul>
                                    </div>
                                    <?php
                                    if($page=="form") {
                                        ?>
                                        <!-- form produk ekspor start -->
                                        <div class="card-body">
                                            <div class="row py-2">
                                                <form id="frmproduk" name="frmproduk" method="post" action="<?php echo base_url('main/simpan_produk_eks'); ?>">
                                                <input type="hidden" id="idproduk" name="idproduk" value="<?php echo $vidproduk; ?>">
                                                <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $this->session->sessprofilid; ?>">
                                                    <div class="row mb-2">
                                                        <label for="nama" class="col-md-3 mb-2">Jenis Produk</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control rounded-0" id="produk" name="produk" maxlength="200" value="<?php echo $vproduk; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="jabatan" class="col-md-3 mb-2">Kode HS</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control rounded-0" id="hscode" name="hscode" maxlength="10" value="<?php echo $vhscode; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="email" class="col-md-3 mb-2">Merek</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control rounded-0" id="merek" name="merek" maxlength="200" value="<?php echo $vmerek; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="telepon" class="col-md-3 mb-2">Tanggal Daftar Merek</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control rounded-0" id="datepicker2" name="tgldaftarmerek"  class="datepicker_input form-control" placeholder="YYYY-MM-DD" maxlength="10" value="<?php echo $vtgldaftarmerek; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="telepon" class="col-md-3 mb-2">Negara Daftar Merek</label>
                                                        <div class="col-md-4">
                                                            <select class="form-control rounded-0" id="idnegara" name="idnegara">
                                                                <option value=""></option>
                                                                <?php
                                                                $d = $neg->result();
                                                                $n = $neg->num_rows();
                                                                if($n > 0) {
                                                                    for ($i = 0; $i < count($d); ++$i) {
                                                                    ?>
                                                                    <option value="<?php echo $d[$i]->idnegara; ?>" <?php if($d[$i]->idnegara==$vnegaramerek) { echo "selected"; } ?>><?php echo $d[$i]->negara; ?></option>
                                                                    <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group py-2">
                                                        <div class="row">
                                                            <div class="col-lg-6 my-2">
                                                                <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                            </div>
                                                            <div class="col-lg-6 my-2">
                                                                <a class="btn btn-warning col-lg-6 form-control rounded-0" href="<?php echo base_url('akun/produk'); ?>"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                                                            <th scope="col">Produk</th>
                                                            <th scope="col">Kode HS</th>
                                                            <th scope="col">Merek</th>
                                                            <th scope="col">Negara</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $d = $produk->result();
                                                        $n = $produk->num_rows();
                                                        if($n > 0) {
                                                            for ($i = 0; $i < count($d); ++$i) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1; ?></td>
                                                                <td><?php echo $d[$i]->produk; ?></td>
                                                                <td><?php echo $d[$i]->hscode; ?></td>
                                                                <td><?php echo $d[$i]->merek; ?></td>
                                                                <td><?php echo $d[$i]->negara; ?></td>
                                                                <td>
                                                                    <a href="<?php echo base_url('akun/produk/form/'.$d[$i]->idproduk); ?>" style="text-decoration: none; color: green;">Edit</a> | 
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
                                        <!-- form produk ekspor end -->
                                        <?php
                                        }
                                        if($page=="survey") {
                                            ?>
                                            <!-- survey start -->
                                            <div class="card-body">
                                                <div class="row py-2">
                                                    <form id="frmsurvey" name="frmsurvey" method="post" action="<?php echo base_url('main/simpan_survey_produk'); ?>">
                                                        <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $this->session->sessprofilid; ?>">
                                                        <div class="row mb-2">
                                                            <label for="nama" class="col-md-6 mb-2">Pernah melakukan ekspor menggunakan merek milik pembeli</label>
                                                            <div class="col-md-6">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="ekspormerekbuyer1" name="ekspormerekbuyer" value="1" <?php if($veksmerekbuyer=="1") echo "checked"; ?>>
                                                                    <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="ekspormerekbuyer2" name="ekspormerekbuyer" value="0" <?php if($veksmerekbuyer=="0") echo "checked"; ?>>
                                                                    <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group py-2">
                                                            <label><b>Aktivitas Branding di Luar Negeri</b></label>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="nama" class="col-md-6 mb-2">Sendiri</label>
                                                            <div class="col-md-6">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="brandingsendiri1" name="brandingsendiri" value="1" <?php if($vbrandsendiri=="1") echo "checked"; ?>>
                                                                    <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="brandingsendiri2" name="brandingsendiri" value="0" <?php if($vbrandsendiri=="0") echo "checked"; ?>>
                                                                    <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="nama" class="col-md-6 mb-2">Melalui Perwakilan Perusahaan di Luar Negeri</label>
                                                            <div class="col-md-6">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="perwakilanluarnegeri1" name="perwakilanluarnegeri" value="1" <?php if($vwakilluar=="1") echo "checked"; ?>>
                                                                    <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="perwakilanluarnegeri2" name="perwakilanluarnegeri" value="0" <?php if($vwakilluar=="0") echo "checked"; ?>>
                                                                    <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="nama" class="col-md-6 mb-2">Melakukan Bersama-sama Dengan Mitra Bisnis</label>
                                                            <div class="col-md-6">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="brandingdenganbuyer1" name="brandingdenganbuyer" value="1" <?php if($vbrandbuyer=="1") echo "checked"; ?>>
                                                                    <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="brandingdenganbuyer2" name="brandingdenganbuyer" value="0" <?php if($vbrandbuyer=="0") echo "checked"; ?>>
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
    $("#frmproduk").validate({
        rules: {
            produk: "required",  
            hscode: {
                required: true,
                number: true
            }
        },
        messages: {
            produk: "Harap diisi",
            hscode: {
                required: "Harap diisi",
                number: "Kode HS harap diisi dengan benar"
            }
        }
    });
  
    $("#frmsurvey").validate({
        rules: {
            ekspormerekbuyer: "required",
            brandingsendiri: "required",
            perwakilanluarnegeri: "required",
            brandingdenganbuyer: "required"  
        },
        messages: {
            ekspormerekbuyer: "Harap dipilih",
            brandingsendiri: "Harap dipilih",
            perwakilanluarnegeri: "Harap dipilih",
            brandingdenganbuyer: "Harap dipilih"
        }
    });
</script>