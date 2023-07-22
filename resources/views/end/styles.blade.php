 <!-- Favicon -->
 <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />

 <!-- Fonts -->
 <link rel="preconnect" href="https://fonts.googleapis.com" />
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
 <link
   href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
   rel="stylesheet" />

 <!-- Icons -->
 <link rel="stylesheet" href="{{ asset('end/assets/vendor/fonts/materialdesignicons.css') }}" />
 <link rel="stylesheet" href="{{ asset('end/assets/vendor/fonts/fontawesome.css') }}" />
 <!-- Menu waves for no-customizer fix -->
 <link rel="stylesheet" href="{{ asset('end/assets/vendor/libs/node-waves/node-waves.css') }}" />
 {{-- <link rel="stylesheet" href="{{ asset('end/assets/vendor/libs/fullcalendar/fullcalendar.css') }}" />
 <link rel="stylesheet" href="{{ asset('end/assets/vendor/libs/select2/select2.css') }}" />
 <link rel="stylesheet" href="{{ asset('end/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
 <link rel="stylesheet" href="{{ asset('end/assets/vendor/css/pages/app-calendar.css') }}" /> --}}
 <!-- Core CSS -->
 <link rel="stylesheet" href="{{ asset('end/assets/vendor/css/rtl/core.css') }}" />
 <link rel="stylesheet" href="{{ asset('end/assets/vendor/css/rtl/theme-default.css') }}" />
 <link rel="stylesheet" href="{{ asset('end/assets/css/demo.css') }}" />

 <!-- Vendors CSS -->
 <link rel="stylesheet" href="{{ asset('end/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
 <link rel="stylesheet" href="{{ asset('end/assets/vendor/libs/typeahead-js/typeahead.css') }}" />

 <!-- Page CSS -->
 <link rel="stylesheet" href="{{ asset('end/assets/vendor/css/pages/page-faq.css') }}" />
 <!-- Helpers -->
 <script src="{{ asset('end/assets/vendor/js/helpers.js') }}"></script>

 <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
 <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
 <script src="{{ asset('end/assets/js/config.js') }}"></script>

 @stack('styles')