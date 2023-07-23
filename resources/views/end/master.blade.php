<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-no-customizer">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>End Master Layout</title>

    <meta name="description" content="" />

    @include('end.styles')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="#" class="app-brand-link">
              <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary)">
                    <img src="{{ asset('images/logo.png') }}" width="40px" />
                </span>
              </span>
            </a>
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z"
                    fill="currentColor"
                    fill-opacity="0.6" />
                  <path
                    d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z"
                    fill="currentColor"
                    fill-opacity="0.38" />
                </svg>
              </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            {{-- MENUS --}}
            <li class="menu-item {{ Route::current()->getName() == 'end.dashboard' ? 'active' : ''  }}">
                <a href="{{ route('end.dashboard') }}" class="menu-link ">
                    <i class="menu-icon tf-icons mdi mdi-view-grid-outline"></i>
                    <div data-i18n="Dashboard">Dashboard</div>
                </a>
            </li>

            <li class="menu-item {{ Route::current()->getName() == 'end.calendar' ? 'active' : ''  }}">
                <a href="{{ route('end.calendar') }}" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-calendar"></i>
                    <div data-i18n="Calendar">Calendar</div>
                </a>
            </li>

            <li class="menu-item {{ Route::current()->getName() == 'endappointments.index' ? 'active' : ''  }}">
                <a href="{{ route('endappointments.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-file-document-outline"></i>
                    <div data-i18n="Appointments">Appointments</div>
                </a>
            </li>

            @if (!auth()->user()->contact->is_patient)
            <li class="menu-item {{ Route::current()->getName() == 'queue' ? 'active' : ''  }}">
                <a href="{{ route('queue') }}" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-file-document-outline"></i>
                    <div data-i18n="Appointments">Today's Appointment</div>
                </a>
            </li>
            @endif
            <!-- Dashboards -->
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="mdi mdi-menu mdi-24px"></i>
              </a>
            </div>
            {{-- <div class="navbar-nav align-items-center" >
                <img src="images/logo.png" width="40px"  style="margin-right:auto !important;"/>
            </div> --}}
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('default-doctor.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="https://www.hunterdonhealth.org/themes/custom/ohana/dist/img/default-doctor.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ auth()->user()->contact->full_name }}</span>
                            <small class="text-muted">
                                @if (auth()->user()->contact->is_patient)
                                    Patient
                                @elseif (auth()->user()->contact->is_dentist)
                                    Dentist
                                @else
                                    Staff
                                @endif
                            </small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('end.profile') }}">
                        <i class="mdi mdi-account-outline me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                   
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" onclick="logout()">
                        <i class="mdi mdi-logout me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>

          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                @yield('content')
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <form method="POST" action="{{ route('end.logout') }}" id="logoutForm">
        @csrf
        {{-- <input type="hidden" name="logout" value="1"> --}}
    </form>
    <script>
        function logout() {
            document.getElementById('logoutForm').submit();
        }
    </script>
    <!-- / Layout wrapper -->
    @include('end.scripts')
  </body>
</html>
