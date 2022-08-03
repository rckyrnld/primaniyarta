<!-- main content start -->
<section class="container my-5">
    <div class="row">
        <div class="col-lg-7 my-4">
            <div class="alert alert-warning rounded-0 mb-4" role="alert">
              Untuk mengisi form pendaftaran harap menbuat akun terlebih dahulu
            </div>
            <img src="<?php echo base_url('assets/images/undraw_publish_post_re_wmql.svg'); ?>" style="width: 80%;" class="img-fluid" />
        </div>
        <div class="col-lg-5">
            <div class="card rounded-0">
                <div class="card-body">
                    <p class="fs-5" style="border-bottom: 1px solid #1F1F1F"><i class="fa-solid fa-right-to-bracket"></i> DAFTAR AKUN PRIMANIYARTA</p>
                    <form name="frmreg" id="frmreg" method="post" action="<?php echo base_url('main/daftaruser'); ?>" >
                        <div class="form-group py-2">
                            <label for="nama" class="mb-2">Nama Lengkap</label>
                            <input type="text" class="form-control rounded-0" id="nama" name="nama" required>
                        </div>
                        <div class="form-group py-2">
                            <label for="email" class="mb-2">Email</label>
                            <input type="email" class="form-control rounded-0" id="email" name="email" required>
                        </div>
                        <div class="form-group py-2">
                            <label for="nohp" class="mb-2">No. Handphone / Whatsapp</label>
                            <input type="text" class="form-control rounded-0" id="nohp" name="nohp" required>
                        </div>
                        <div class="form-group py-2">
                            <label for="password" class="mb-2">Password</label>
                            <div class="input-icons" id="show_hide_password">
                                <i class="fas fa-eye icon" id="show_eye" onclick="password_show_hide()" title="Tampilkan password"></i>
                                <i class="fas fa-eye-slash icon d-none" id="hide_eye" onclick="password_show_hide()" title="Sembunyikan password"></i>
                                <input type="password" class="form-control rounded-0" id="password" name="password" required>
                            </div>
                            <div id="passwordHelp" class="form-text">Password minimal 8 karakter</div>
                        </div>
                        <div class="form-group py-2">
                            <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Daftar</button>
                        </div>
                        <hr>
                        <p class="text-center" style="font-size: 14px;">Sudah punya akun?
                        <a href="<?php echo base_url('main'); ?>" style="text-decoration: none">Login disini</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- main content end -->

<script>
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }

    // validasi form
    $("#frmreg").validate({
        rules: {
            nama: "required",
            email: {
                required: true,
                email: true
            },
            nohp: {
                required: true,
                number: true
            },
            password: {
                required: true,
                minlength: 8
            },
        },
        messages: {
            nama: "Nama harap diisi",
            email: "Harap isi email dengan benar",
            nohp: {
                required: "No Handphone / Whatsapp harap diisi",
                number: "Harap diisi dengan angka"
            },
            password: {
                required: "Password harap diisi",
                minlength: "Password minimal 8 karakter"
            }
        }
    });
</script>