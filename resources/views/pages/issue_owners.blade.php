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
                            <h5 class="display-4 card-header text-center text-uppercase">Issue Owners</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Issue Owner</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($issue_owners as $issue_owner)
                                            <tr class="table-default">
                                                <td>{{ $issue_owner->owner_name }}</td>
                                                <td>
                                                    @if (Auth::user()->role === 'Admin')
                                                        <a href="{{ Route('edit_issue_owner', $issue_owner->owner_id) }}" class="badge btn rounded-pill btn-outline-dark waves-effect">
                                                            <i class="mdi mdi-pencil-outline me-1"></i> Edit
                                                        </a>
                                                        <a href="{{ Route('delete_issue_owner', $issue_owner->owner_id) }}" class="badge btn rounded-pill btn-danger waves-effect waves-light" onclick="return confirm('Are You Sure!')">
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
                        @if ($issue_owners->lastPage() > 1)
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                {{-- Previous Page Link --}}
                                <li class="page-item {{ ($issue_owners->currentPage() == 1) ? ' disabled' : '' }}">
                                    <a class="page-link waves-effect" href="{{ $issue_owners->previousPageUrl() }}"><i class="tf-icon mdi mdi-chevron-double-left"></i></a>
                                </li>

                                {{-- Pagination Elements --}}
                                @php
                                    $start = max($issue_owners->currentPage() - 2, 1);
                                    $end = min(max($issue_owners->currentPage() + 2, 5), $issue_owners->lastPage());
                                @endphp
                                @for ($i = $start; $i <= $end; $i++)
                                    <li class="page-item {{ ($issue_owners->currentPage() == $i) ? ' active' : '' }}">
                                        <a class="page-link" href="{{ $issue_owners->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Next Page Link --}}
                                <li class="page-item {{ ($issue_owners->currentPage() == $issue_owners->lastPage()) ? ' disabled' : '' }}">
                                    <a class="page-link waves-effect" href="{{ $issue_owners->nextPageUrl() }}"><i class="tf-icon mdi mdi-chevron-double-right"></i></a>
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
