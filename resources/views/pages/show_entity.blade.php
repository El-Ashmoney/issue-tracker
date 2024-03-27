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
                            <h5 class="display-4 card-header text-center text-uppercase">Entity: {{ $entity->name }}</h5>
                            <div class="flex justify-between items-center rounded-full" style="margin: 10px 20px">
                                <a href="{{ Route('sector.create', ['entity_id' => $entity->id]) }}" class="btn rounded-pill btn-primary waves-effect waves-light"><span class="mdi mdi-plus-thick me-1"></span>Add Sector</a>
                                <a href="{{ Route('entity.create')}}" class="btn rounded-pill btn-primary waves-effect waves-light"><i class="mdi mdi-shape-plus me-1"></i>Add Entity</a>
                                @if(Auth::user()->role === 'Admin')
                                    <a href="{{ Route('entity.delete', $entity->id)}}" class="btn rounded-pill btn-danger waves-effect waves-light" onclick="return confirm('Are You Sure!')"><i class="mdi mdi-trash-can-outline me-1"></i>Delete Entity</a>
                                @else
                                    <span class="p-3.5 badge rounded-pill bg-danger cursor-not-allowed">Not Authorized to Delete</span>
                                @endif
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sectors</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse ($sectors as $sector)
                                            <tr class="table-default">
                                                <td>{{ $sector->name }}</td>
                                                <td>
                                                    @if (Auth::user()->role === 'Admin')
                                                        <a href="{{ Route('edit_sector', $sector->id) }}" class="badge btn rounded-pill btn-outline-dark waves-effect">
                                                            <i class="mdi mdi-pencil-outline me-1"></i> Edit
                                                        </a>
                                                        <a href="{{ Route('delete_sector', $sector->id) }}" class="badge btn rounded-pill btn-danger waves-effect waves-light" onclick="return confirm('Are You Sure!')">
                                                            <i class="mdi mdi-trash-can-outline me-1"></i> Delete
                                                        </a>
                                                    @else
                                                        <span class="badge rounded-pill bg-danger">Not Authorized</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">No sectors found for this entity.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($sectors->lastPage() > 1)
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    {{-- Previous Page Link --}}
                                    <li class="page-item {{ ($sectors->currentPage() == 1) ? ' disabled' : '' }}">
                                        <a class="page-link waves-effect" href="{{ $sectors->previousPageUrl() }}"><i class="tf-icon mdi mdi-chevron-double-left"></i></a>
                                    </li>

                                    {{-- Pagination Elements --}}
                                    @php
                                        $start = max($sectors->currentPage() - 2, 1);
                                        $end = min(max($sectors->currentPage() + 2, 5), $sectors->lastPage());
                                    @endphp
                                    @for ($i = $start; $i <= $end; $i++)
                                        <li class="page-item {{ ($sectors->currentPage() == $i) ? ' active' : '' }}">
                                            <a class="page-link" href="{{ $sectors->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ ($sectors->currentPage() == $sectors->lastPage()) ? ' disabled' : '' }}">
                                        <a class="page-link waves-effect" href="{{ $sectors->nextPageUrl() }}"><i class="tf-icon mdi mdi-chevron-double-right"></i></a>
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
