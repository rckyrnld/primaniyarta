<section id="main-content">
    <div class="wrapper site-min-height">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mb-2">
                    <div class="card rounded-0">
                        <div class="card-body">
                            <div class="bc">
                                <ul>
                                    <li><a href="#home">Beranda</a></li>
                                    <li><a href="">Kategori Primaniyarta</a></li>
                                    <li>Konfirmasi Kategori Primaniyarta</li>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">KONFIRMASI KATEGORI PRIMANIYARTA</p>
                                <div class="row">
                                    <p>Nama Perusahaan</p>
                                    <?php
                                    //ambil badan usaha
                                    $bu = $this->primamod->ambil_badanusaha($this->session->sessprofilid)->row()->nmbadanusaha;
                                    //ambil nama perusahaaan
                                    $np = $this->primamod->ambil_profil($this->session->sessprofilid)->row()->nmperusahaan;
                                    ?>
                                    <p><b><?php echo $np.", ".$bu; ?></b></p>
                                    <p class="pt-4">Kategori yang dipilih:</p>
                                    <p><b><?php echo $kat->nmkategori; ?></b></p>
                                    <p><?php echo $kat->keterangan; ?></p>
                                    <form id="frmkat" name="frmkat" method="post" action="<?php echo base_url('main/simpan_kategori_eks'); ?>">
                                        <input type="hidden" id="idkategori" name="idkategori" value="<?php echo $kat->idkategori; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" id="submit" name="submit" class="btn btn-success form-control rounded-0" href="">Pilih Kategori</button>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="btn btn-danger form-control rounded-0" href="<?php echo base_url('akun/kategori'); ?>">Batal</a>
                                            </div>
                                        </div>
                                        <label class="form-text">Kategori Primaniyarta tidak dapat diubah setelah dipilih kecuali atas persetujuan panitia Primaniyarta</label>
                                    </form>
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