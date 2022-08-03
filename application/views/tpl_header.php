<?php
setlocale(LC_ALL, 'IND');
?>
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
                    <a class="nav-link" href="<?php echo base_url('main'); ?>">Beranda</a>
                </li>
                <li class="nav-item <?php if($menu=="kategori") echo 'active'; ?>">
                    <a class="nav-link" href="<?php echo base_url('main/kategori'); ?>">Kategori</a>
                </li>
                <li class="nav-item <?php if($menu=="keistimewaan") echo 'active'; ?>">
                    <a class="nav-link" href="<?php echo base_url('main/keistimewaan'); ?>">Keistimewaan Primaniyarta</a>
                </li>
                <li class="nav-item <?php if($menu=="formulir") echo 'active'; ?>">
                    <a class="nav-link" href="<?php echo base_url('main/formulir'); ?>">Formulir Pendaftaran</a>
                </li>
                <?php
                if(!empty($this->session->sessemail)) {
                    ?>
                    <li class="nav-item <?php if($menu=="daftar") echo 'active'; ?>">
                        <a class="btn btn-success mx-2 rounded-0" href="<?php echo base_url('main/beranda'); ?>">Akun Primaniyarta</a>
                    </li>
                    <li class="nav-item <?php if($menu=="login") echo 'active'; ?>">
                        <a class="btn btn-primary rounded-0" href="<?php echo base_url('main/logout'); ?>">Logout</a>
                    </li>
                    <?php
                }
                else {
                    ?>
                    <li class="nav-item <?php if($menu=="daftar") echo 'active'; ?>">
                        <a class="btn btn-success mx-2 rounded-0" href="<?php echo base_url('main/daftar'); ?>">Pendaftaran Akun</a>
                    </li>
                    <li class="nav-item <?php if($menu=="login") echo 'active'; ?>">
                        <a class="btn btn-primary rounded-0" href="<?php echo base_url('main'); ?>">Login</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</header>