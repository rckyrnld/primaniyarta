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
                                    <li>Tambah Profil Perusahaan</LI>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">PROFIL PERUSAHAAN</p>
                                <?php
                                if(!empty($this->session->sessceknpwp)) {
                                    ?>
                                    <div class="alert alert-success rounded-0" role="alert">
                                        NPWP belum terdaftar. Anda dapat mengisi profil perusahaan
                                    </div>
                                    <?php
                                }
                                else {
                                    if(!empty($this->session->sessupdateprofil)) {
                                        ?>
                                        <div class="alert alert-success rounded-0" role="alert">
                                            <?php 
                                                echo $this->session->sessupdateprofil; 

                                                //destroy session sessupdateprofil
                                                $this->session->unset_userdata('sessupdateprofil');
                                            ?>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <div class="row py-2">
                                    <form id="frmprof" name="frmprof" method="post" action="<?php echo base_url('main/simpanprofil'); ?>">
                                        <div class="card bg-success text-white bg-opacity-75 text-center mb-4 rounded-0">
                                            <div class="card-header">
                                                <b>PILIH KATEGORI PRIMANIYARTA</b>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="nmperusahaan" class="col-md-3 mb-2">Pilih Kategori</label>
                                            <div class="col-md-5">
                                                <select class="form-control rounded-0" id="idkategori" name="idkategori" onchange="ambilketerangan()" required>
                                                    <option value=""></option>
                                                    <?php
                                                    $d = $kat->result();
                                                    $n = $kat->num_rows();
                                                    if($n > 0) {
                                                        for ($i = 0; $i < count($d); ++$i) {
                                                        ?>
                                                        <option value="<?php echo $d[$i]->idkategori; ?>"><?php echo $d[$i]->nmkategori; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-8 offset-md-3 mt-2" id="ketkat" style="display: none;"></div>
                                        </div>
                                        <div class="card bg-success text-white bg-opacity-75 text-center my-4 rounded-0">
                                            <div class="card-header">
                                                <b>ISI PROFIL PERUSAHAAN</b>
                                            </div>
                                        </div> 
                                        <div class="row mb-2">
                                            <label for="idbadanusaha" class="col-md-3 col-form-label">Badan Usaha</label>
                                            <div class="col-md-2">
                                                <select class="form-control rounded-0" id="idbadanusaha" name="idbadanusaha" required>
                                                    <option value=""></option>
                                                    <?php
                                                    $d = $bu->result();
                                                    $n = $bu->num_rows();
                                                    if($n > 0) {
                                                        for ($i = 0; $i < count($d); ++$i) {
                                                        ?>
                                                        <option value="<?php echo $d[$i]->idbadanusaha; ?>"><?php echo $d[$i]->nmbadanusaha; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6"></div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="nmperusahaan" class="col-md-3 mb-2">Nama Perusahaan</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control rounded-0" id="nmperusahaan" name="nmperusahaan" maxlength="200" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="npwp" class="col-md-3 mb-2">NPWP</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control rounded-0" id="npwp" name="npwp" maxlength="15" value="<?php echo $this->session->sessceknpwp; ?>" readonly required>
                                            </div>
                                            <?php 
                                            if($this->decrypt_profilid==0) {
                                                ?>
                                                <div class="col-md-3">
                                                    <a class="btn btn-danger form-control rounded-0" href="<?php echo base_url('main/resetnpwp'); ?>">Reset NPWP</a>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php 
                                        if($this->decrypt_profilid==0) {
                                            ?>
                                            <div class="row mb-2">
                                                <div class="col-md-8 offset-md-3">
                                                    <span class="form-text">Reset NPWP untuk mengubah NPWP dan mengulangi proses pendaftaran</span><br>
                                                    <span class="form-text">Reset NPWP akan menghapus seluruh isian profil perusahaan</span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="row mb-2">
                                            <label for="nib" class="col-md-3 mb-2">NIB</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control rounded-0" id="nib" name="nib" maxlength="13" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="idmodal" class="col-md-3 mb-2">Jenis Penanaman Modal</label>
                                            <div class="col-md-4">
                                                <?php
                                                $d = $mo->result();
                                                $n = $mo->num_rows();
                                                if($n > 0) {
                                                    for ($i = 0; $i < count($d); ++$i) {
                                                    ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="idmodal" id="idmodal<?php echo $i; ?>" value="<?php echo $d[$i]->idmodal; ?>">
                                                        <label class="form-check-label" for=""idmodal<?php echo $i; ?>"><?php echo $d[$i]->nmmodal; ?></label>
                                                    </div>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="idskala" class="col-md-3 mb-2">Skala Bisnis</label>
                                            <div class="col-md-3">
                                                <select class="form-control rounded-0" id="idskala" name="idskala" onchange="ambilketskala()" required>
                                                    <option value=""></option>
                                                    <?php
                                                    $d = $sb->result();
                                                    $n = $sb->num_rows();
                                                    if($n > 0) {
                                                        for ($i = 0; $i < count($d); ++$i) {
                                                        ?>
                                                        <option value="<?php echo $d[$i]->idskala; ?>"><?php echo $d[$i]->nmskala; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6" id="ketskala" name="ketskala" style="display: none">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="idjenis" class="col-md-3 mb-2">Jenis Usaha</label>
                                            <div class="col-md-6">
                                                <?php
                                               $d = $ju->result();
                                               $n = $ju->num_rows();
                                                if($n > 0) {
                                                    for ($i = 0; $i < count($d); ++$i) {
                                                    ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="idjenis" id="idjenis<?php echo $i; ?>" value="<?php echo $d[$i]->idjenis; ?>">
                                                        <label class="form-check-label" for=""idjenis<?php echo $i; ?>"><?php echo $d[$i]->nmjenis; ?></label>
                                                    </div>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="tahunberdiri" class="col-md-3 mb-2">Tahun Perusahaan Berdiri</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control rounded-0" id="tahunberdiri" name="tahunberdiri" maxlength="4" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="tahunekspor" class="col-md-3 mb-2">Tahun Mulai Ekspor</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control rounded-0" id="tahunekspor" name="tahunekspor" maxlength="4" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">                                    
                                            <label for="bank" class="col-md-3 mb-2">Bank Korespondensi</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control rounded-0" id="bank" name="bank" maxlength="50" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">                                    
                                            <label for="email" class="col-md-3 mb-2">Email</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control rounded-0" id="email" name="email" maxlength="200" value="<?php echo $this->secure->decrypt_url($this->session->sessemail); ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">                                    
                                            <label for="website" class="col-md-3 mb-2">Website</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control rounded-0" id="website" name="website" maxlength="200">
                                            </div>
                                        </div>
                                        <hr class="text-muted">
                                        <p><b>Alamat dan Kontak Perusahaan</b></p>
                                        <div class="row mb-2">                                    
                                            <label for="idprovinsi" class="col-md-3 mb-2">Provinsi</label>
                                            <div class="col-md-6">
                                                    <select class="form-control rounded-0" id="idprovinsi" name="idprovinsi" required>
                                                    <option value=""></option>
                                                    <?php
                                                    $d = $prov->result();
                                                    $n = $prov->num_rows();
                                                    if($n > 0) {
                                                        for ($i = 0; $i < count($d); ++$i) {
                                                        ?>
                                                        <option value="<?php echo $d[$i]->idprovinsi; ?>"><?php echo $d[$i]->provinsi_id; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="row mb-2">                                    
                                            <label for="kota" class="col-md-3 mb-2">Kota</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control rounded-0" id="kota" name="kota" maxlength="100" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">                                    
                                            <label for="alamat" class="col-md-3 mb-2">Alamat</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control rounded-0"" id="alamat" name="alamat" maxlength="200" required></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-2">                                    
                                            <label for="telepon" class="col-md-3 mb-2">Telepon</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control rounded-0" id="telepon" name="telepon" maxlength="50" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">                                    
                                            <label for="fax" class="col-md-3 mb-2">Fax</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control rounded-0" id="fax" name="fax" maxlength="50">
                                            </div>
                                        </div>
                                        <p class="py-2"><b>Alamat dan Kontak Pabrik</b></p>
                                        <div class="row mb-2">                                    
                                            <label for="idprovinsipabrik" class="col-md-3 mb-2">Provinsi</label>
                                            <div class="col-md-6">
                                            <select class="form-control rounded-0" id="idprovinsipabrik" name="idprovinsipabrik">
                                                <option value=""></option>
                                                <?php
                                                $d = $prov->result();
                                                $n = $prov->num_rows();
                                                if($n > 0) {
                                                    for ($i = 0; $i < count($d); ++$i) {
                                                    ?>
                                                    <option value="<?php echo $d[$i]->idprovinsi; ?>"><?php echo $d[$i]->provinsi_id; ?></option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="row mb-2">                                    
                                            <label for="kotapabrik" class="col-md-3 mb-2">Kota</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control rounded-0" id="kotapabrik" name="kotapabrik" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="row mb-2">                                    
                                            <label for="alamatpabrik" class="col-md-3 mb-2">Alamat</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control rounded-0"" id="alamatpabrik" name="alamatpabrik" maxlength="200"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-2">                                    
                                            <label for="teleponpabrik" class="col-md-3 mb-2">Telepon</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control rounded-0" id="teleponpabrik" name="teleponpabrik" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="row mb-2">                                    
                                            <label for="faxpabrik" class="col-md-3 mb-2">Fax</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control rounded-0" id="faxpabrik" name="faxpabrik" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="form-group py-2">
                                            <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                        </div>
                                    </form>
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
    function ambilketerangan() {
        var xid = document.getElementById("idkategori").value;
        var xdv = document.getElementById("ketkat");

        if (xid === "") {
            xdv.style.display = "none";
        } else {
            xdv.style.display = "block";
        }

        $.ajax({
            url: "<?php echo base_url('main/ambilketerangan'); ?>",
            type: "POST",
            data: {
               idkat: xid
            },
            dataType: "json",
            success: function(res) {
                $("#ketkat").html(res);
            }
        });

    }

    function ambilketskala() {
        var xid = document.getElementById("idskala").value;
        var xdv = document.getElementById("ketskala");

        if (xid === "") {
            xdv.style.display = "none";
        } else {
            xdv.style.display = "block";
        }

        $.ajax({
            url: "<?php echo base_url('main/skalabisnisdesc'); ?>",
            type: "POST",
            data: {
               idskala: xid
            },
            dataType: "json",
            success: function(res) {
                $("#ketskala").html(res);
            }
        });
    }

    // validasi form
    $("#frmprof").validate({
        errorPlacement: function(error, element) {
            if (element.attr('type') == 'radio' || element.attr('type') == 'checkbox') {
                //error.appendTo(element.closest('.form-check-input'));
                error.insertBefore(element);
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            idbadanusaha: "required",  
            nmperusahaan: "required",
            nib: {
                required: true,
                number: true
            },
            idmodal: "required", 
            idskala: "required", 
            idjenis: "required", 
            tahunberdiri: {
                required: true,
                number: true
            },
            tahunekspor: {
                required: true,
                number: true
            },
            bank: "required",
            email: {
                required: true,
                email: true
            },
            idprovinsi: "required",
            kota: "required",
            alamat: "required",
            telepon: "required"
        },
        messages: {
            idbadanusaha: "Harap dipilih",
            nmperusahaan: "Harap diisi",
            nib: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            idmodal: "Harap dipilih",
            idskala: "Harap dipilih",
            idjenis: "Harap dipilih",
            tahunberdiri: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            tahunekspor: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            bank: "Harap diisi",
            email: {
                required: "Harap diisi",
                email: "Email harap diisi dengan benar"
            },
            idprovinsi: "Harap dipilih",
            kota: "Harap diisi",
            alamat: "Harap diisi",
            telepon: "Harap diisi"
        }
    });
</script>