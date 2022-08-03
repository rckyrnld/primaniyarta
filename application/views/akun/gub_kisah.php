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
                                    <li>Kisah Keberhasilan</LI>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;"><b>KISAH KEBERHASILAN</b></p>
                                <?php
                                if(!empty($this->session->sessupdatekisah)) {
                                    ?>
                                    <div class="alert alert-success rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdatekisah; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdatekisah');
                                        ?>
                                    </div>
                                    <?php
                                }
                                else {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Halaman untuk mengisi kisah keberhasilan kebijakan ekspor yang dibuat
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row py-2">
                                    <form id="frmkisah" name="frmkisah" method="post" action="<?php echo base_url('main/simpankisahgub'); ?>">
                                        <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $idprofil; ?>">
                                        <input type="hidden" id="idkisah" name="idkisah" value="<?php echo $idkisah; ?>">
                                        <div class="row">
                                            <label for="textkisah">Ceritakan kisah keberhasilan penerapan kebijakan pendukung ekspor dalam meningkatkan ekspor di daerah Anda</label>
                                            <div class="col-lg-12 py-2">
                                                <textarea class="form-control rounded-0" id="editor" name="kisah"><?php echo $vkisah; ?></textarea>
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