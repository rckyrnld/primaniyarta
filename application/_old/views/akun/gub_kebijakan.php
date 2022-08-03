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
                                    <li>Kebijakan Ekspor</LI>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;"><b>KEBIJAKAN EKSPOR</b></p>
                                <?php
                                if(!empty($this->session->sessupdatekebijakan)) {
                                    ?>
                                    <div class="alert alert-success rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdatekebijakan; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdatekebijakan');
                                        ?>
                                    </div>
                                    <?php
                                }
                                else {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Halaman untuk mengisi data kebijakan ekspor kepala daerah
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row py-2">
                                    <form id="frmkebijakan" name="frmkebijakan" method="post" action="<?php echo base_url('main/simpan_kebijakan_gub'); ?>" enctype="multipart/form-data">
                                        <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $this->decrypt_profilid; ?>">
                                        <div class="row mb-2">
                                            <label for="tglkebijakan" class="col-md-3 col-form-label">Tanggal Kebijakan</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control rounded-0" id="datepicker" name="tglkebijakan" maxlength="10" value="<?php echo $vtglkebijakan; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="nokebijakan" class="col-md-3 col-form-label">No. Kebijakan</label>
                                            <div class="col-md-6">
                                                <input type="text" class=" form-control rounded-0" id="nokebijakan" name="nokebijakan" maxlength="50" value="<?php echo $vnokebijakan; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="nokebijakan" class="col-md-3 col-form-label">Nama Kebijakan</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control rounded-0" id="nmkebijakan" name="nmkebijakan" maxlength="200" value="<?php echo $vnmkebijakan; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="nokebijakan" class="col-md-3 col-form-label">Dokumen Kebijakan</label>
                                            <div class="col-md-9">
                                                <input type="file" class="form-control rounded-0" id="file" name="file">
                                            </div>
                                            <?php 
                                            if($vfile!="") {
                                                ?>
                                                <div class="col-lg-9 offset-lg-3">
                                                    <label class="form-text">File Sebelumnya</label><br>
                                                    <label class="form-text"><a href="<?php echo base_url('assets/uploads/kebijakan/'.$vfile); ?>"><?php echo $vfile; ?></a></label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="form-group py-2">
                                            <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- table start -->
                                <div class="table-responsive py-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">No. Kebijakan</th>
                                                <th scope="col">Nama Kebijakan</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $d = $kebijakan->result();
                                            $n = $kebijakan->num_rows();
                                            if($n > 0) {
                                                for ($i = 0; $i < count($d); ++$i) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i+1; ?></td>
                                                        <td><?php echo $this->primamod->ubahtanggal("-", $d[$i]->tglkebijakan); ?></td>
                                                        <td><?php echo $d[$i]->nokebijakan; ?></td>
                                                        <td><?php echo $d[$i]->nmkebijakan; ?></td>
                                                        <td>
                                                            <a href="<?php echo base_url('akun/kepaladaerah/kebijakan/'.$this->secure->encrypt_url($d[$i]->idkebijakan)); ?>" style="text-decoration: none; color: green;">Edit</a> | 
                                                            <a href="<?php echo base_url('akun/kepaladaerah/hapuskebijakan/'.$this->secure->encrypt_url($d[$i]->idkebijakan)); ?>" style="text-decoration: none; color: red;">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- table end -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('akun/eks_tpl_progress'); ?>
            </div>
        </div>
    </div>
</section>
<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: 'dd/mm/yy',
            changeYear: true,
            changeMonth: true
        });
    } );

    $("#frmkebijakan").validate({
        rules: {  
            tglkebijakan: "required",
            nokebijakan: "required",
            nmkebijakan: "required",
            file: "required"
        },
        messages: {
            tglkebijakan: "Harap diisi",
            nokebijakan: "Harap diisi",
            nmkebijakan: "Harap diisi",
            file: "Harap dipilih"
        }
    });
</script>