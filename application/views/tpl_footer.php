<footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">&copy; 2022 Ditjen PEN</p>
    <ul class="nav col-md-8 justify-content-end">
      <li class="nav-item"><a href="<?php echo base_url('main'); ?>" class="nav-link px-2 text-muted">Beranda</a></li>
      <li class="nav-item"><a href="<?php echo base_url('main/kategori'); ?>" class="nav-link px-2 text-muted">Kategori</a></li>
      <li class="nav-item"><a href="<?php echo base_url('main/keistimewaan'); ?>" class="nav-link px-2 text-muted">Keistimewaan</a></li>
      <li class="nav-item"><a href="<?php echo base_url('main/formulir'); ?>" class="nav-link px-2 text-muted">Formulir Pendaftaran</a></li>
      <?php
      if(!empty($this->session->sessemail)) {
        ?>
        <li class="nav-item"><a href="<?php echo base_url('main/beranda'); ?>" class="nav-link px-2 text-muted">Akun Primaniyarta</a></li>
        <li class="nav-item"><a href="<?php echo base_url('main/logout'); ?>" class="nav-link px-2 text-muted">Logout</a></li>
        <?php
      }
      else {
        ?>
        <li class="nav-item"><a href="<?php echo base_url('main/daftar'); ?>" class="nav-link px-2 text-muted">Pendaftaran Akun</a></li>
        <li class="nav-item"><a href="<?php echo base_url('main'); ?>" class="nav-link px-2 text-muted">Login</a></li>
        <?php
      }
      ?>
    </ul>
</footer>
</body>
</html>