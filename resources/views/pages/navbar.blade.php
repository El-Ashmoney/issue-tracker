<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="mdi mdi-menu mdi-24px"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <form action="{{ route('search') }}" method="GET" id="search-form">
            <div class="flex">
                <div class="me-2">
                    <select class="form-select form-control border-0 shadow-none bg-white rounded-pill" name="sector_id" required  id="exampleFormControlSelect1" aria-label="Default select example">
                        <option value="">Select Sector</option>
                        @foreach ($sectorsWithEntities as $entityName => $sectors)
                            <optgroup label="{{ $entityName }}">
                                @foreach ($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="navbar-nav align-items-center">
                    <div class="nav-item d-flex align-items-center me-2 bg-white rounded-pill">
                        <input
                        type="search"
                        id="search-input"
                        name="query"
                        class="w-64 form-control border-0 shadow-none rounded-pill"
                        placeholder="Search for exist or add new"
                        aria-label="search" />
                    </div>
                </div>
                <button type="submit" class="update-btn btn-xs rounded-pill btn btn-primary"><i class="mdi mdi-magnify mdi-20px lh-0 me-1"></i>Search</button>
            </div>
        </form>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->
            <li class="nav-item lh-1 me-3">
                <a
                    class="github-button"
                    href="https://github.com/El-Ashmoney/issue-tracker"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/materio-bootstrap-html-admin-template-free on GitHub"
                    >Star</a
                >
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a
                    class="nav-link dropdown-toggle hide-arrow p-0"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                    <li>
                        <a class="dropdown-item pb-2 mb-1" href="{{ route('profile.show') }}">
                            <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2 pe-1">
                                <div class="avatar avatar-online">
                                    <img src="{{ asset('img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ Auth::user()->username }}</h6>
                                <small class="text-muted capitalize">{{ Auth::user()->role }}</small>
                            </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i class="mdi mdi-account-outline me-1 mdi-20px"></i>
                            <span class="align-middle">{{ __('Profile') }}</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                                <i class="mdi mdi-power me-1 mdi-20px"></i> <span class="align-middle">{{ __('Logout') }}</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
