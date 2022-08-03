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
                                    <li>Kisah Keberhasilan</LI>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">KISAH KEBERHASILAN</p>
                                <?php
                                if(!empty($this->session->sessupdatekisah)) {
                                    ?>
                                    <div class="alert alert-<?php echo $this->session->sesscw; ?> rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdatekisah; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdatekisah');
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row py-2">
                                    <form id="frmprof" name="frmprof" method="post" action="<?php echo base_url('main/simpankisah'); ?>">
                                        <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $idprofil; ?>">
                                        <?php
                                        $k = $kat->result();
                                        for ($i = 0; $i < count($k); ++$i) {
                                            $bp = FALSE;
                                            $ki = $this->primamod->ambilkisah($k[$i]->idkategori, $idprofil);
                                            $nki = $ki->num_rows();
                                            $no = "";
                                            if($nki>0) { $bp = TRUE; }
                                            if($kat->num_rows()>0) { 
                                                $no = $i+1;
                                                $no = $no.". "; 
                                            }
                                            $idkisah = $bp==TRUE ? $ki->row()->idkisah : "";
                                            $kisah = $bp==TRUE ? $ki->row()->kisah : "";
                                            ?>
                                            <input type="hidden" id="idkategori" name="idkategori[]" value="<?php echo $k[$i]->idkategori; ?>">
                                            <input type="hidden" id="idkisah" name="idkisah[]" value="<?php echo $idkisah; ?>">
                                            <p class="mt-2"><b><?php echo $no; ?>Kategori <?php echo $k[$i]->nmkategori; ?></b></p>
                                            <div class="row pb-2">
                                                <label for="textkisah">Ceritakan kisah keberhasilan ekspor Anda</label>
                                                <div class="col-lg-12 py-2">
                                                    <textarea class="form-control rounded-0" id="editor" name="kisah[]"><?php echo $kisah; ?></textarea>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="form-group pb-4">
                                            <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                            <label class="text-danger">Pastikan klik tombol submit setelah mengisi data kisah keberhasilan</label>
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