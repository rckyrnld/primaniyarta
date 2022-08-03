<section class="container my-5">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <p class="fs-5" style="border-bottom: 1px solid #1F1F1F"><i class="fa-solid fa-right-to-bracket"></i> LOGIN PRIMANIYARTA</p>
                <p>Login <span class="text-danger">gagal</span>. Harap mencoba <a href="<?php echo base_url('main'); ?>">login</a> kembali.</p>
                <?php
                $this->session->unset_userdata('sessemailada');
                ?>
            </div>
        </div>
    </div>
</section>