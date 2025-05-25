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
            
        ],
        [
            'title' => 'Donatur',
            'icon' => '👥',
            'route' => 'donors.index',
        ],
        [
            'title' => 'Kegiatan',
            'icon' => '📅',
            'route' => 'campaigns.index',
        ],        
        [
            'title' => 'Rekap Donasi',
            'icon' => '📝',
            'route' => 'rekap-donasi.index',
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
            
        ],
        [
            'title' => 'Donatur',
            'icon' => '👥',
            'route' => 'donors.index',
        ],
        [
            'title' => 'Kegiatan',
            'icon' => '📅',
            'route' => 'campaigns.index',
        ],
        [
            'title' => 'Rekap Donasi',
            'icon' => '📝',
            'route' => 'rekap-donasi.index',
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
            'route' => 'campaigns.index',
            
        ],
    ],
];
