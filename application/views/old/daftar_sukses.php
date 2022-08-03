<!DOCTYPE html>
<html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Primaniyarta <?php echo date("Y"); ?></title>

<!-- CSS-->
<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/jquery-ui-themes/themes/base/jquery-ui.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

<!-- Javascript -->
<script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/jquery-ui/jquery-ui.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>

<!-- Fontawesome -->
<script src="https://kit.fontawesome.com/ba229b614c.js" crossorigin="anonymous"></script>

<!-- google font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">

<!-- style -->
<style>
    .navbar-nav {
        margin-left: auto;
    }

    .text-icon {
        font-size: 1.5em;
        font-weight: normal;
    }

    .input-icons i {
        position: absolute;
        right: 0;
        margin-right: 20px;
    }
          
    .input-icons {
        width: 100%;
        margin-bottom: 10px;
    }
        
    .icon {
        padding: 10px;
        min-width: 40px;
    }
          
    .input-field {
        width: 100%;
        padding: 10px;
        text-align: center;
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: none;
    }
    body {
        font-family: 'Assistant', sans-serif;
    }
</style>

</head>

<body>

<!-- header -->
<header class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url('assets/images/kemendag-prima.png'); ?>" width="120" alt="" class="d-inline-block align-text-center">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <span class="mr-auto text-icon">PRIMANIYARTA <?php echo date("Y"); ?></span>
            <ul class="navbar-nav">
                <li class="nav-item <?php if($menu=="home") echo 'active'; ?>">
                    <a class="nav-link" href="<?php echo base_url(); ?>">Beranda</a>
                </li>
                <li class="nav-item dropdown <?php if($menu=="tentang") echo 'active'; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbartentang" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tentang</a>
                    <div class="dropdown-menu" aria-labelledby="navbartentang">
                        <a class="dropdown-item" href="<?php echo base_url('tentang'); ?>">Tentang Primaniyarta</a>
                        <a class="dropdown-item" href="<?php echo base_url('tentang/kategori'); ?>">Kategori Primaniyarta</a>
                        <a class="dropdown-item" href="<?php echo base_url('tentang/keuntungan'); ?>">Keuntungan Meraih Penghargaan</a>
                    </div>
                </li>
                <li class="nav-item <?php if($menu=="jadwal") echo 'active'; ?>">
                    <a class="nav-link" href="<?php echo base_url(); ?>">Jadwal</a>
                </li>
                <li class="nav-item <?php if($menu=="pendaftaran") echo 'active'; ?>">
                    <a class="btn btn-success mx-2 rounded-0" href="<?php echo base_url('pendaftaran'); ?>">Pendaftaran</a>
                </li>
                <li class="nav-item <?php if($menu=="login") echo 'active'; ?>">
                    <a class="btn btn-primary rounded-0" href="<?php echo base_url('login'); ?>">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<section class="container my-5">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <p class="fs-5" style="border-bottom: 1px solid #1F1F1F"><i class="fa-solid fa-pen-to-square"></i> FORM PENDAFTARAN PRIMANIYARTA</p>
                <p>Pendaftaran Akun Anda berhasil. Silahkan <a href="<?php echo base_url('primaniyarta/login'); ?>">Login</a> untuk melengkapi isian form pendaftaran Primaniyarta <?php echo date("Y"); ?>.</p>
            </div>
        </div>
    </div>
</section>
<footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">&copy; 2022 Ditjen PEN</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Beranda</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Tentang</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Jadwal</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pendaftaran</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Login</a></li>
    </ul>
  </footer>

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
</body>
</html>