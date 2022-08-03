<section class="container my-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card rounded-0">
                <div class="card-header">RESET PASSWORD</div>
                <div class="card-body">
                    <form name="frmreset" id="frmreset" method="post" action="<?php echo base_url('main/kirimlupapassword'); ?>" >
                        <div class="form-group col-lg-12 py-2">
                            <label>Masukkan e-mail yang terdaftar. Kami akan mengirimkan cara untuk reset password.</label>
                        </div>
                        <div class="form-group col-lg-6 py-2">
                            <input type="text" class="form-control rounded-0" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group col-lg-6 py-2">
                            <button type="submit" class="btn btn-success form-control rounded-0" name="submit" id="submit">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
// validasi form
    $("#frmreset").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "Harap diisi",
                email: "Email harap diisi dengan benar"
            }
        }
    });
</script>