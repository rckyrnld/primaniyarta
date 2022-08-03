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
                                    <li>Profil Kepala Daerah</LI>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;"><b>PROFIL KEPALA DAERAH</b></p>
                                <?php
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
                                else {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Halaman untuk mengisi data profil kepala daerah
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row py-2">
                                    <form id="frmprof" name="frmprof" method="post" action="<?php echo base_url('main/simpan_profil_gub'); ?>">
                                        <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $this->decrypt_profilid; ?>">
                                        <input type="hidden" id="emailuser" name="emailuser" value="<?php echo $this->decrypt_email; ?>">
                                        <div class="row mb-2">
                                            <label for="idtingkat" class="col-md-3 col-form-label">Jabatan</label>
                                            <div class="col-md-3">
                                                <select class="form-control rounded-0" id="idtingkat" name="idtingkat" required>
                                                    <option value=""></option>
                                                    <option value="1" <?php if($vidtingkat==1) echo "selected"; ?>>Gubernur</option>
                                                    <option value="2" <?php if($vidtingkat==2) echo "selected"; ?>>Walikota</option>
                                                    <option value="3" <?php if($vidtingkat==3) echo "selected"; ?>>Bupati</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6"></div>
                                        </div>
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
                                                        <option value="<?php echo $d[$i]->idprovinsi; ?>" <?php if($d[$i]->idprovinsi==$vidprov) { echo "selected"; } ?>><?php echo $d[$i]->provinsi_id; ?></option>
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
                                                <input type="text" class="form-control rounded-0" id="kota" name="kota" maxlength="100" value="<?php echo $vkota; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="nmpejabat" class="col-md-3 mb-2">Nama Kepala Daerah</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control rounded-0" id="nmpejabat" name="nmpejabat" maxlength="200" value="<?php echo $vnmpejabat; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="masajabatan" class="col-md-3 mb-2">Masa Jabatan</label>
                                            <div class="col-md-2">
                                                <select class="form-control rounded-0" id="masajabatan1" name="masajabatan1" required>
                                                    <option value="">Tahun Awal</option>
                                                    <?php
                                                    $y1 = date("Y")-5;
                                                    $y2 = date("Y")+5;
                                                    for($i=$y1; $i<=$y2; $i++) {
                                                        ?>
                                                        <option value="<?php echo $i; ?>" <?php if($vmasa1==$i) echo "selected"; ?>><?php echo $i; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control rounded-0" id="masajabatan2" name="masajabatan2" required>
                                                    <option value="">Tahun Akhir</option>
                                                    <?php
                                                    $y1 = date("Y")-5;
                                                    $y2 = date("Y")+5;
                                                    for($i=$y1; $i<=$y2; $i++) {
                                                        ?>
                                                        <option value="<?php echo $i; ?>" <?php if($vmasa2==$i) echo "selected"; ?>><?php echo $i; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-9 offset-lg-3">
                                                <label class="form-text">Isi dengan tahun awal dan tahun akhir masa jabatan kepala daerah</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="pb-2" style="font-size: 16px;"><b>DATA KONTAK PIC</b></p>
                                        <div class="row mb-2">
                                            <label for="nmpic" class="col-md-3 mb-2">Nama PIC</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control rounded-0" id="nmppic" name="nmpic" maxlength="200" value="<?php echo $vnmpic; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="nohppic" class="col-md-3 mb-2">No. Handphone PIC</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control rounded-0" id="nohppic" name="nohppic" maxlength="20" value="<?php echo $vnohppic; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="emailpic" class="col-md-3 mb-2">Email PIC</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control rounded-0" id="emailppic" name="emailpic" maxlength="200" value="<?php echo $vemailpic; ?>" required>
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
    function ambilketskala() {
        var xid = document.getElementById("idskala").value;
        var xdv = document.getElementById("ketskala");

        if (xid === "") {
            xdv.style.display = "none";
        } else {
            xdv.style.display = "block";
        }

        $.ajax({
            url: "<?php echo base_url('main/skala_bisnis_desc'); ?>",
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