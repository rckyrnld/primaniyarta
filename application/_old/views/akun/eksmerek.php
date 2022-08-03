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
                                    <li><a href="<?php echo base_url('main/produk'); ?>">Produk Ekspor</a></li>
                                    <li>Merek</li>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">MEREK</p>
                                <?php
                                if(!empty($this->session->sessupdatemerek)) {
                                    ?>
                                    <div class="alert alert-success rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdatemerek; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdatemerek');
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="card rounded-0">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs" id="nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($page=="form") echo "active"; ?>"  href="<?php echo base_url('main/merek/form'); ?>">MEREK</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($page=="daftar") echo "active"; ?>" href="<?php echo base_url('main/merek/daftar'); ?>">INFORMASI PENDAFTARAN MEREK</a>
                                        </li>
                                        </ul>
                                    </div>
                                    <?php
                                    if($page=="form") {
                                        ?>
                                        <!-- form merek start -->
                                        <div class="card-body">
                                            <div class="row py-2">
                                                <form id="frmmerek" name="frmmerek" method="post" action="<?php echo base_url('main/simpanmerek'); ?>">
                                                <input type="hidden" id="idmerek" name="idmerek" value="<?php echo $idmerek; ?>">
                                                <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $idprofil; ?>">
                                                    <div class="row mb-2">
                                                        <label for="nama" class="col-md-3 mb-2">Nama Merek</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control rounded-0" id="nmmerek" name="nmmerek" maxlength="200" value="<?php echo $vnmmerek; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group py-2">
                                                        <div class="row">
                                                            <div class="col-lg-6 my-2">
                                                                <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                            </div>
                                                            <div class="col-lg-6 my-2">
                                                                <a class="btn btn-warning col-lg-6 form-control rounded-0" href="<?php echo base_url('main/merek'); ?>"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                                                            <th scope="col">Nama Merek</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $d = $merek->result();
                                                        $n = $merek->num_rows();
                                                        if($n > 0) {
                                                            for ($i = 0; $i < count($d); ++$i) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1; ?></td>
                                                                <td><?php echo $d[$i]->nmmerek; ?></td>
                                                                <td class="text-end">
                                                                    <a href="<?php echo base_url('main/merek/form/'.$this->secure->encrypt_url($d[$i]->idmerek)); ?>" class="text-success">Edit</a> | 
                                                                    <a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?php echo $i; ?>">Hapus</a>
                                                                </td>
                                                            </tr>
                                                            <!-- modal hapus start -->
                                                            <div class="modal fade rounded-0" tabindex="-1" id="modalhapus<?php echo $i; ?>" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
                                                                <div class = "modal-dialog">
                                                                    <div class = "modal-content">
                                                                    <form role="form" method="post" action="<?=base_url()?>main/hapusmerek">
                                                                        <input type="hidden" name="iddaftar" id="idprofil" value="<?php echo $d[$i]->idprofil; ?>" />
                                                                        <input type="hidden" name="idmerek" id="idmerek" value="<?php echo $d[$i]->idmerek; ?>" />
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
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- form merek end -->
                                        <?php
                                        }
                                        if($page=="daftar") {
                                            ?>
                                            <!-- survey start -->
                                            <div class="card-body">
                                                <div class="row py-2">
                                                    <form id="frmdaftar" name="frmdaftar" method="post" action="<?php echo base_url('main/simpandaftarmerek'); ?>">
                                                        <input type="hidden" id="idmerek" name="idmerek" value="<?php echo $idmerek; ?>">
                                                        <input type="hidden" id="iddaftar" name="iddaftar" value="<?php echo $iddaftar; ?>">
                                                        <div class="row mb-2">
                                                            <label for="merek" class="col-md-3 mb-2">Merek</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control rounded-0" id="idmerek" name="idmerek">
                                                                    <option value=""></option>
                                                                    <?php
                                                                    $d = $merek->result();
                                                                    $n = $merek->num_rows();
                                                                    if($n > 0) {
                                                                        for ($i = 0; $i < count($d); ++$i) {
                                                                            ?>
                                                                            <option value="<?php echo $d[$i]->idmerek; ?>" <?php if($d[$i]->idmerek==$vidmerek) { echo "selected"; } ?>><?php echo $d[$i]->nmmerek; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="tgldaftar" class="col-md-3 mb-2">Tanggal Daftar Merek</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control rounded-0" id="datepicker" name="tgldaftar"  class="datepicker_input form-control" placeholder="dd/mm/yyyy" maxlength="10" value="<?php echo $vtgldaftar; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="idnegara" class="col-md-3 mb-2">Negara Daftar Merek</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control rounded-0" id="idnegara" name="idnegara">
                                                                    <option value=""></option>
                                                                    <?php
                                                                    $d = $neg->result();
                                                                    $n = $neg->num_rows();
                                                                    if($n > 0) {
                                                                        for ($i = 0; $i < count($d); ++$i) {
                                                                        ?>
                                                                        <option value="<?php echo $d[$i]->idnegara; ?>" <?php if($d[$i]->idnegara==$vidnegara) { echo "selected"; } ?>><?php echo $d[$i]->negara; ?></option>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group py-2">
                                                            <div class="row">
                                                                <div class="col-lg-6 my-2">
                                                                    <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                                </div>
                                                                <div class="col-lg-6 my-2">
                                                                    <a class="btn btn-warning col-lg-6 form-control rounded-0" href="<?php echo base_url('main/merek/daftar'); ?>"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                                                                <th scope="col">Nama Merek</th>
                                                                <th scope="col">Tanggal Daftar</th>
                                                                <th scope="col">Negara</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $d = $daftar->result();
                                                            $n = $daftar->num_rows();
                                                            if($n > 0) {
                                                                for ($i = 0; $i < count($d); ++$i) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i+1; ?></td>
                                                                    <td><?php echo $d[$i]->nmmerek; ?></td>
                                                                    <td><?php echo $this->primamod->ubahtanggal("-", $d[$i]->tgldaftar); ?></td>
                                                                    <td><?php echo $d[$i]->negara; ?></td>
                                                                    <td class="text-end">
                                                                        <a href="<?php echo base_url('main/merek/daftar/'.$this->secure->encrypt_url($d[$i]->iddaftar)); ?>" class="text-success">Edit</a> | 
                                                                        <a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?php echo $i; ?>">Hapus</a>
                                                                    </td>
                                                                </tr>
                                                                <!-- modal hapus start -->
                                                                <div class="modal fade rounded-0" tabindex="-1" id="modalhapus<?php echo $i; ?>" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
                                                                    <div class = "modal-dialog">
                                                                        <div class = "modal-content">
                                                                        <form role="form" method="post" action="<?=base_url()?>main/hapusdaftarmerek">
                                                                            <input type="hidden" name="iddaftar" id="iddaftar" value="<?php echo $d[$i]->iddaftar; ?>" />
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
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- survey end -->
                                            <?php
                                        }
                                    ?>
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
    $("#frmmerek").validate({
        rules: {
            nmmerek: "required"
        },
        messages: {
            nmmerek: "Harap diisi"
        }
    });
  
    $("#frmdaftar").validate({
        rules: {
            idmerek: "required",
            tgldaftar: "required",
            idnegara: "required"  
        },
        messages: {
            idmerek: "Harap dipilih",
            tgldaftar: "Harap diisi",
            idnegara: "Harap dipilih"
        }
    });
</script>