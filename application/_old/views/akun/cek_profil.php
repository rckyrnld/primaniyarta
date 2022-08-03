<section class="row my-5">
    <div style="background-color: #333; color: #fff;">
        <div class="container">
            <p class="pt-3"><span style="font-size: 16px;">Akun Primaniyarta</span><br>
            <span style="font-size: 18px;"><i class="fa-solid fa-user"></i> &nbsp;<b><?php echo strtoupper($nmuser); ?></b></span></p>
        </div>
    </div>
    <div class="container py-3">
        <?php $this->load->view('akun/eks_navlink'); ?>
        <div class="container">
            <div class="row card">
                <div class="card-body">
                    <p style="border-bottom: 1px solid #1F1F1F">FORM PROFIL PERUSAHAAN</p>   
                    <p><i class="fa-solid fa-check"></i> Cek status pendaftaran perusahaan</p>
                    <form name="frmceknpwp" id="frmceknpwp" method="post" action="<?php echo base_url('main/cek_npwp'); ?>">
                        <div class="row mb-2">
                            <label for="nama" class="col-md-3 col-form-label">NPWP</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control rounded-0" id="npwp" name="npwp" maxlength="15" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-success rounded-0" name="submit" id="submit">Cek Status Perusahaan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // validasi form
    $("#frmceknpwp").validate({
        rules: {
            npwp: {
                required: true,
                number: true
            }
        },
        messages: {
            npwp: {
                required: "No NPWP harap diisi",
                number: "Harap diisi dengan angka"
            }
        }
    });
</script>