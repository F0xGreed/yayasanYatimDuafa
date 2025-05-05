@php
    $user = auth()->user();
    $currentRoute = Route::currentRouteName();
    $role = $user->role ?? 'guest';
    $menus = config('menus.' . $role) ?? [];
@endphp

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center">Yayasan</h4>

    @foreach ($menus as $menu)
        @php
            $hasChildren = isset($menu['children']);
            $isActive = false;

            if (isset($menu['route'])) {
                $isActive = str_contains($currentRoute, str_replace('.', '', $menu['route']));
            } elseif (isset($menu['url'])) {
                $isActive = request()->is(ltrim($menu['url'], '/') . '*');
            }

            if ($hasChildren) {
                foreach ($menu['children'] as $child) {
                    if (($child['active'] ?? true) && isset($child['route']) && str_contains($currentRoute, str_replace('.', '', $child['route']))) {
                        $isActive = true;
                        break;
                    }
                }
            }
        @endphp

        @if (!isset($menu['active']) || $menu['active'])
            @if ($hasChildren)
                <!-- Dropdown Menu -->
                <div class="dropdown">
                    <a class="dropdown-toggle {{ $isActive ? 'bg-warning text-dark' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $menu['icon'] }} {{ $menu['title'] }}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($menu['children'] as $child)
                            @if ($child['active'] ?? true)
                                <li>
                                    <a 
                                        href="{{ isset($child['route']) ? route($child['route']) : ($child['url'] ?? '#') }}" 
                                        class="dropdown-item {{ (isset($child['route']) && str_contains($currentRoute, str_replace('.', '', $child['route']))) ? 'bg-warning text-dark' : '' }}"
                                    >
                                        {{ $child['title'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @else
                <!-- Single Link -->
                <a 
                    href="{{ isset($menu['route']) ? route($menu['route']) : ($menu['url'] ?? '#') }}" 
                    class="{{ $isActive ? 'bg-warning text-dark' : '' }}"
                >
                    {{ $menu['icon'] }} {{ $menu['title'] }}
                </a>
            @endif
        @endif
    @endforeach
</div>

<!-- Sidebar CSS khusus (boleh pindah ke file CSS) -->
<style>
.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #FF7F00;
    color: white;
    position: fixed;
    padding-top: 20px;
    overflow-y: auto;
}

.sidebar a {
    display: block;
    color: white;
    padding: 12px;
    text-decoration: none;
    font-weight: bold;
}

.sidebar a:hover,
.dropdown-toggle:hover {
    background-color: #d97706;
}

.sidebar a.bg-warning,
.sidebar .dropdown-toggle.bg-warning {
    color: black;
    font-weight: bold;
}

.dropdown-menu {
    background-color: #FF7F00;
    border: none;
}
.dropdown-menu .dropdown-item {
    color: white;
    background-color: #FF7F00;
    padding: 8px 20px;
}
.dropdown-menu .dropdown-item:hover {
    background-color: #d97706;
}
</style>
