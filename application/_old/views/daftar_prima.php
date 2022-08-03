<section class="container my-5">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <p class="fs-5" style="border-bottom: 1px solid #1F1F1F"><i class="fa-solid fa-pen-to-square"></i> FORM PENDAFTARAN PRIMANIYARTA</p>
                    <p><i class="fa-solid fa-square-caret-right"></i> Buat Akun Primaniyarta</p>
                    <form name="frmreg" id="frmreg" method="post" action="<?php echo base_url('main/daftar_user_eks'); ?>" >
                        <div class="form-group py-2">
                            <label for="nama" class="mb-2">Nama Lengkap</label>
                            <input type="text" class="form-control rounded-0" id="nama" name="nama" required>
                        </div>
                        <div class="form-group py-2">
                            <label for="email" class="mb-2">Email</label>
                            <input type="email" class="form-control rounded-0" id="email" name="email" required>
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
                            <button type="submit" class="btn btn-success rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <p class="fs-5" style="border-bottom: 1px solid #1F1F1F"><i class="fa-solid fa-list-check"></i> SYARAT-SYARAT PENDAFTARAN</p>
                </div>
            </div>
        </div>
    </div>
</section>
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
            password: {
                required: true,
                minlength: 8
            },
        },
        messages: {
            nama: "Nama harap diisi",
            email: "Harap isi email dengan benar",
            password: {
                required: "Password harap diisi",
                minlength: "Password minimal 8 karakter"
            }
        }
    });
</script>
