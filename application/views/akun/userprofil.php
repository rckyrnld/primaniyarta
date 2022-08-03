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
                                    <li>Profil User</li>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">PROFIL USER</p>
                                <?php
                                if(!empty($this->session->sessupdateprofiluser)) {
                                    ?>
                                    <div class="alert alert-success rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdateprofiluser; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdateprofiluser');
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row py-2">
                                    <form id="frmprof" name="frmprof" method="post" action="<?php echo base_url('main/updateprofiluser'); ?>">
                                        <input type="hidden" id="iduser" name="iduser" value="<?php echo $iduser; ?>">
                                        <input type="hidden" id="emailuser" name="emailuser" value="<?php echo $email; ?>">
                                        <div class="row mb-2">
                                            <label for="email" class="col-md-3 mb-2">Email</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control rounded-0" id="email" name="email" maxlength="200" value="<?php echo $email; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="nama" class="col-md-3 mb-2">Nama</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control rounded-0" id="nama" name="nama" maxlength="200" value="<?php echo $vnama; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="nohp" class="col-md-3 mb-2">No. HP / Whatsapp</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control rounded-0" id="nohp" name="nohp" maxlength="20" value="<?php echo $vnohp; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="status" class="col-md-3 mb-2">Status Pendaftar</label>
                                            <div class="col-md-4">
                                                <p>
                                                <?php
                                                if($vgub=="1") { echo "Kepala Daerah"; }
                                                else { echo "Eksportir"; }
                                                ?>
                                                </p>
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
    // validasi form
    $("#frmprof").validate({
        rules: {
            nama: "required",  
            nohp: "required"
        },
        messages: {
            nama: "Harap diisi",
            nohp: "Harap diisi"
        }
    });
</script>