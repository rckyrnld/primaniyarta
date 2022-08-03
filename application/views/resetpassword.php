<section class="container my-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card rounded-0">
                <div class="card-header">RESET PASSWORD</div>
                <div class="card-body">
                    <form id="frmreset" name="frmreset" method="post" action="<?php echo base_url('main/gantipassword'); ?>">
                        <input type="hidden" id="status" name="status" value="reset">
                        <input type="hidden" id="email" name="email" value="<?php echo $user->email; ?>">
                        <div class="row mb-2">
                            <label class="col-md-3 mb-2">Nama User</label>
                            <div class="col-md-4">
                                <label><?php echo $user->nama; ?></label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-3 mb-2">Email</label>
                            <div class="col-md-4">
                                <label><?php echo $user->email; ?></label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="password" class="col-md-3 mb-2">Password Baru</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control rounded-0" id="password" name="password" maxlength="32" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="password" class="col-md-3 mb-2">Ketik Ulang Password Baru</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control rounded-0" id="repassword" name="repassword" maxlength="32" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 offset-md-3">
                                <button type="submit" class="form-control btn btn-success rounded-0" name="submit" id="submit">Reset Password</button>
                            </div>
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
            password: {
                required: true,
                minlength: 8
            },
            repassword: {
                required: true,
                minlength: 8,
                equalTo: '[name="password"]'
            }
        },
        messages: {
            password: {
                required: "Harap diisi",
                minlength: "Password minimal 8 karakter"
            },
            repassword: {
                required: "Harap diisi",
                minlength: "Password minimal 8 karakter",
                equalTo: "Isian password tidak sama"
            }
        }
    });
</script>