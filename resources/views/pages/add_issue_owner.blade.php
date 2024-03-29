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
                                <div class="card-header align-items-center">
                                    <h5 class="display-4 mb-0 uppercase text-center">Add issue owner</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ Route('add_issue_owner') }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-merge mb-4">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                                            <input
                                                type="text"
                                                name="owner_name"
                                                class="form-control"
                                                id="basic-icon-default-fullname"
                                                placeholder="Eng. example"
                                                aria-label="Issue Owner"
                                                aria-describedby="basic-icon-default-fullname2" />
                                        </div>
                                        @error('owner_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <button type="submit" class="update-btn btn btn-primary"><span class="mdi mdi-plus-thick me-1"></span>&nbsp;Add Owner</button>
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



