<section class="container my-5">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <p class="fs-5" style="border-bottom: 1px solid #1F1F1F">DAFTAR AKUN PRIMANIYARTA</p>
                <p>Pendaftaran Akun Anda <span class="text-danger">gagal</span>. Akun dengan alamat email <b><?php echo $this->session->sessemailada; ?></b> sudah terdaftar. Harap <a href="<?php echo base_url('main'); ?>">Login</a> dengan email tersebut, atau kembali ke halaman <a href="<?php echo base_url('main/daftar'); ?>">Pendaftaran</a> untuk mendaftar dengan alamat email yang berbeda.</p>
                <p><a href="<?php echo base_url('main'); ?>" class="btn btn-primary rounded-0">Ke Halaman Login</a>
                    <a href="<?php echo base_url('main/daftar'); ?>" class="btn btn-success rounded-0">Ke Halaman Pendaftaran</a></p>
                <?php
                $this->session->unset_userdata('sessemailada');
                ?>
            </div>
        </div>
    </div>
</section>