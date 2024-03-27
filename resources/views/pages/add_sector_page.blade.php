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
                                    <h5 class="display-4 uppercase text-center mb-0">Add Sector</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ Route('sector.store') }}" method="POST">
                                        @csrf
                                        <div class="form-floating form-floating-outline mb-4">
                                            <select class="form-select" name="entity_id" id="exampleFormControlSelect1" aria-label="Default select example">
                                                <option value="">Which Entity</option>
                                                @foreach ($entities as $optionEntity)
                                                    <option value="{{ $optionEntity->id }}" {{ ($entity && $entity->id === $optionEntity->id) ? 'selected' : '' }}>{{ $optionEntity->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="exampleFormControlSelect1">Select Entity <span class="mdi mdi-arrow-down-right"></span></label>
                                            @error('entity_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="input-group input-group-merge mb-4">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control"
                                                id="basic-icon-default-fullname"
                                                placeholder="Sector Name"
                                                aria-label="Full Name"
                                                aria-describedby="basic-icon-default-fullname2"
                                            />
                                        </div>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <button type="submit" class="update-btn btn btn-primary"><span class="mdi mdi-plus-thick"></span>&nbsp;Add</button>
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



