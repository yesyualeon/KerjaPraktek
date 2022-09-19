<div class="login-data">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <?php
    $errors = $this->session->flashdata('errors');
    if (!empty($errors)) {
    ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger text-center">
                    <?php foreach ($errors as $key => $error) { ?>
                        <?php echo "$error<br>"; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <form action="<?= site_url('auth/check_login') ;?>" method="POST">
        <div class="form-group mb-3">
            <label for="inputEmail" class="form-controll visually-hidden">Username</label>
            <input type="username" name="username" id="inputusername" class="form-control shadow-none" placeholder="username" required autofocus>
        </div>
        <div class="form-group mb-3">
            <label for="inputPassword" class="visually-hidden">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control shadow-none" placeholder="Password" required>
        </div>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
    <p class="title mt-1">don't have account already ? <a href="<?= site_url(); ?>auth/register" class="text-decoration-none">Register</a></p>
</div>