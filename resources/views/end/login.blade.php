<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-no-customizer">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login Cover - Pages | Materialize - Material Design HTML Admin Template</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="end/assets/vendor/fonts/materialdesignicons.css" />
    <link rel="stylesheet" href="end/assets/vendor/fonts/fontawesome.css" />
    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="end/assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="end/assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="end/assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="end/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="end/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="end/assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="end/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="end/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="end/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="end/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
      <div class="authentication-inner row m-0">
        <!-- /Left Section -->
        <!-- Login -->
        
        <div
          class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
        
          <div class="w-px-400 mx-auto pt-lg-0">
            @include('end.alert')
            <center>
                <img src="images/logo.png" width="70px" class="mb-3" />
            </center>
            
            <h4 class="mb-2 fw-semibold text-center">Welcome to Dentist Clinic App! 👋</h4>
            <p class="mb-4 text-center">Please sign-in to your account and book an appointment</p>

            <form class="mb-3" action="{{ route('end.authenticate') }}" method="POST">
              @csrf
              
              <div class="form-floating form-floating-outline mb-3">
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Enter your email"
                  required
                  autofocus />
                <label for="email">Email </label>
              </div>

        
              <div class="mb-3">
                <div class="form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                        required
                        />
                      <label for="password">Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary d-grid w-100">Sign in</button>
            </form>

            <p class="text-center mt-2">
              <span>New on our platform?</span>
              <a href="{{ route('end.register') }}">
                <span>Create an account</span>
              </a>
            </p>

          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="end/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="end/assets/vendor/libs/popper/popper.js"></script>
    <script src="end/assets/vendor/js/bootstrap.js"></script>
    <script src="end/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="end/assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="end/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="end/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="end/assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="end/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="end/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="end/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="end/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

    <!-- Main JS -->
    <script src="end/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="end/assets/js/pages-auth.js"></script>
  </body>
</html>
