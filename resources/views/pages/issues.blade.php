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
                        @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissible text-center" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-margin card">
                            <h5 class="card-header text-center text-uppercase">Issues</h5>
                            <div class="flex justify-between items-center rounded-full" style="margin: 10px 20px">
                                <a href="" class="btn rounded-pill btn-primary waves-effect waves-light">All Issues</a>
                                <a href="" class="btn rounded-pill btn-primary waves-effect waves-light">Add Issue</a>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Issue</th>
                                            <th>Owner</th>
                                            <th>Assignee</th>
                                            <th>Scale</th>
                                            <th>Company</th>
                                            <th>Duration</th>
                                            <th>Issue Date</th>
                                            <th>Issue Status</th>
                                            <th>Azure Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($issues as $issue)
                                            <tr class="table-default">
                                                <td>{{ $issue->issue_id }}</td>
                                                <td>{{ $issue->issue_description }}</td>
                                                <td>{{ $issue->owner ? $issue->owner->owner_name : 'N/A' }}</td>
                                                <td>{{ $issue->assignee ? $issue->assignee->assignee_name : 'N/A' }}</td>
                                                <td>{{ $issue->scale }}</td>
                                                <td>{{ $issue->company ? $issue->company->company_name : 'N/A' }}</td>
                                                <td>{{ $issue->time_duration }}</td>
                                                <td>{{ $issue->issue_date }}</td>
                                                <td>{{ $issue->status }}</td>
                                                <td>{{ $issue->azure_status }}</td>
                                                <td>
                                                    @if (Auth::user()->role === 'Admin')
                                                        <a href="{{ Route('edit_issue', $issue->issue_id) }}" class="badge btn rounded-pill btn-outline-dark waves-effect">
                                                            <i class="mdi mdi-pencil-outline me-1"></i> Edit
                                                        </a>
                                                        <a href="{{ Route('delete_issue', $issue->issue_id) }}" class="badge btn rounded-pill btn-danger waves-effect waves-light" onclick="return confirm('Are You Sure!')">
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
                        @if ($issues->lastPage() > 1)
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    {{-- Previous Page Link --}}
                                    <li class="page-item {{ ($issues->currentPage() == 1) ? ' disabled' : 'prev' }}">
                                        <a class="page-link waves-effect" href="{{ $issues->previousPageUrl() }}"><i class="tf-icon mdi mdi-chevron-double-left"></i></a>
                                    </li>

                                    {{-- Pagination Elements --}}
                                    @foreach ($issues->getUrlRange(1, $issues->lastPage()) as $page => $url)
                                        {{-- "Three Dots" Separator --}}
                                        @if ($page == $issues->currentPage()-1 || $page == $issues->currentPage()+1)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif

                                        {{-- Page Number Links --}}
                                        @if ($page == $issues->currentPage())
                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                        @elseif ($page == $issues->currentPage()-1 || $page == $issues->currentPage()+1)
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ ($issues->currentPage() == $issues->lastPage()) ? ' disabled' : 'next' }}">
                                        <a class="page-link waves-effect" href="{{ $issues->nextPageUrl() }}"><i class="tf-icon mdi mdi-chevron-double-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        @endif
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