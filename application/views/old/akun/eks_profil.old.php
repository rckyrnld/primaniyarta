<section class="row my-5">
    <div style="background-color: #333; color: #fff;">
        <div class="container">
            <p class="pt-3"><span style="font-size: 16px;">Akun Primaniyarta</span><br>
            <span style="font-size: 18px;"><i class="fa-solid fa-user"></i> &nbsp;<b><?php echo strtoupper($nmuser); ?></b></span></p>
        </div>
    </div>
    <div class="container py-3">
        <?php $this->load->view('akun/eks_navlink'); ?>
        <div class="row">
            <div class="container">
                <!-- side menu start -->
                <div class="col-lg-2">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            The current link item
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                        <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                        <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                        <a class="list-group-item list-group-item-action disabled">A disabled link item</a>
                    </div>
                </div>
                <!-- side menu end -->

                <!-- main container start -->
                <div class="col-lg-6">
                    <div class="container">
                        <div class="row card">
                            <div class="card-body">
                                <p style="border-bottom: 1px solid #1F1F1F">FORM PROFIL PERUSAHAAN</p>   
                                <form name="frmprof" id="frmprof" method="post" action="<?php echo base_url('main/simpan_profil_eks'); ?>">
                                    <input type="hidden" id="emailuser" name="emailuser" value="<?php echo $this->session->sessemail; ?>">
                                    <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $this->session->sessprofilid; ?>">
                                    <div class="form-group col-lg-2 py-2">
                                        <label for="nama" class="mb-2">Badan Usaha</label>
                                        <select class="form-control rounded-0" id="idbadanusaha" name="idbadanusaha" required>
                                            <option value=""></option>
                                            <?php
                                            $d = $bu->result();
                                            $n = $bu->num_rows();
                                            if($n > 0) {
                                                for ($i = 0; $i < count($d); ++$i) {
                                                ?>
                                                <option value="<?php echo $d[$i]->idbadanusaha; ?>" <?php if($d[$i]->idbadanusaha==$vidbu) { echo "selected"; } ?>><?php echo $d[$i]->nmbadanusaha; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
                                        <label for="nama" class="mb-2">Nama Perusahaan</label>
                                        <input type="text" class="form-control rounded-0" id="nmperusahaan" name="nmperusahaan" maxlength="200" value="<?php echo $vnmprsh; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
                                        <label for="nama" class="mb-2">NPWP</label>
                                        <input type="text" class="form-control rounded-0" id="npwp" name="npwp" maxlength="15" value="<?php echo $vnpwp; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
                                        <label for="nama" class="mb-2">NIB</label>
                                        <input type="text" class="form-control rounded-0" id="nib" name="nib" maxlength="13" value="<?php echo $vnib; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-2 py-2">
                                        <label for="nama" class="mb-2">Jenis Penanaman Modal</label>
                                        <select class="form-control rounded-0" id="idmodal" name="idmodal" required>
                                            <option value=""></option>
                                            <?php
                                            $d = $mo->result();
                                            $n = $mo->num_rows();
                                            if($n > 0) {
                                                for ($i = 0; $i < count($d); ++$i) {
                                                ?>
                                                <option value="<?php echo $d[$i]->idmodal; ?>" <?php if($d[$i]->idmodal==$vidmo) { echo "selected"; } ?>><?php echo $d[$i]->nmmodal; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2 py-2">
                                        <label for="nama" class="mb-2">Skala Bisnis</label>
                                        <select class="form-control rounded-0" id="idskala" name="idskala" required>
                                            <option value=""></option>
                                            <?php
                                            $d = $sb->result();
                                            $n = $sb->num_rows();
                                            if($n > 0) {
                                                for ($i = 0; $i < count($d); ++$i) {
                                                ?>
                                                <option value="<?php echo $d[$i]->idskala; ?>" <?php if($d[$i]->idskala==$vidsb) { echo "selected"; } ?>><?php echo $d[$i]->nmskala; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2 py-2">
                                        <label for="nama" class="mb-2">Jenis Usaha</label>
                                        <select class="form-control rounded-0" id="idjenis" name="idjenis" required>
                                            <option value=""></option>
                                            <?php
                                            $d = $ju->result();
                                            $n = $ju->num_rows();
                                            if($n > 0) {
                                                for ($i = 0; $i < count($d); ++$i) {
                                                ?>
                                                <option value="<?php echo $d[$i]->idjenis; ?>" <?php if($d[$i]->idjenis==$vidju) { echo "selected"; } ?>><?php echo $d[$i]->nmjenis; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2 py-2">
                                        <label for="nama" class="mb-2">Tahun Perusahaan Berdiri</label>
                                        <input type="text" class="form-control rounded-0" id="tahunberdiri" name="tahunberdiri" maxlength="4" value="<?php echo $vtahun; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-2 py-2">
                                        <label for="nama" class="mb-2">Tahun Mulai Ekspor</label>
                                        <input type="text" class="form-control rounded-0" id="tahunekspor" name="tahunekspor" maxlength="4" value="<?php echo $vtahunekspor; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
                                        <label for="nama" class="mb-2">Bank Korespondensi</label>
                                        <input type="text" class="form-control rounded-0" id="bank" name="bank" maxlength="50" value="<?php echo $vbank; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
                                        <label for="nama" class="mb-2">Email</label>
                                        <input type="text" class="form-control rounded-0" id="email" name="email" maxlength="200" value="<?php echo $vemail; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
                                        <label for="nama" class="mb-2">Website</label>
                                        <input type="text" class="form-control rounded-0" id="website" name="website" value="<?php echo $vwebsite; ?>" maxlength="200">
                                    </div>
                                    <div class="col-lg-6">
                                        <hr>
                                    </div>
                                    <div>
                                        <p class="col-lg-6 py-2"><b>Alamat dan Kontak Perusahaan</b></p>
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
                                        <label for="nama" class="mb-2">Provinsi</label>
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
                                    <div class="form-group col-lg-4 py-2">
                                        <label for="nama" class="mb-2">Kota</label>
                                        <input type="text" class="form-control rounded-0" id="kota" name="kota" maxlength="100" value="<?php echo $vkota; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
                                        <label for="nama" class="mb-2">Alamat</label>
                                        <textarea class="form-control rounded-0"" id="alamat" name="alamat" maxlength="200" required><?php echo $valamat; ?></textarea>
                                    </div>
                                    <div class="form-group col-lg-4 py-2">
                                        <label for="nama" class="mb-2">Telepon</label>
                                        <input type="text" class="form-control rounded-0" id="telepon" name="telepon" maxlength="50" value="<?php echo $vtelepon; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-4 py-2">
                                        <label for="nama" class="mb-2">Fax</label>
                                        <input type="text" class="form-control rounded-0" id="fax" name="fax" maxlength="50" value="<?php echo $vfax; ?>">
                                    </div>
                                    <div>
                                        <p class="col-lg-6 py-2"><b>Alamat dan Kontak Pabrik</b></p>
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
                                        <label for="nama" class="mb-2">Provinsi</label>
                                        <select class="form-control rounded-0" id="idprovinsipabrik" name="idprovinsipabrik">
                                            <option value=""></option>
                                            <?php
                                            $d = $prov->result();
                                            $n = $prov->num_rows();
                                            if($n > 0) {
                                                for ($i = 0; $i < count($d); ++$i) {
                                                ?>
                                                <option value="<?php echo $d[$i]->idprovinsi; ?>" <?php if($d[$i]->idprovinsi==$vidprovpab) { echo "selected"; } ?>><?php echo $d[$i]->provinsi_id; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 py-2">
                                        <label for="nama" class="mb-2">Kota</label>
                                        <input type="text" class="form-control rounded-0" id="kotapabrik" name="kotapabrik" maxlength="100" value="<?php echo $vkotapab; ?>">
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
                                        <label for="nama" class="mb-2">Alamat</label>
                                        <textarea class="form-control rounded-0"" id="alamatpabrik" name="alamatpabrik" maxlength="200"><?php echo $valamatpab; ?></textarea>
                                    </div>
                                    <div class="form-group col-lg-4 py-2">
                                        <label for="nama" class="mb-2">Telepon</label>
                                        <input type="text" class="form-control rounded-0" id="teleponpabrik" name="teleponpabrik" maxlength="50" value="<?php echo $vteleponpab; ?>">
                                    </div>
                                    <div class="form-group col-lg-4 py-2">
                                        <label for="nama" class="mb-2">Fax</label>
                                        <input type="text" class="form-control rounded-0" id="faxpabrik" name="faxpabrik" maxlength="50" value="<?php echo $vfaxpab; ?>">
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
                                        <button type="submit" class="btn btn-success rounded-0" name="submit" id="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- main kontainer end -->

                <!-- progress info start -->
                <div class="col-lg-2">

                </div>
                <!-- progress infon end -->
            </div>
        </div>
    </div>
</section>
<script>
    // validasi form
    $("#frmprof").validate({
        rules: {
            idbadanusaha: "required",
            nmperusahaan: "required",
            npwp: {
                required: true,
                number: true
            },
            nib: {
                required: true,
                number: true
            },
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
            idbadanusaha: "Badan usaha harap dipilih",
            nmperusahaan: "Nama perusahaan harap diisi",
            npwp: {
                required: "No NPWP harap diisi",
                number: "Harap diisi dengan angka"
            }
        }
    });
</script>