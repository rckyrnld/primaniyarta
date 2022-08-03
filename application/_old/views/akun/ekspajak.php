<section id="main-content">
    <div class="wrapper site-min-height">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mb-2">
                    <div class="card rounded-0">
                        <div class="card-body">
                            <div class="bc">
                                <ul>
                                    <li><a href="<?php echo base_url('main/beranda'); ?>">Beranda</a></li>
                                    <li>Perpajakan</li>
                                </ul>
                            </div>
                            <div>
                                <p class="py-2" style="font-size: 16px;">PERPAJAKAN</p>
                                <?php
                                if(!empty($this->session->sessupdatepajak)) {
                                    ?>
                                    <div class="alert alert-<?php echo $this->session->sesscw; ?> rounded-0" role="alert">
                                        <?php 
                                            echo $this->session->sessupdatepajak; 

                                            //destroy session sessupdateprofil
                                            $this->session->unset_userdata('sessupdatepajak');
                                            $this->session->unset_userdata('sesscw');
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row py-2">
                                    <form id="frmpajak" name="frmpajak" method="post" action="<?php echo base_url('main/simpanpajak'); ?>">
                                    <input type="hidden" id="idpajak" name="idpajak" value="<?php echo $idpajak; ?>">
                                    <input type="hidden" id="idprofil" name="idprofil" value="<?php echo $idprofil; ?>">
                                        <div class="row mb-2">
                                            <label for="tahun" class="col-md-3 mb-2">Tahun</label>
                                            <div class="col-md-2">
                                                <select class="form-control rounded-0" id="tahun" name="tahun" required>
                                                    <option value=""></option>
                                                    <?php
                                                    $dt = date("Y");
                                                    $dt1 = $dt-1;
                                                    $dt2 = $dt-6; 
                                                    if(!empty($idpajak)) {
                                                        ?>
                                                        <option value="<?php echo $vtahun; ?>" selected><?php echo $vtahun; ?></option>
                                                        <?php
                                                    }
                                                    for ($i = $dt1; $i > $dt2; --$i) {
                                                        if($this->primamod->cektahunpajak($this->decrypt_profilid, $i)==FALSE) {
                                                            ?>
                                                            <option value="<?php echo $i; ?>" <?php if($vtahun==$i) echo "selected"; ?>><?php echo $i; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-2 mb-2 py-2">
                                            <label for="jenis" class="col-md-3 mb-2">PPh Badan</label>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="statuspphbadan" id="statuspphbadan" value="1" <?php if($vstatuspphbadan=="1") echo "checked"; ?>>
                                                    <label class="form-check-label" for=""statusppn>Tepat Waktu</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="statuspphbadan" id="statuspphbadan" value="2" <?php if($vstatuspphbadan=="2") echo "checked"; ?>>
                                                    <label class="form-check-label" for=""statusppn>Tidak Tepat Waktu</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="statuspphbadan" id="statuspphbadan" value="3" <?php if($vstatuspphbadan=="3") echo "checked"; ?>>
                                                    <label class="form-check-label" for=""statusppn>Disampaikan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="jenis" class="col-md-3 mb-2">Setoran PPh Badan</label>
                                            <div class="col-md-6">
                                                <input type="text" id="nilaipphbadan" name="nilaipphbadan" class="form-control rounded-0" value="<?php echo $vnilaipphbadan; ?>" required>
                                                <label class="form-text">Diisi dengan jumlah yang disetorkan dalam Rupiah</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2 py-2">
                                            <label for="jabatan" class="col-md-3 mb-2">PPN Jan-Des 2021</label>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="statusppn" id="statusppn" value="1" <?php if($vstatusppn=="1") echo "checked"; ?>>
                                                    <label class="form-check-label" for=""statusppn>Tepat Waktu</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="statusppn" id="statusppn" value="2" <?php if($vstatusppn=="2") echo "checked"; ?>>
                                                    <label class="form-check-label" for=""statusppn>Tidak Tepat Waktu</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="statusppn" id="statusppn" value="3" <?php if($vstatusppn=="3") echo "checked"; ?>>
                                                    <label class="form-check-label" for=""statusppn>Disampaikan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="jenis" class="col-md-3 mb-2">Setoran PPN Jan-Des 2021</label>
                                            <div class="col-md-6">
                                                <input type="text" id="nilaippn" name="nilaippn" class="form-control rounded-0" value="<?php echo $vnilaippn; ?>" required>
                                                <label class="form-text">Diisi dengan jumlah yang disetorkan dalam Rupiah</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2 mb-2 py-2">
                                            <label for="jabatan" class="col-md-3 mb-2">PPh Pasal 21</label>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="statuspph21" id="statuspph21" value="1" <?php if($vstatuspph21=="1") echo "checked"; ?>>
                                                    <label class="form-check-label" for=""statusppn>Tepat Waktu</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="statuspph21" id="statuspph21" value="2" <?php if($vstatuspph21=="2") echo "checked"; ?>>
                                                    <label class="form-check-label" for=""statusppn>Tidak Tepat Waktu</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="statuspph21" id="statuspph21" value="3" <?php if($vstatuspph21=="3") echo "checked"; ?>>
                                                    <label class="form-check-label" for=""statusppn>Disampaikan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="jenis" class="col-md-3 mb-2">Setoran PPh Pasal 21</label>
                                            <div class="col-md-6">
                                                <input type="text" id="nilaipph21" name="nilaipph21" class="form-control rounded-0" value="<?php echo $vnilaipph21; ?>" required>
                                                <label class="form-text">Diisi dengan jumlah yang disetorkan dalam Rupiah</label>
                                            </div>
                                        </div>
                                        <div class="form-group py-2">
                                            <div class="row">
                                                <div class="col-lg-6 my-2">
                                                    <button type="submit" class="btn btn-success col-lg-6 form-control rounded-0" name="submit" id="submit"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                                                </div>
                                                <div class="col-lg-6 my-2">
                                                    <a class="btn btn-warning col-lg-6 form-control rounded-0" href="<?php echo base_url('main/kontakpic'); ?>"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                                                <th scope="col">Tahun</th>
                                                <th scope="col" colspan="2">PPh Badan (Rp)</th>
                                                <th scope="col" colspan="2">PPN Jan-Des 2021 (Rp)</th>
                                                <th scope="col" colspan="2">PPh Pasal 21 (Rp)</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $d = $pajak->result();
                                            $n = $pajak->num_rows();
                                            if($n > 0) {
                                                for ($i = 0; $i < count($d); ++$i) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i+1; ?></td>
                                                    <td><?php echo $d[$i]->tahun; ?></td>
                                                    <td><?php echo $this->primamod->konversistatuspajak($d[$i]->status_pph_badan); ?></td>
                                                    <td><?php echo number_format($d[$i]->nilai_pph_badan); ?></td>
                                                    <td><?php echo $this->primamod->konversistatuspajak($d[$i]->status_ppn); ?></td>
                                                    <td><?php echo number_format($d[$i]->nilai_ppn); ?></td>
                                                    <td><?php echo $this->primamod->konversistatuspajak($d[$i]->status_pph_pasal_21); ?></td>
                                                    <td><?php echo number_format($d[$i]->nilai_pph_pasal_21); ?></td>
                                                    <td class="text-end">
                                                        <a href="<?php echo base_url('main/pajak/'.$this->secure->encrypt_url($d[$i]->idpajak)); ?>" class="text-success">Edit</a> | 
                                                        <a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?php echo $i; ?>">Hapus</a>
                                                    </td>
                                                </tr>
                                                <!-- modal hapus start -->
                                                <div class="modal fade rounded-0" tabindex="-1" id="modalhapus<?php echo $i; ?>" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
                                                    <div class = "modal-dialog">
                                                        <div class = "modal-content">
                                                        <form role="form" method="post" action="<?=base_url()?>main/hapuspajak">
                                                            <input type="hidden" name="idprofil" id="idprofil" value="<?php echo $d[$i]->idprofil; ?>" />
                                                            <input type="hidden" name="idpajak" id="idpajak" value="<?php echo $d[$i]->idpajak; ?>" />
                                                                <div class = "modal-header">
                                                                <p class = "modal-title" id = "modallabel"><i class="fa fa-trash"></i> HAPUS DATA</p>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class = "modal-body">
                                                                    <p>YAKIN DATA AKAN <span class="text-danger">DIHAPUS</span> ?</p>
                                                                </div>
                                                                <div class = "modal-footer">
                                                                    <button type = "submit" class = "btn btn-success"><i class="fa fa-check"></i> Ya</button>
                                                                    <button type = "button" class = "btn btn-danger" data-dismiss = "modal" data-bs-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                                                                </div>
                                                            </form>   
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->   
                                                </div><!-- modal hapus end -->
                                                <?php
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <label class="form-text"><u>Keterangan</u>: <i class="fa-solid fa-check"></i> = Tepat Waktu, <i class="fa-solid fa-circle-xmark"></i> = Tidak Tepat Waktu, <i class="fa-solid fa-arrow-up-right-from-square"></i> = Disampaikan</label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('akun/tpl_progress'); ?>
            </div>
        </div>
    </div>
</section>
<script>
    // validasi form
    $("#frmpajak").validate({
        rules: {
            tahun: "required",  
            statuspphbadan: "required",
            statusppn: "required",
            statuspph21: "required",
            nilaipphbadan: "required",
            nilaippn: "required",
            nilaipph21: "required"
        },
        messages: {
            tahun: "Harap dipilih",
            statuspphbadan: "Harap dipilih",
            statusppn: "Harap dipilih",
            statuspph21: "Harap dipilih",
            nilaipphbadan: "Harap diisi",
            nilaippn: "Harap diisi",
            nilaipph21: "Harap diisi"
        }
    });
</script>
