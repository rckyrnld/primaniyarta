<section class="container my-5">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <p class="fs-5" style="border-bottom: 1px solid #1F1F1F"><i class="fa-solid fa-right-to-bracket"></i> DAFTAR AKUN PRIMANIYARTA</p>
                <p>Pendaftaran Akun Anda <span class="text-danger">gagal</span>. Akun dengan alamat email <b><?php echo $this->session->sessemailada; ?></b> sudah terdaftar. Harap <?php echo base_url('main'); ?>login dengan email tersebut.</p>
                <?php
                $this->session->unset_userdata('sessemailada');
                ?>
            </div>
        </div>
    </div>
</section>