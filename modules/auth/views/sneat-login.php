<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/theme/assets/"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

      <title><?= __('auth.label.login') ?> - <?= getSetting('application_name') ?></title>

    <meta name="description" content="<?= getSetting('application_name') ?>" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= getFavicon() ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />
      

    <link rel="stylesheet" href="<?= asset('theme/assets/vendor/fonts/boxicons.css')?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= asset('theme/assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= asset('theme/assets/vendor/css/theme-default.css')?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= asset('theme/assets/css/demo.css')?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= asset('theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')?>" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= asset('theme/assets/vendor/css/pages/page-auth.css')?>" />

    <!-- Helpers -->
    <script href="<?= asset('theme/assets/vendor/js/helpers.js')?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script href="<?= asset('theme/assets/js/config.js')?>"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card p-3">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="<?= routeTo('/') ?>" class="app-brand-link gap-2">
                  <img src="<?= getLogo() ?>" width="100%">
                </a>
              </div>
              <!-- /Logo -->
              <p class="mb-6 text-center">Silahkan login untuk melanjutkan</p>

              <?php if($success_msg): ?>
              <div class="alert alert-success"><?=$success_msg?></div>
              <?php endif ?>

              <?php if($error_msg): ?>
              <div class="alert alert-danger"><?=$error_msg?></div>
              <?php endif ?>

              <form id="formAuthentication" class="mb-6" method="POST">
              <?= csrf_field() ?>
                <div class="mb-3">
                  <label for="email" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="username"
                    placeholder="Enter your username"
                    value="<?= $old && isset($old['username']) ? $old['username'] : ''?>"
                    autofocus />
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                    <span class="input-group-text cursor-pointer password-toggler"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
              </form>

            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script href="<?= asset('theme/assets/vendor/libs/jquery/jquery.js')?>"></script>
    <script href="<?= asset('theme/assets/vendor/libs/popper/popper.js')?>"></script>
    <script href="<?= asset('theme/assets/vendor/js/bootstrap.js')?>"></script>
    <script href="<?= asset('theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')?>"></script>
    <script href="<?= asset('theme/assets/vendor/js/menu.js')?>"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script href="<?= asset('theme/assets/js/main.js')?>"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script defer>
    document.querySelector('.password-toggler').onclick = function(){
        const isPassword = document.querySelector('#password').type == 'password'
        if(isPassword)
        {
            document.querySelector('.bx-hide').classList.add('bx-show')
            document.querySelector('.bx-hide').classList.remove('bx-hide')
        }
        else
        {
            document.querySelector('.bx-show').classList.add('bx-hide')
            document.querySelector('.bx-show').classList.remove('bx-show')
        }
        document.querySelector('#password').type = isPassword ? 'text' : 'password'
    }
    </script>
  </body>
</html>