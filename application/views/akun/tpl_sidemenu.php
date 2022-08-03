<?php
//cek kategori primaniyarta
$ck = $this->primamod->cekkepaladaerah($this->decrypt_userid);
?>
<aside id="sidebar">
    <ul class="sidebar-menu">
        <li class="sub-menu"><a href="<?php echo base_url('main/beranda'); ?>">Beranda</a></li>
        <?php
        /*if($this->decrypt_profilid==0 || $ck==FALSE) {
            ?>
            <li class="sub-menu"><a href="<?php echo base_url('main/profil'); ?>">Profil Perusahaan</a></li>
            <?php
        }
        if($this->decrypt_profilid==0 || $ck==TRUE) {
            ?>
            <li class="sub-menu"><a href="<?php echo base_url('main/kepaladaerah'); ?>">Profil Kepala Daerah</a></li>
            <?php
        }*/
        if($this->decrypt_profilid!=0) {
            if($ck==TRUE) {
                ?>
                <li class="sub-menu"><a href="<?php echo base_url('main/kepaladaerah'); ?>">Profil Kepala Daerah</a></li>
                <li class="sub-menu"><a href="<?php echo base_url('main/kebijakan'); ?>">Kebijakan Ekspor</a></li>
                <li class="sub-menu"><a href="<?php echo base_url('main/kisahkepaladaerah'); ?>">Kisah Keberhasilan</a></li>
                <?php
            }
            else {
                ?>
                <li class="sub-menu"><a href="<?php echo base_url('main/profil'); ?>">Profil Perusahaan</a></li>
                <li class="sub-menu"><a href="<?php echo base_url('main/pilihkategori'); ?>">Kategori Primaniyarta</a></li>
                <li class="sub-menu"><a href="<?php echo base_url('main/kontakpic'); ?>">Kontak Perusahaan</a></li>
                <li class="sub-menu"><a href="<?php echo base_url('main/produk'); ?>">Produk Ekspor</a></li>
                <li class="sub-menu"><a href="<?php echo base_url('main/bahanbaku'); ?>">Bahan Baku</a></li>
                <li class="sub-menu"><a href="<?php echo base_url('main/penjualan'); ?>">Penjualan</a></li>
                <li class="sub-menu"><a href="<?php echo base_url('main/pajak'); ?>">Perpajakan</a></li>
                <li class="sub-menu"><a href="<?php echo base_url('main/kisah'); ?>">Kisah Keberhasilan</a></li>
                <li class="sub-menu"><a href="<?php echo base_url('main/lainlain'); ?>">Lain-lain</a></li>
                <li class="sub-menu"><a href="<?php echo base_url('main/dokumen'); ?>">Dokumen Pendukung</a></li>
                <?php
            }
        }
        ?>
        <li class="sub-menu"><a href="<?php echo base_url('main/logout'); ?>">Logout</a></li>
    </ul>
</aside>