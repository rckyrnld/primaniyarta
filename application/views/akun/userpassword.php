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
                                    <li>Ganti Password</li>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">GANTI PASSWORD</p>
                                <?php
                                if(!empty($this->session->sessupdatepassword)) {
                                    ?>
                                    <div class="alert alert-success rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdatepassword; 

                                            //destroy session sessupdatepassword
                                            $this->session->unset_userdata('sessupdatepassword');
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row py-2">
                                    <form id="frmreset" name="frmreset" method="post" action="<?php echo base_url('main/gantipassword'); ?>">
                                        <input type="hidden" id="status" name="status" value="ganti">
                                        <input type="hidden" id="email" name="email" value="<?php echo $this->decrypt_email; ?>">
                                        <div class="row mb-2">
                                            <label for="password" class="col-md-4 mb-2">Password Baru</label>
                                            <div class="col-md-6">
                                                <input type="password" class="form-control rounded-0" id="password" name="password" maxlength="32" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="password" class="col-md-4 mb-2">Ketik Ulang Password Baru</label>
                                            <div class="col-md-6">
                                                <input type="password" class="form-control rounded-0" id="repassword" name="repassword" maxlength="32" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                            </div>
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
    // validasi form
    $("#frmreset").validate({
        rules: {
            password: {
                required: true,
                minlength: 8
            },
            repassword: {
                required: true,
                minlength: 8,
                equalTo: '[name="password"]'
            }
        },
        messages: {
            password: {
                required: "Harap diisi",
                minlength: "Password minimal 8 karakter"
            },
            repassword: {
                required: "Harap diisi",
                minlength: "Password minimal 8 karakter",
                equalTo: "Isian password tidak sama"
            }
        }
    });
</script>