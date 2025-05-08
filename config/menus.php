<?php

return [
    'admin' => [
        [
            'title' => 'Dashboard',
            'icon' => '🏠',
            'route' => 'dashboard.admin',
        ],
        [
            'title' => 'Kelola Akun',
            'icon' => '👤',
            'route' => 'users.index',
        ],
        [
            'title' => 'Donasi',
            'icon' => '💰',
            'route' => 'donations.index',
            'active' => false,
        ],
        [
            'title' => 'Donatur',
            'icon' => '👥',
            'route' => 'donors.index',
        ],
        [
            'title' => 'Kegiatan',
            'icon' => '📅',
            'route' => 'events.index',
            'active' => false,
        ],
        [
            'title' => 'Rekap Donasi',
            'icon' => '📝',
            'route' => 'rekap-donasi.index',
            'active' => false,
        ],
        [
            'title' => 'Laporan Pengeluaran',
            'icon' => '📄',
            'route' => 'laporan-pengeluaran.index',
            'active' => false,
        ],
    ],
    'bendahara' => [
        [
            'title' => 'Dashboard',
            'icon' => '🏠',
            'route' => 'dashboard.bendahara',
        ],
        [
            'title' => 'Donasi',
            'icon' => '💰',
            'route' => 'donations.index',
            'active' => false,
        ],
        [
            'title' => 'Donatur',
            'icon' => '👥',
            'route' => 'donors.index',
        ],
        [
            'title' => 'Kegiatan',
            'icon' => '📅',
            'route' => 'events.index',
            'active' => false,
        ],
        [
            'title' => 'Rekap Donasi',
            'icon' => '📝',
            'route' => 'rekap-donasi.index',
            'active' => false,
        ],
        [
            'title' => 'Laporan Pengeluaran',
            'icon' => '📄',
            'route' => 'laporan-pengeluaran.index',
            'active' => false,
        ],
    ],
    'anggota' => [
        [
            'title' => 'Dashboard',
            'icon' => '🏠',
            'route' => 'dashboard.anggota',
        ],
        [
            'title' => 'Kegiatan',
            'icon' => '📅',
            'route' => 'events.index',
            'active' => false,
        ],
    ],
];
