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
                                    <li>Produk Ekspor</li>
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
                                if($this->primamod->cekform('produk', $this->decrypt_profilid)==FALSE) {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Form Produk Ekspor belum diisi.
                                    </div>
                                    <?php
                                }
                                if($this->primamod->cekform('survey_produk', $this->decrypt_profilid)==FALSE) {
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
                                            <a class="nav-link <?php if($page=="form") echo "active"; ?>"  href="<?php echo base_url('main/produk/form'); ?>">PRODUK EKSPOR</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($page=="survey") echo "active"; ?>" href="<?php echo base_url('main/produk/survey'); ?>">SURVEY PRODUK EKSPOR</a>
                                        </li>
                                        </ul>
                                    </div>
                                    <?php
                                    if($page=="form") {
                                        ?>
                                        <!-- form produk ekspor start -->
                                        <div class="card-body">
                                            <div class="row py-2">
                                                <form id="frmproduk" name="frmproduk" method="post" action="<?php echo base_url('main/simpanproduk'); ?>">
                                                <input type="hidden" id="idproduk" name="idproduk" value="<?php echo $idproduk; ?>">
                                                <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $idprofil; ?>">
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
                                                            <select class="form-control rounded-0" id="idmerek" name="idmerek">
                                                                <option value="">Tidak Punya Merek</option>
                                                                <?php
                                                                $d = $merek->result();
                                                                $n = $merek->num_rows();
                                                                if($n > 0) {
                                                                    for ($i = 0; $i < count($d); ++$i) {
                                                                        ?>
                                                                        <option value="<?php echo $d[$i]->idmerek; ?>" <?php if($d[$i]->idmerek==$vidmerek) { echo "selected"; } ?>><?php echo $d[$i]->nmmerek; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <p class="col-md-6 offset-md-3 form-text">Jika punya merek harap daftar <a href="<?php echo base_url('main/merek'); ?>">disini</a></p>
                                                    </div>
                                                    <div class="form-group py-2">
                                                        <div class="row">
                                                            <div class="col-lg-6 my-2">
                                                                <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                            </div>
                                                            <div class="col-lg-6 my-2">
                                                                <a class="btn btn-warning col-lg-6 form-control rounded-0" href="<?php echo base_url('main/produk'); ?>"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                                                                <td>
                                                                <?php 
                                                                if(empty($d[$i]->nmmerek)) { echo "-"; }
                                                                else { echo $d[$i]->nmmerek; }
                                                                ?>
                                                                </td>
                                                                <td class="text-end">
                                                                    <a href="<?php echo base_url('main/produk/form/'.$this->secure->encrypt_url($d[$i]->idproduk)); ?>" class="text-success">Edit</a> | 
                                                                    <a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?php echo $i; ?>">Hapus</a>
                                                                </td>
                                                            </tr>
                                                            <!-- modal hapus start -->
                                                            <div class="modal fade rounded-0" tabindex="-1" id="modalhapus<?php echo $i; ?>" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
                                                                <div class = "modal-dialog">
                                                                    <div class = "modal-content">
                                                                    <form role="form" method="post" action="<?=base_url()?>main/hapusproduk">
                                                                        <input type="hidden" name="idprofil" id="idprofil" value="<?php echo $d[$i]->idprofil; ?>" />
                                                                        <input type="hidden" name="idproduk" id="idproduk" value="<?php echo $d[$i]->idproduk; ?>" />
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
                                        <!-- form produk ekspor end -->
                                        <?php
                                        }
                                        if($page=="survey") {
                                            ?>
                                            <!-- survey start -->
                                            <div class="card-body">
                                                <div class="row py-2">
                                                    <form id="frmsurvey" name="frmsurvey" method="post" action="<?php echo base_url('main/simpansurveyproduk'); ?>">
                                                        <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $idprofil; ?>">
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
                <?php $this->load->view('akun/tpl_progress'); ?>
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