<section class="container my-5">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <p class="fs-5" style="border-bottom: 1px solid #1F1F1F"><i class="fa-solid fa-award"></i> KATEGORI PENGHARGAAN PRIMANIYARTA</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Penjelasan</th>
                                <th scope="col">Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $d = $kat->result();
                            $n = $kat->num_rows();
                            if($n > 0) {
                                for ($i = 0; $i < count($d); ++$i) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i+1; ?></td>
                                        <td style="width: 300px;"><?php echo $d[$i]->nmkategori; ?></td>
                                        <td><?php echo $d[$i]->keterangan; ?></td>
                                        <td><?php echo $d[$i]->kriteria; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            else {
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
</section>