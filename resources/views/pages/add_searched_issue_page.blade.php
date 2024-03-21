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
                        <div class="card-margin card">
                            <h5 class="pb-0	display-4 card-header text-center text-uppercase">Add Issue: {{ $query }}</h5>
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <form action="{{ Route('add_issue') }}" method="POST">
                                            @csrf
                                            <div class="form-floating form-floating-outline mb-4">
                                                <textarea id="basic-default-issue" class="form-control" placeholder="Descripe the issue" style="height: 60px" name="issue_description"></textarea>
                                                <label for="basic-default-issue">Issue</label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" name="sector_id" id="exampleFormControlSelect1" aria-label="Default select example">
                                                    <option selected="">Which Sector</option>
                                                    @foreach ($sectors as $sector)
                                                        <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlSelect1">Select Sector <span class="mdi mdi-arrow-down-right"></span></label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" id="exampleFormControlSelect1" name="owner_id" aria-label="Default select example">
                                                    <option selected="">Which Owner</option>
                                                    @foreach ($owners as $owner)
                                                        <option value="{{ $owner->owner_id }}">{{ $owner->owner_name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlSelect1">Select Owner <span class="mdi mdi-arrow-down-right"></span></label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" id="exampleFormControlSelect1" name="assignee_id" aria-label="Default select example">
                                                    <option selected="">Which Assignee</option>
                                                    @foreach ($assignees as $assignee)
                                                        <option value="{{ $assignee->assignee_id }}">{{ $assignee->assignee_name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlSelect1">Select Assignee <span class="mdi mdi-arrow-down-right"></span></label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" id="exampleFormControlSelect1" name="company_id" aria-label="Default select example">
                                                    <option selected="">Which Company</option>
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->company_id }}">{{ $company->company_name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlSelect1">Select Company <span class="mdi mdi-arrow-down-right"></span></label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" id="exampleFormControlSelect1" name="scale" aria-label="Default select example">
                                                    <option selected="">Scale</option>
                                                    @foreach ($scaleOption as $option)
                                                        <option value="{{ $option }}">{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlSelect1">Select Scale <span class="mdi mdi-arrow-down-right"></span></label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" id="exampleFormControlSelect1" name="status" aria-label="Default select example">
                                                    <option selected="">Status</option>
                                                    @foreach ($statusOption as $option)
                                                        <option value="{{ $option }}">{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlSelect1">Status <span class="mdi mdi-arrow-down-right"></span></label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" id="exampleFormControlSelect1" name="azure_status" aria-label="Default select example">
                                                    <option selected="">Azure Status</option>
                                                    @foreach ($azureOption as $option)
                                                        <option value="{{ $option }}">{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlSelect1">Azure Status <span class="mdi mdi-arrow-down-right"></span></label>
                                            </div>
                                            <div class="flex justify-center">
                                                <button type="submit" class="update-btn rounded-pill btn btn-primary waves-effect waves-light">Add Issue</button>
                                            </div>
                                        </form> --}}
                                    </div>
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
