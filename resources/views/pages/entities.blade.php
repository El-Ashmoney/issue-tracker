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
                            <h5 class="card-header text-center text-uppercase">entities</h5>
                            @foreach ($entities as $entity)
                                <div class="accordion mt-3" id="accordionExample">
                                    <div class="accordion-item active">
                                        <h2 class="accordion-header" id="heading{{ $entity->id }}">
                                            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion{{ $entity->id }}" aria-expanded="true" aria-controls="accordionOne">
                                                <h3>{{ $entity->name }}</h3>
                                            </button>
                                        </h2>
                                        <div id="accordion{{ $entity->id }}" class="accordion-collapse collapse show" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <ul>
                                                    @forelse ($entity->sectors as $sector)
                                                        <li>{{ $sector->name }}</li>
                                                    @empty
                                                        <li>No sectors found.</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- @foreach ($entities as $entity)
                                <div>
                                    <h3>{{ $entity->name }}</h3>
                                    <ul>
                                        @forelse ($entity->sectors as $sector)
                                            <li>{{ $sector->name }}</li>
                                        @empty
                                            <li>No sectors found.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            @endforeach --}}
                        </div>
                        @if ($entities->lastPage() > 1)
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    {{-- Previous Page Link --}}
                                    <li class="page-item {{ ($entities->currentPage() == 1) ? ' disabled' : 'prev' }}">
                                        <a class="page-link waves-effect" href="{{ $entities->previousPageUrl() }}"><i class="tf-icon mdi mdi-chevron-double-left"></i></a>
                                    </li>

                                    {{-- Pagination Elements --}}
                                    @foreach ($entities->getUrlRange(1, $entities->lastPage()) as $page => $url)
                                        {{-- "Three Dots" Separator --}}
                                        @if ($page == $entities->currentPage()-1 || $page == $entities->currentPage()+1)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif

                                        {{-- Page Number Links --}}
                                        @if ($page == $entities->currentPage())
                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                        @elseif ($page == $entities->currentPage()-1 || $page == $entities->currentPage()+1)
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ ($entities->currentPage() == $entities->lastPage()) ? ' disabled' : 'next' }}">
                                        <a class="page-link waves-effect" href="{{ $entities->nextPageUrl() }}"><i class="tf-icon mdi mdi-chevron-double-right"></i></a>
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
