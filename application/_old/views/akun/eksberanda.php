<?php
//cek kategori primaniyarta
$ck = $this->primamod->cekkepaladaerah($this->decrypt_profilid);
?>
<section id="main-content">
    <div class="wrapper site-min-height">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mb-2">
                    <div class="card rounded-0">
                        <div class="card-body">
                            <div class="bc">
                                <ul>
                                    <li>Beranda</li>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">BERANDA</p>
                                <div class="row">
                                    <p>Selamat datang di pendaftaran Primaniyarta <?php echo date("Y"); ?>.</p>
                                    <?php
                                    if($ck==FALSE) {
                                        //cek apakah sudah mengisi profil perusahaan
                                        $c = $this->primamod->cekprofil($this->decrypt_email);
                                        if($c==FALSE) {
                                            ?>
                                            <p>Akun Anda belum mendaftarkan profil perusahaan. Harap mengisi form <b>Profil Perusahaan</b> <a href="<?php echo base_url('main/tambahprofil'); ?>">disini</a>.</p>
                                            <?php
                                        }
                                        else {
                                            //ambil badan usaha
                                            $bu = $this->primamod->ambilprofil($this->decrypt_profilid)->row()->nmbadanusaha;
                                            //ambil nama perusahaaan
                                            $np = $this->primamod->ambilprofil($this->decrypt_profilid)->row()->nmperusahaan;
                                            ?>
                                            <p>Nama Perusahaan terdaftar <b><?php echo $np.", ".$bu; ?></b>.
                                            <?php
                                            //ambil nama kategori primaniyarta yang dipilih
                                            $k = $this->primamod->ambilkategoripilih($this->decrypt_profilid, "")->result();
                                            $nk = $this->primamod->ambilkategoripilih($this->decrypt_profilid, "")->num_rows();
                                            if($nk>0) {
                                                ?>
                                                <p>Kategori Primaniyarta yang dipilih:</p>
                                                <ul class="mx-4">
                                                <?php
                                                for($i=0;$i<$nk;$i++) {
                                                    $b = "";
                                                    if($k[$i]->utama=="1") { $b = "class='fw-bold'"; }
                                                    ?>
                                                    <li <?php echo $b; ?>><?php echo $k[$i]->nmkategori." "; if($k[$i]->utama=="1") { echo "(Utama)"; } else { echo "(Non Utama)"; } ?></li>
                                                    <?php
                                                }
                                                ?>
                                                </ul>
                                                <?php
                                            }
                                            ?>
                                            
                                            <?php
                                        }
                                    }
                                    else {
                                        //ambil data kepala daerah
                                        $ak = $this->primamod->ambilkepaladaerah($this->decrypt_profilid)->row();
                                        ?>
                                        <p><b>Ringkasan Pendaftaran Primaniyarta <?php echo date("Y"); ?></b></p>
                                        <div class="row pb-2">
                                            <label class="col-lg-3">Kategori Primaniyarta</label>
                                            <div class="col-lg-9">Kepala Daerah Pendukung Ekspor</div>
                                        </div>
                                        <div class="row pb-2">
                                            <label class="col-lg-3">Nama Kepala Daerah</label>
                                            <div class="col-lg-9"><?php echo $ak->nmpejabat; ?></div>
                                        </div>
                                        <div class="row pb-2">
                                            <label class="col-lg-3">Jabatan</label>
                                            <div class="col-lg-9">
                                            <?php
                                            if($ak->idtingkat==1) { echo "Gubernur"; }
                                            if($ak->idtingkat==2) { echo "Walikota"; }
                                            if($ak->idtingkat==3) { echo "Bupati"; }
                                            ?>
                                            </div>
                                        </div>
                                        <div class="row pb-2">
                                            <label class="col-lg-3">Provinsi</label>
                                            <div class="col-lg-9"><?php echo $ak->provinsi_id; ?></div>
                                        </div>
                                        <?php
                                        if($ak->idtingkat!=1) {
                                            ?>
                                            <div class="row pb-2">
                                                <label class="col-lg-3">Kota</label>
                                                <div class="col-lg-9"><?php echo $ak->kota; ?></div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    if($this->decrypt_profilid==0) {
                                        ?>
                                        <p>Untuk pendaftaran Primaniyarta kategori <b>Kepala Daerah Pendukung Ekspor</b> daftar <a href="#">disini</a></p>
                                        <?php
                                    }
                                    ?>
                                    <!--<p>Pendaftaran Primaniyarta akan berakhir pada tanggal <b>1 Juli 2022</b>. Harap melengkapi isian pendaftaran sebelum tanggal tersebut.</p>-->
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