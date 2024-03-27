<!DOCTYPE html>
@php
    use Illuminate\Support\Str;
@endphp
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
                        @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissible text-center" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible text-center" role="alert">
                                {{ session()->get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-margin card">
                            <h5 class="scroll-pt-0 display-4 card-header text-center text-uppercase">Azure Issues</h5>
                            <div class="flex justify-between text-center" style="margin: 10px 20px">
                                <div class="flex-grow-0">
                                    <a href="{{ route('export.issues') }}" class="btn rounded-pill btn-primary waves-effect waves-light"><span class="mdi mdi-tray-arrow-down me-1"></span>Download Issues Report</a>
                                </div>
                                <form action="{{ route('azure.issue.add') }}" method="post" class="flex justify-end">
                                    @csrf
                                    <div class="mr-4">
                                        <select class="form-select form-control border-2 border-sky-500 shadow-none bg-white rounded-pill" name="company_id" required  id="exampleFormControlSelect1" aria-label="Default select example">
                                            <option value="">Select Company</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project['id'] }}">{{ $project['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mr-4">
                                        <input id="defaultInput" class="w-32 form-control border-2 border-sky-500 shadow-none bg-white rounded-pill" type="text" name="issue_number" required placeholder="Issue Number">
                                    </div>
                                    <div class="{{ request()->is('add_issue_page') ? 'active' : ''  }}">
                                        <button type="submit" class="update-btn btn rounded-pill btn-primary waves-effect waves-light"><span class="mdi mdi-plus-thick me-1"></span>Add Issue</button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Created By</th>
                                            <th>Type</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Company</th>
                                            <th>Resolved By</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th>Discipline</th>
                                            <th>Teams</th>
                                            <th>Source</th>
                                            <th>Duration</th>
                                            <th>Description of Close</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($azure_issues as $issue)
                                            <tr class="table-default">
                                                <td>{{ $issue->work_item_id }}</td>
                                                <td>{{ $issue->created_by }}</td>
                                                <td>{{ $issue->issue_type }}</td>
                                                <td>{{ Str::limit($issue->title, 30, '...') }}</td>
                                                <td>{{ Str::limit($issue->description, 30, '...') }}</td>
                                                <td>{{ $issue->project }}</td>
                                                <td>{{ $issue->resolved_by }}</td>
                                                <td>{{ $issue->status }}</td>
                                                <td>{{ $issue->priority }}</td>
                                                <td>{{ $issue->discipline }}</td>
                                                <td>{{ $issue->teams }}</td>
                                                <td>{{ $issue->source }}</td>
                                                <td>{{ $issue->worked_time }}</td>
                                                <td>{{ $issue->description_of_close }}</td>
                                                <td>{{ \Carbon\Carbon::parse($issue->created_date)->format('Y-m-d') }}</td>
                                                <td>
                                                    @if (Auth::user()->role === 'Admin')
                                                        <a href="{{ Route('edit_issue', $issue->work_item_id) }}" class="badge btn rounded-pill btn-outline-dark waves-effect">
                                                            <i class="mdi mdi-pencil-outline me-1"></i> Edit
                                                        </a>
                                                        <a href="{{ Route('azure.issue.delete', $issue->work_item_id) }}" class="badge btn rounded-pill btn-danger waves-effect waves-light" onclick="return confirm('Are You Sure!')">
                                                            <i class="mdi mdi-trash-can-outline me-1"></i> Delete
                                                        </a>
                                                    @else
                                                        <span class="badge rounded-pill bg-danger">Not Authorized</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
