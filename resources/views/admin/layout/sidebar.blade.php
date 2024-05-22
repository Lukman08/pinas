<div class="sidebar" id="sidebar">
    <div class="sidebar-left slimscroll">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-dashboard-tab" data-bs-toggle="pill" href="{{ route('dashboard') }}"
                role="tab" aria-controls="v-pills-dashboard" aria-selected="true">
                <span class="material-icons-outlined">
                    home
                </span>
            </a>
        </div>
    </div>

    <div class="sidebar-right">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel"
                aria-labelledby="v-pills-dashboard-tab">
                <p>Dashboard</p>
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('nas') }}" class="{{ request()->routeIs('nas') ? 'active' : '' }}">Data
                            File</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
