<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('index') }}" class="app-brand-link">
            <span class="app-brand-logo demo me-1">
                <span style="color: var(--bs-primary)">
                    <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                        fill="currentColor" />
                        <path
                        opacity="0.077704"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z"
                        fill="black" />
                        <path
                        opacity="0.077704"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z"
                        fill="black" />
                        <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                        fill="currentColor" />
                        <path
                        opacity="0.077704"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z"
                        fill="black" />
                        <path
                        opacity="0.077704"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z"
                        fill="black" />
                        <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                        fill="currentColor" />
                        <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                        fill="white"
                        fill-opacity="0.15" />
                        <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                        fill="currentColor" />
                        <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                        fill="white"
                        fill-opacity="0.3" />
                    </svg>
                </span>
            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2">Issue Tracker</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->is('/') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (Route::currentRouteName()) == 'index' ? 'active' : '' }}">
                    <a href="{{ Route('index') }}" class="menu-link">
                        <div data-i18n="Analytics">Analytics</div>
                    </a>
                </li>
            </ul>
            <li class="menu-header fw-medium mt-4">
                <span class="menu-header-text">Issues &amp; Related</span>
            </li>
        </li>
        <li class="menu-item {{ request()->is('issues*', 'all_issues*', 'edit_issue*', 'azure_issues*', 'add_issue_page*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
                <div data-i18n="Layouts">Issues</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('issues', 'edit_issue/*', 'add_issue_page') ? 'active' : '' }}">
                    <a href="{{ Route('issues') }}" class="menu-link">
                        <div data-i18n="Issues">My Issues</div>
                        <span class="badge bg-label-primary fs-tiny rounded-pill ms-auto">{{ $my_issues_count }}</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('all_issues') ? 'active' : '' }}">
                    <a href="{{ Route('all_issues') }}" class="menu-link">
                        <div data-i18n="all_issues">All Issues</div>
                        <span class="badge bg-label-primary fs-tiny rounded-pill ms-auto">{{ $issues_count }}</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('azure_issues') ? 'active' : '' }}">
                    <a href="{{ Route('azure_issues') }}" class="menu-link">
                        <div data-i18n="azure_issues">Azure Issues</div>
                        <span class="badge bg-label-primary fs-tiny rounded-pill ms-auto">{{ $azure_issues_count }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text">Misc</span>
        </li>
        <li class="menu-item {{ request()->is('companies*', 'edit_company*', 'issue_assignees*', 'edit_issue_assignee*', 'issue_owners*', 'edit_issue_owner*', 'users*', 'edit_user*', 'create_issue_assignee', 'create_issue_owner', 'create_company') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-cube-outline"></i>
                <div data-i18n="Misc">Misc</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('companies', 'create_company', 'edit_company/*') ? 'active' : '' }}">
                    <a href="{{ Route('companies') }}" class="menu-link">
                        <div data-i18n="Companies">Companies</div>
                        <span class="badge bg-label-primary fs-tiny rounded-pill ms-auto">{{ $companies_count }}</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('issue_assignees', 'edit_issue_assignee/*', 'create_issue_assignee*') ? 'active' : '' }}">
                    <a href="{{ Route('issue_assignees') }}" class="menu-link">
                        <div data-i18n="Issue-Assignees">Issue Assignees</div>
                        <span class="badge bg-label-primary fs-tiny rounded-pill ms-auto">{{ $issue_assignees_count }}</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('issue_owners', 'edit_issue_owner/*', 'create_issue_owner') ? 'active' : '' }}">
                    <a href="{{ Route('issue_owners') }}" class="menu-link">
                        <div data-i18n="Issue-Owners">Issue Owners</div>
                        <span class="badge bg-label-primary fs-tiny rounded-pill ms-auto">{{ $issue_owners_count }}</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('users', 'edit_user/*') ? 'active' : '' }}">
                    <a href="{{ Route('users') }}" class="menu-link">
                        <div data-i18n="Users">Users</div>
                        <span class="badge bg-label-primary fs-tiny rounded-pill ms-auto">{{ $users_count }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ request()->is('entities*', 'show_entity*', 'edit_sector*', 'sectors/create*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-view-grid-outline"></i>
                <div data-i18n="Misc">Entities</div>
            </a>
            <ul class="menu-sub">
                {{-- @php
                    $currentRouteName = Route::currentRouteName();
                    if ($currentRouteName == 'show_entity') {
                        $activeEntityId = request()->id;
                    } elseif ($currentRouteName == 'edit_sector' && isset($entityId)) {
                        $activeEntityId = $entityId;
                    } else {
                        $activeEntityId = null;
                    }
                @endphp --}}
                {{-- @foreach ($entitiesWithSectorCount as $entity)
                    <li class="menu-item {{ $activeEntityId == $entity->id ? 'active' : '' }}">
                        <a href="{{ route('show_entity', ['id' => $entity->id]) }}" class="menu-link">
                            <div>{{ $entity->name }}</div>
                            <span class="badge bg-label-primary fs-tiny rounded-pill ms-auto">{{ $entity->sectors_count }}</span>
                        </a>
                    </li>
                @endforeach --}}
                @php
                    $currentRouteName = Route::currentRouteName();
                    // Assuming 'entity_id' might be passed as a query parameter for the 'sectors/create' route
                    $activeEntityId = request()->route('id') ?? request()->query('entity_id') ?? null;

                    // Check if the current route is specifically related to adding or editing a sector
                    $isSectorRoute = request()->is('sectors/create*') || $currentRouteName == 'edit_sector';
                @endphp

                @foreach ($entitiesWithSectorCount as $entity)
                    @php
                        // Determine if this particular entity should be marked as active
                        $isActiveEntity = $activeEntityId == $entity->id;
                        // For sector-related routes, check if the active entity matches the entity being iterated on
                        $isActiveForSectorRoute = $isSectorRoute && $isActiveEntity;
                    @endphp

                    <li class="menu-item {{ $isActiveEntity || $isActiveForSectorRoute ? 'active' : '' }}">
                        <a href="{{ route('show_entity', ['id' => $entity->id]) }}" class="menu-link">
                            <div>{{ $entity->name }}</div>
                            <span class="badge bg-label-primary fs-tiny rounded-pill ms-auto">{{ $entity->sectors_count }}</span>
                        </a>
                    </li>
                @endforeach

            </ul>
        </li>
    </ul>
</aside>
