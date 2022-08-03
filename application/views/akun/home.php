<div class="container-fluid">
    <div class="row" style="background-color: #333; color: #fff;">
      <div class="container py-4">
          <p class="h4">AKUN</p>
          <p class="h1" style="letter-spacing: 2px;"><b><?php echo strtoupper($nmuser); ?></b></p>
      </div>
    </div>
    <div class="row">
      <div class="container py-3">
        <?php $this->load->view('akun/navlink'); ?>
        <div class="row">
          <!-- col utama start -->
          <div class="col-lg-12 pb-4">
            <div class="card">
              <div class="card-body px-3 py-3">
                <p class="h4 pb-2"><i class="fas fa-images fa-fw"></i> <b>Data Produk</b></p>
                <hr>
                <a class="btn btn-sm btn-primary mb-3" href="<?php echo base_url('akun/produk/tambah'); ?>"><i class="fas fa-images fa-fw"></i> Tambah Data Produk</a>
                <a class="btn btn-sm btn-info mb-3" onclick="tampildiv()" href="#"><i class="fas fa-search fa-fw"></i> Cari Data Produk</a>
                <a class="btn btn-sm btn-secondary mb-3" href="<?php echo base_url('main/reset/cariprod'); ?>"><i class="fas fa-sync fa-fw"></i> Reset Pencarian</a>
                <div class="col-lg-12" style="display:none" id="divcari">
                  <p>
                    <span><i class="fas fa-search fa-fw"></i> Cari Data Produk</span>
                    <span class="float-right"><a class="btn btn-sm btn-danger" onclick="sembunyidiv()" href=""><i class="fas fa-window-close fa-fw"></i> Tutup Form</a></span>
                  </p>
                  <hr>
                  <form method="post" action="<?php echo base_url('main/produkcari'); ?>">
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="kode">Kode / Nama Produk</label>
                        <input type="text" class="form-control" name="txcari" id="txcari" value="<?php echo $this->session->sesscariprod; ?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="kaprod">Kategori Produk</label>
                        <select class="form-control" name="idkat" id="idkat">
                          <option value=""></option>
                          <?php
                          $d = $katprod->result();
                          $n = $katprod->num_rows();
                          if($n > 0) {
                            for ($i = 0; $i < count($d); ++$i) {
                            ?>
                            <option value="<?php echo $d[$i]->id; ?>" <?php if($d[$i]->id==$this->session->sesskatid) { echo "selected"; } ?>><?php echo $d[$i]->nama; ?></option>
                            <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="cari">&nbsp;</label>
                        <button type="submit" class="form-control btn btn-primary" name="btcari" id="btcari"><i class="fas fa-search fa-fw"></i> Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th width="50" scope="col">#</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Kategori Produk</th>
                        <th width="180" scope="col" class="text-right"></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $d = $prod->result();
                    $n = $prod->num_rows();
                    if($n > 0) {
                      for ($i = 0; $i < count($d); ++$i) {
                        ?>
                        <tr>
                          <td scope="row"><?php echo ($page+$i+1); ?></td>
                          <td><?php echo $d[$i]->kode; ?></td>
                          <td><?php echo $d[$i]->nmproduk; ?></td>
                          <td><?php echo $d[$i]->nmkat; ?></td>
                          <td>
                            <a class="btn btn-sm btn-success" href="<?php echo base_url('akun/produk/edit/'.$d[$i]->idprod); ?>"><i class="fas fa-edit fa-fw"></i> Edit</a>
                            <a class="btn btn-sm btn-danger" href="" data-toggle="modal" data-target="#modalhapus<?php echo $i; ?>"><i class="fas fa-trash fa-fw"></i> Hapus</a>
                          </td>
                        </tr>
                        <!-- modal hapus start -->
                        <div class = "modal" id = "modalhapus<?php echo $i; ?>" tabindex = "-1" role = "dialog" aria-labelledby = "modallabel" aria-hidden = "true">
                            <div class = "modal-dialog">
                                <div class = "modal-content">
                                    <form role="form" method="post" action="<?php echo base_url('main/hapusproduk'); ?>">
                                    <input type="hidden" name="idprod" id="idprod" value="<?php echo $d[$i]->idprod; ?>" />
                                    <div class = "modal-body">
                                        <p>YAKIN DATA AKAN <span class="text-danger">DIHAPUS</span> ?</p>
                                    </div>
                                    <div class = "modal-footer">
                                        <button type = "submit" class = "btn btn-success"><i class="fa fa-check"></i> Ya</button>
                                        <button type = "button" class = "btn btn-danger" data-dismiss = "modal"><i class="fa fa-times"></i> Tidak</button>
                                    </div>
                                    </form>   
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->   
                          </div><!-- modal hapus end -->
                        <?php
                      }
                    }
                    else {
                      ?>
                      <tr>
                        <td colspan="5" class="text-center">Tidak ada data produk</td>
                      </tr>
                      <?php
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- col utama end -->
        </div>
      </div>
    </div>
  </div>

  <script>
    function tampildiv() {
        var x = document.getElementById("divcari");
        x.style.display = "block";
    } 

    function sembunyidiv() {
        var x = document.getElementById("divcari");
        x.style.display = "none";
    } 
  </script>
  