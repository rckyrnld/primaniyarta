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
                                    <li>LAIN LAIN</li>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">LAIN LAIN</p>
                                <?php
                                if(!empty($this->session->sessupdatelainlain)) {
                                    ?>
                                    <div class="alert alert-<?php echo $this->session->sesscw; ?> rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdatelainlain; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdatelainlain');
                                            $this->session->unset_userdata('sesscw');
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="card rounded-0">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs" id="nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link <?php if($page=="naker") echo "active"; ?>"  href="<?php echo base_url('main/lainlain/naker'); ?>">TENAGA KERJA</a>
                                            </li>
                                            <!--<li class="nav-item">
                                                <a class="nav-link <?php if($page=="sertifikasi") echo "active"; ?>" href="<?php echo base_url('main/lainlain/sertifikasi'); ?>">SERTIFIKASI</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if($page=="penghargaan") echo "active"; ?>" href="<?php echo base_url('main/lainlain/penghargaan'); ?>">PENGHARGAAN</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if($page=="csr") echo "active"; ?>" href="<?php echo base_url('main/lainlain/csr'); ?>">CSR</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if($page=="lh") echo "active"; ?>" href="<?php echo base_url('main/lainlain/lh'); ?>">LINGKUNGAN HIDUP</a>
                                            </li>-->
                                        </ul>
                                    </div>
                                    <?php
                                    if($page=="naker") {
                                        ?>
                                        <!-- nilai penjualan start -->
                                        <div class="card-body">
                                            <div class="row py-2">
                                                <form id="frmnaker" name="frmnaker" method="post" action="<?php echo base_url('main/simpannaker'); ?>">
                                                <input type="hidden" id="idnaker" name="idnaker" value="<?php echo $idnaker; ?>">
                                                <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $idprofil; ?>">
                                                    <div class="row mb-2">
                                                        <label for="tahun" class="col-md-3 mb-2">Tahun</label>
                                                        <div class="col-md-2">
                                                            <select class="form-control rounded-0" id="tahun" name="tahun">
                                                                <option value=""></option>
                                                                <?php
                                                                $dt = date("Y");
                                                                $dt1 = $dt-1;
                                                                $dt2 = $dt-6; 
                                                                if(!empty($idnaker)) {
                                                                    ?>
                                                                    <option value="<?php echo $vtahunnaker; ?>" selected><?php echo $vtahunnaker; ?></option>
                                                                    <?php
                                                                }
                                                                for ($i = $dt1; $i > $dt2; --$i) {
                                                                    if($this->primamod->cektahunnaker($idprofil, $i)==FALSE) {
                                                                        ?>
                                                                        <option value="<?php echo $i; ?>" <?php if($vtahunnaker==$i) echo "selected"; ?>><?php echo $i; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="lokal" class="col-md-3 mb-2">Tenaga Lokal</label>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control rounded-0" id="lokal" name="lokal" maxlength="6" value="<?php echo $vlokal; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="asing" class="col-md-3 mb-2">Tenaga Asing</label>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control rounded-0" id="asing" name="asing" maxlength="6" value="<?php echo $vasing; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group py-2">
                                                        <div class="row">
                                                            <div class="col-lg-6 my-2">
                                                                <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                            </div>
                                                            <div class="col-lg-6 my-2">
                                                                <a class="btn btn-warning col-lg-6 form-control rounded-0" href="<?php echo base_url('main/lainlain/naker'); ?>"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                                                            <th scope="col">Tahun</th>
                                                            <th scope="col">Tenaga Lokal</th>
                                                            <th scope="col">Tenaga Asing</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $d = $naker->result();
                                                        $n = $naker->num_rows();
                                                        if($n > 0) {
                                                            for ($i = 0; $i < count($d); ++$i) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1; ?></td>
                                                                <td><?php echo $d[$i]->tahun; ?></td>
                                                                <td><?php echo number_format($d[$i]->lokal); ?></td>
                                                                <td><?php echo number_format($d[$i]->asing); ?></td>
                                                                <td class="text-end">
                                                                    <a href="<?php echo base_url('main/lainlain/naker/'.$this->secure->encrypt_url($d[$i]->idtenagakerja)); ?>" class="text-success">Edit</a> | 
                                                                    <a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?php echo $i; ?>">Hapus</a>
                                                                </td>
                                                            </tr>
                                                            <!-- modal hapus start -->
                                                            <div class="modal fade rounded-0" tabindex="-1" id="modalhapus<?php echo $i; ?>" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
                                                                <div class = "modal-dialog">
                                                                    <div class = "modal-content">
                                                                    <form role="form" method="post" action="<?=base_url()?>main/hapusnaker">
                                                                        <input type="hidden" name="idprofil" id="idprofil" value="<?php echo $d[$i]->idprofil; ?>" />
                                                                        <input type="hidden" name="idnaker" id="idnakerl" value="<?php echo $d[$i]->idtenagakerja; ?>" />
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
                                        <!-- nilai penjualan end -->
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
    $("#frmnaker").validate({
        rules: {  
            tahun: "required",
            lokal: {
                required: true,
                number: true
            },
            asing: {
                required: true,
                number: true
            }
        },
        messages: {
            tahun: "Harap dipilih",
            lokal: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            asing: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            }
        }
    });

    $("#frmekspor").validate({
        rules: {  
            idproduk: "required",
            idnegara: "required",
            rasio_2019: {
                required: true,
                number: true
            },
            rasio_2020: {
                required: true,
                number: true
            },
            rasio_2021: {
                required: true,
                number: true
            }
        },
        messages: {
            idproduk: "Harap dipilih",
            idnegara: "Harap dipilih",
            rasio_2019: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            rasio_2020: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            },
            rasio_2021: {
                required: "Harap diisi",
                number: "Harap diisi dengan angka"
            }
        }
    });
  
    $("#frmsurvey").validate({
        rules: {
            frekuensi_kirim_barang: "required",
            metode_penjualan: "required",
            punya_anak_perusahaan: "required",
            idpelabuhan: "required"  
        },
        messages: {
            frekuensi_kirim_barang: "Harap dipilih",
            metode_penjualan: "Harap dipilih",
            punya_anak_perusahaan: "Harap dipilih",
            idpelabuhan: "Harap dipilih"  
        }
    });
</script>