<!doctype html>
<html lang="en">
    <head>
        <title><?= __('auth.label.login') ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= asset('assets/auth/css/styles.css') ?>">
        <style>
            @media screen and (max-height: 472px) {
                .login-wrap {
                    display: block !important;
                    overflow: auto;
                }
            }
        </style>
    </head>
    <body>
        <div class="wrap d-md-flex" style="height:100vh">
            <div class="img d-none d-md-block" style="background-image: url(<?=asset('assets/auth/images/footage.jpg')?>);"></div>
            <div class="login-wrap d-block d-md-flex">
                <div class="p-4 p-md-5 d-flex justify-content-center flex-column w-100">
                    <div class="d-flex">
                        <div class="w-100">
                            <h3 class="mb-4"><?= __('auth.label.login') ?></h3>
                        </div>
                        <div class="w-100">
                            <p class="social-media d-flex justify-content-end">
                                <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                            </p>
                        </div>
                    </div>
                    <?php if($success_msg): ?>
                    <div class="alert alert-success"><?=$success_msg?></div>
                    <?php endif ?>
    
                    <?php if($error_msg): ?>
                    <div class="alert alert-danger"><?=$error_msg?></div>
                    <?php endif ?>
                    <form method="post" class="signin-form">
                        <?= csrf_field() ?>
                        <div class="form-group mb-3">
                            <label class="label" for="name"><?= __('auth.label.username') ?></label>
                            <input type="text" name="username" class="form-control" placeholder="<?= __('auth.label.username') ?>" value="<?= $old && isset($old['username']) ? $old['username'] : ''?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="password"><?= __('auth.label.password') ?></label>
                            <input type="password" name="password" class="form-control" placeholder="<?= __('auth.label.password') ?>" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Submit</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50 text-left">
                                <label class="checkbox-wrap checkbox-primary mb-0"><?= __('auth.label.remember_me') ?>
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="#"><?= __('auth.label.forgot_password') ?></a>
                            </div>
                        </div>
                    </form>
                    <p class="text-center"><?= __('auth.label.not_a_member') ?>? <a data-toggle="tab" href="#signup"><?= __('auth.label.sign_up') ?></a></p>
                </div>
            </div>
        </div>    
        <script src="<?=asset('assets/auth/js/jquery.min.js')?>"></script>
        <script src="<?=asset('assets/auth/js/popper.js')?>"></script>
        <script src="<?=asset('assets/auth/js/bootstrap.min.js')?>"></script>
        <script src="<?=asset('assets/auth/js/main.js')?>"></script>
   </body>
</html>