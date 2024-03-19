<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-template="vertical-menu-template-free">
    <head>
        @include('pages.head')
    </head>

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                @include('pages.sidebar')
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">
                <!-- Navbar -->
                @include('pages.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Contextual Classes -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="col-xl">
                            <div class="card-margin card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="display-4 mb-0">Edit User: {{ $user->username }}</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ Route('update_user', $user->id) }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-merge mb-4">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                                            <input
                                                type="text"
                                                name="username"
                                                class="form-control"
                                                id="basic-icon-default-fullname"
                                                value="{{ $user->username }}"
                                                aria-label="Full Name"
                                                aria-describedby="basic-icon-default-fullname2" />
                                        </div>
                                        <div class="input-group input-group-merge mb-4">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"><span class="mdi mdi-account-convert"></span></span>
                                            <input
                                                type="text"
                                                name="role"
                                                class="form-control"
                                                id="basic-icon-default-fullname"
                                                value="{{ $user->role }}"
                                                aria-label="Role"
                                                aria-describedby="basic-icon-default-fullname2" />
                                        </div>
                                        <button type="submit" class="update-btn btn rounded-pill btn-primary waves-effect waves-light"><span class="mdi mdi-update"></span>&nbsp;Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Contextual Classes -->
                </div>
                <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <!-- Core JS -->
        @include('pages.scripts')
        <!-- Core JS -->
    </body>
</html>



