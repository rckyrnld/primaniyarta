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
                                    <li>Kontak Perusahaan</LI>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">KONTAK PERUSAHAAN</p>
                                <?php
                                if(!empty($this->session->sessupdatekontak)) {
                                    ?>
                                    <div class="alert alert-success rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdatekontak; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdatekontak');
                                        ?>
                                    </div>
                                    <?php
                                }
                                else {
                                    ?>
                                    <div class="alert alert-warning rounded-0" role="alert">
                                        Halaman untuk mengisi data kontak perusahaan. Kontak perusahaan bisa diisi lebih dari satu orang.
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row py-2">
                                    <form id="frmkontak" name="frmkontak" method="post" action="<?php echo base_url('main/simpan_kontak_eks'); ?>">
                                    <input type="hidden" id="idkontak" name="idkontak" value="<?php echo $vidkontak; ?>">
                                    <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $this->session->sessprofilid; ?>">
                                        <div class="row mb-2">
                                            <label for="nama" class="col-md-3 mb-2">Nama</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control rounded-0" id="nama" name="nama" maxlength="200" value="<?php echo $vnama; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="jabatan" class="col-md-3 mb-2">Jabatan</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control rounded-0" id="jabatan" name="jabatan" maxlength="200" value="<?php echo $vjabatan; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="email" class="col-md-3 mb-2">Email</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control rounded-0" id="email" name="email" maxlength="200" value="<?php echo $vemail; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="telepon" class="col-md-3 mb-2">Telepon</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control rounded-0" id="telepon" name="telepon" maxlength="50" value="<?php echo $vtelp; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group py-2">
                                            <div class="row">
                                                <div class="col-lg-6 my-2">
                                                    <button type="submit" class="btn btn-success col-lg-6 form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                </div>
                                                <div class="col-lg-6 my-2">
                                                    <a class="btn btn-warning col-lg-6 form-control rounded-0" href="<?php echo base_url('akun/kontak'); ?>"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                                                <th scope="col">Nama</th>
                                                <th scope="col">Jabatan</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Telepon</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $d = $kontak->result();
                                            $n = $kontak->num_rows();
                                            if($n > 0) {
                                                for ($i = 0; $i < count($d); ++$i) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i+1; ?></td>
                                                    <td><?php echo $d[$i]->namakontak; ?></td>
                                                    <td><?php echo $d[$i]->jabatan; ?></td>
                                                    <td><?php echo $d[$i]->email; ?></td>
                                                    <td><?php echo $d[$i]->telepon; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url('akun/kontak/'.$d[$i]->idkontak); ?>" style="text-decoration: none; color: green;">Edit</a> | 
                                                        <a href="#" style="text-decoration: none; color: red;">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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
    // validasi form
    $("#frmkontak").validate({
        rules: {
            nama: "required",  
            jabatan: "required",
            email: {
                required: true,
                email: true
            },
            telepon: "required"
        },
        messages: {
            nama: "Harap diisi",
            jabatan: "Harap diisi",
            email: {
                required: "Harap diisi",
                email: "Email harap diisi dengan benar"
            },
            telepon: "Harap diisi"
        }
    });
</script>
