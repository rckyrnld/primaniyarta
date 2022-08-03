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
                                    <li>Kategori Primaniyarta</li>
                                </ul>
                            </div>
                            <div>
                                <p class="pt-2" style="font-size: 16px;">KATEGORI PRIMANIYARTA</p>
                                <?php
                                 if(!empty($this->session->sessupdatekategori)) {
                                    ?>
                                    <div class="alert alert-success rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdatekategori; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdatekategori');
                                        ?>
                                    </div>
                                    <?php
                                }
                                else {
                                    ?>
                                    <div class="alert alert-info rounded-0" role="alert">
                                        Anda dapat memilih kategori Primaniyarta lebih dari satu.
                                    </div>
                                    <?php
                                }
                                ?>
                                <form id="frmkat" name="frmkat" method="post" action="<?php echo base_url('main/simpankategorilainnya'); ?>">
                                    <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $this->decrypt_profilid; ?>">
                                    <input type="hidden" id="idpilih" name="idpilih" value="<?php echo $idpilih; ?>">
                                    <div class="row mb-2">
                                        <label for="idkategori"  class="col-md-4 mb-2">Pilih Kategori Primaniyarta Lainnya</label>
                                        <div class="col-md-5">
                                            <select class="form-control rounded-0" id="idkategori" name="idkategori" onchange="ambilketerangan()" required>
                                                <option value=""></option>
                                                <?php
                                                if(!empty($idpilih)) {
                                                    ?>
                                                    <option value="<?php echo $vidkat; ?>" selected><?php echo $vnmkat; ?></option>
                                                    <?php
                                                }
                                                $d = $katp->result();
                                                $n = $katp->num_rows();
                                                if($n > 0) {
                                                    for ($i = 0; $i < count($d); ++$i) {
                                                        $ckat = $this->primamod->cekkategorilain($d[$i]->idkategori, $this->decrypt_profilid);
                                                        if($ckat==TRUE) {
                                                            ?>
                                                            <option value="<?php echo $d[$i]->idkategori; ?>" <?php if($d[$i]->idkategori==$vidkat) { echo "selected"; } ?>><?php echo $d[$i]->nmkategori; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-8 offset-md-4 mt-2" id="ketkatprima" name="ketkatprima" style="display: none">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="form-group py-2">
                                        <div class="row">
                                            <div class="col-lg-6 my-2">
                                                <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                            </div>
                                            <div class="col-lg-6 my-2">
                                                <a class="btn btn-warning col-lg-6 form-control rounded-0" href="<?php echo base_url('main/pilihkategori'); ?>"><i class="fa-solid fa-rotate"></i> Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive py-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kategori Yang Dipilih</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $d = $kat->result();
                                        $n = $kat->num_rows();
                                        if($n > 0) {
                                            for ($i = 0; $i < count($d); ++$i) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i+1; ?></td>
                                                    <td><?php echo $d[$i]->nmkategori; ?></td>
                                                    <td>
                                                        <?php
                                                        if($d[$i]->utama == "1") { echo "Utama"; }
                                                        else { echo "Non Utama"; }
                                                        ?>
                                                    </td>
                                                    <td class="text-end">
                                                        <?php
                                                        if($d[$i]->utama=="0") {
                                                            ?>
                                                            <a href="<?php echo base_url('main/pilihkategori/'.$this->secure->encrypt_url($d[$i]->idpilih)); ?>" class="text-success">Edit</a> |
                                                            <a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?php echo $i; ?>">Hapus</a>
                                                            <?php
                                                        }
                                                        else { echo "&nbsp"; }
                                                        ?>
                                                        
                                                    </td>
                                                </tr>
                                                <!-- modal hapus start -->
                                                <div class="modal fade rounded-0" tabindex="-1" id="modalhapus<?php echo $i; ?>" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
                                                    <div class = "modal-dialog">
                                                        <div class = "modal-content">
                                                        <form role="form" method="post" action="<?=base_url()?>main/hapuskategorilainnya">
                                                            <input type="hidden" name="idprofil" id="idprofil" value="<?php echo $d[$i]->idprofil; ?>" />
                                                            <input type="hidden" name="idpilih" id="idpilih" value="<?php echo $d[$i]->idpilih; ?>" />
                                                                <div class = "modal-header">
                                                                <p class = "modal-title" id = "modallabel"><i class="fa fa-trash"></i> HAPUS DATA</p>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                </div>
                                                                <div class = "modal-body">
                                                                    <p>YAKIN DATA AKAN <span class="text-danger">DIHAPUS</span> ?</p>
                                                                </div>
                                                                <div class = "modal-footer">
                                                                    <button type = "submit" class = "btn btn-success"><i class="fa fa-check"></i> Ya</button>
                                                                    <button type = "button" class = "btn btn-danger" data-dismiss = "modal" data-bs-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                                                                </div>
                                                            </form>   
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->   
                                                </div><!-- modal hapus end -->
                                                <?php
                                            }
                                        }
                                        else {
                                            ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <p class="form-text">Untuk mengubah pilihan kategori Primaniyarta utama harap hubungi panitia di primaniyarta@kemendag.go.id</p>
                        </div>  
                    </div>
                </div>
                <?php $this->load->view('akun/tpl_progress'); ?>
            </div>
        </div>
    </div>
</section>
<script>
    function ambilketerangan() {
        var xid = document.getElementById("idkategori").value;
        var xdv = document.getElementById("ketkatprima");

        if (xid === "") {
            xdv.style.display = "none";
        } else {
            xdv.style.display = "block";
        }

        $.ajax({
            url: "<?php echo base_url('main/ambilketerangan'); ?>",
            type: "POST",
            data: {
               idkat: xid
            },
            dataType: "json",
            success: function(res) {
                $("#ketkatprima").html(res);
            }
        });

    }

    // validasi form
    $("#frmkat").validate({
        rules: {
            idkategori: "required"
        },
        messages: {
            idkategori: "Kategori Primaniyarta harap dipilih"
        }
    });
</script>