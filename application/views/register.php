<div class="signin-input">
<h1 class="h3 mb-3 fw-normal">Let's sign up</h1>
    <?php
    $errors = $this->session->flashdata('errors');
    if (!empty($errors)) {
    ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger text-center">
                        <?php echo "$errors<br>"; ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <form action="<?= site_url(); ?>auth/check_register" method="post">
        <div class="row text-start">
            <div class="form-group col-6 mb-3">
                <label for="inputEmail" class="form-controll ">Nama Depan</label>
                <input type="text" name="nama_depan" class="form-control shadow-none" placeholder="Nama Depan" required autofocus>
            </div>
            <div class="form-group col-6 mb-3">
                <label for="inputEmail" class="form-controll ">Nama Belakang</label>
                <input type="text" name="nama_belakang" class="form-control shadow-none" placeholder="Nama Belakang" required>
            </div>
            <div class="form-group col-6 mb-3">
                <label for="inputEmail" class="form-controll">E-mail</label>
                <input type="text" name="email_user" class="form-control shadow-none" placeholder="E-mail" required>
            </div>
            <div class="form-group col-6 mb-3">
                <label for="inputEmail" class="form-controll ">Username</label>
                <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Username" required>
            </div>
            <div class="form-group col-6 mb-3">
                <label for="inputEmail" class="form-controll ">Password</label>
                <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password" required>
            </div>
            <div class="form-group col-6 mb-3">
                <label for="inputEmail" class="form-controll ">Retype Password</label>
                <input type="password" name="repassword" class="form-control" autocomplete="off" placeholder="Password" required>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        </div>
    </form>
</div>
<p class="title mt-1">i have account already ? <a href="<?= site_url(); ?>auth/login" class="text-decoration-none">Login</a></p>