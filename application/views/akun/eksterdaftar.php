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
                                    <li><a href="<?php echo base_url('main/ceknpwp'); ?>">Cek NPWP Perusahaan</a></li>
                                    <li>Perusahaan Sudah Terdaftar</li>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">PERUSAHAAN SUDAH TERDAFTAR</p>
                                <p>NPWP: <b><?php echo $npwp_user; ?></b> a.n <b><?php echo $np_user.", ".$nb_user; ?></b> sudah didaftarkan oleh user dengan alamat email <b><?php echo $email_user; ?></b></p>
                                <p>Ingin mendaftarkan perusahaan yang lain? Daftar <a href="<?php echo base_url('main/tambahprofil'); ?>">disini</a>.
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('akun/tpl_progress'); ?>
            </div>
        </div>
    </div>
</section>