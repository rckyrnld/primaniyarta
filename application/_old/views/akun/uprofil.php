<section id="main-content">
    <div class="wrapper site-min-height">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="bc">
                        <ul>
                            <li><a href="#home">Home</a></li>
                            <li>Profil Perusahaan</li>
                        </ul>
                        <p class="py-2" style="font-size: 16px;">PROFIL PERUSAHAAN</p>
                        <div class="alert alert-warning" role="alert">
                            Halaman untuk mengisi data profil perusahaan
                        </div>
                        <form id="frmprof" name="frmprof" method="post" action="<?php echo base_url('main/simpan_profil_eks'); ?>">
                            <div class="row">
                                <div class="col-lg-6 px-4" style="border-right: 1px solid #efefef;">
                                    <div class="form-group col-lg-3 py-2">
                                        <div><label for="nama" class="mb-2">Badan Usaha</label></div>
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
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Nama Perusahaan</label>
                                        <input type="text" class="form-control rounded-0" id="nmperusahaan" name="nmperusahaan" maxlength="200" value="<?php echo $vnmprsh; ?>" required>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">NPWP</label>
                                        <input type="text" class="form-control rounded-0" id="npwp" name="npwp" maxlength="15" value="<?php echo $vnpwp; ?>" required>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">NIB</label>
                                        <input type="text" class="form-control rounded-0" id="nib" name="nib" maxlength="13" value="<?php echo $vnib; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-6 py-2">
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
                                    <div class="form-group col-lg-6 py-2">
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
                                    <div class="form-group col-lg-6 py-2">
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
                                    <div class="form-group col-lg-4 py-2">
                                        <label for="nama" class="mb-2">Tahun Perusahaan Berdiri</label>
                                        <input type="text" class="form-control rounded-0" id="tahunberdiri" name="tahunberdiri" maxlength="4" value="<?php echo $vtahun; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-4 py-2">
                                        <label for="nama" class="mb-2">Tahun Mulai Ekspor</label>
                                        <input type="text" class="form-control rounded-0" id="tahunekspor" name="tahunekspor" maxlength="4" value="<?php echo $vtahunekspor; ?>" required>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Bank Korespondensi</label>
                                        <input type="text" class="form-control rounded-0" id="bank" name="bank" maxlength="50" value="<?php echo $vbank; ?>" required>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Email</label>
                                        <input type="text" class="form-control rounded-0" id="email" name="email" maxlength="200" value="<?php echo $vemail; ?>" required>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Website</label>
                                        <input type="text" class="form-control rounded-0" id="website" name="website" value="<?php echo $vwebsite; ?>" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-lg-6 px-4">
                                    <div class="col"><label><b>Alamat dan Kontak Perusahaan</b></label></div>
                                    <div class="form-group py-2">
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
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Kota</label>
                                        <input type="text" class="form-control rounded-0" id="kota" name="kota" maxlength="100" value="<?php echo $vkota; ?>" required>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Alamat</label>
                                        <textarea class="form-control rounded-0"" id="alamat" name="alamat" maxlength="200" required><?php echo $valamat; ?></textarea>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Telepon</label>
                                        <input type="text" class="form-control rounded-0" id="telepon" name="telepon" maxlength="50" value="<?php echo $vtelepon; ?>" required>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Fax</label>
                                        <input type="text" class="form-control rounded-0" id="fax" name="fax" maxlength="50" value="<?php echo $vfax; ?>">
                                    </div>
                                    <div class="col pt-4"><label><b>Alamat dan Kontak Pabrik</b></label>
                                    </div>
                                    <div class="form-group py-2">
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
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Kota</label>
                                        <input type="text" class="form-control rounded-0" id="kotapabrik" name="kotapabrik" maxlength="100" value="<?php echo $vkotapab; ?>">
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Alamat</label>
                                        <textarea class="form-control rounded-0"" id="alamatpabrik" name="alamatpabrik" maxlength="200"><?php echo $valamatpab; ?></textarea>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Telepon</label>
                                        <input type="text" class="form-control rounded-0" id="teleponpabrik" name="teleponpabrik" maxlength="50" value="<?php echo $vteleponpab; ?>">
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="nama" class="mb-2">Fax</label>
                                        <input type="text" class="form-control rounded-0" id="faxpabrik" name="faxpabrik" maxlength="50" value="<?php echo $vfaxpab; ?>">
                                    </div>
                                </div>
                                <div class="form-group px-4 py-2">
                                    <button type="submit" class="btn btn-success rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function ambilketerangan() {
        var xid = document.getElementById("idkategori").value;
        var xdv = document.getElementById("ketkatprima");

        if (xid === "") {
            xdv.style.display = "none";
        } else {
            xdv.style.display = "block";
        }

        $.ajax({
            url: "<?php echo base_url('main/ambil_keterangan'); ?>",
            type: "POST",
            data: {
               idkat: xid
            },
            dataType: "json",
            success: function(res) {
                $("#ketkatprima").html(res);
            }
        });
    }

    // validasi form
    $("#frmkat").validate({
        rules: {
            idperusahaan: "required",
            idkategori: "required"
        },
        messages: {
            idperusahaan: "Perusahaan harap dipilih",
            idkategori: "Kategori Primaniyarta harap dipilih"
        }
    });
</script>