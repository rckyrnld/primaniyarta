<?php
//cek kategori primaniyarta
$ck = $this->primamod->cekkepaladaerah($this->decrypt_profilid);
?>
<div class="col-lg-3">
    <div class="card rounded-0">
        <div class="card-body">
            <label style="font-size: 14px;">Progress Pengisian Form </label>
            <?php
            if($ck==TRUE) {
                ?>
                <p class="text-center text-<?php $this->primamod->textpersenprogressgub($this->decrypt_profilid); ?> mt-2" style="font-size: 40px;"><b><?php echo number_format($this->primamod->persenprogressgub($this->decrypt_profilid)); ?>%</b></p>
                <div class="progress mt-2 mb-4" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped bg-<?php $this->primamod->textpersenprogressgub($this->decrypt_profilid); ?>" role="progressbar" style="width: <?php echo number_format($this->primamod->persenprogressgub($this->decrypt_profilid)); ?>%" aria-valuenow="<?php echo number_format($this->primamod->persenprogressgub($this->decrypt_profilid)); ?>" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <label class="<?php echo $this->primamod->textcolorprogress("profilgub", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("profilgub", $this->decrypt_profilid); ?> Profil Kepala Daerah</label><br>
                <label class="<?php echo $this->primamod->textcolorprogress("kebijakangub", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("kebijakangub", $this->decrypt_profilid); ?> Kebijakan Ekspor</label><br>
                <label class="<?php echo $this->primamod->textcolorprogress("kisahgub", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("kisahgub", $this->decrypt_profilid); ?> Kisah Keberhasilan</label>
                <?php
            }
            else {
                ?>
                <p class="text-center text-<?php $this->primamod->textpersenprogress($this->decrypt_profilid); ?> mt-2" style="font-size: 40px;"><b><?php echo number_format($this->primamod->persenprogress($this->decrypt_profilid)); ?>%</b></p>
                <div class="progress mt-2 mb-4" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped bg-<?php $this->primamod->textpersenprogress($this->decrypt_profilid); ?>" role="progressbar" style="width: <?php echo number_format($this->primamod->persenprogress($this->decrypt_profilid)); ?>%" aria-valuenow="<?php echo number_format($this->primamod->persenprogress($this->decrypt_profilid)); ?>" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <label class="<?php echo $this->primamod->textcolorprogress("profil", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("profil", $this->decrypt_profilid); ?> Profil Perusahaan Form </label><br>
                <label class="<?php echo $this->primamod->textcolorprogress("kategori", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("kategori", $this->decrypt_profilid); ?> Kategori Primaniyarta</label><br>
                <label class="<?php echo $this->primamod->textcolorprogress("kontak", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("kontak", $this->decrypt_profilid); ?> Kontak Perusahaan </label><br>
                <label class="<?php echo $this->primamod->textcolorprogress("produk", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("produk", $this->decrypt_profilid); ?> Produk Ekspor </label><br>
                <label class="<?php echo $this->primamod->textcolorprogress("bahanbaku", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("bahanbaku", $this->decrypt_profilid); ?> Bahan Baku </label><br>
                <label class="<?php echo $this->primamod->textcolorprogress("penjualan", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("penjualan", $this->decrypt_profilid); ?> Penjualan </label><br>
                <label class="<?php echo $this->primamod->textcolorprogress("pajak", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("pajak", $this->decrypt_profilid); ?> Perpajakan </label><br>
                <label class="<?php echo $this->primamod->textcolorprogress("kisah", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("kisah", $this->decrypt_profilid); ?> Kisah Keberhasilan </label><br>
                <label class="<?php echo $this->primamod->textcolorprogress("lainlain", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("lainlain", $this->decrypt_profilid); ?> Lain-lain </label><br>
                <label class="<?php echo $this->primamod->textcolorprogress("dokumen", $this->decrypt_profilid); ?>" style="font-size: 14px;"><?php $this->primamod->iconprogress("dokumen", $this->decrypt_profilid); ?> Dokumen Pendukung </label>
                <?php
            }
            ?>
        </div>
    </div>
</div>