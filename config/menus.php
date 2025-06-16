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
            'title' => 'Donasi Publik',
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
          
        ],
        [
            'title' => 'Galeri',
            'icon'  => '🖼️',
            'route' => 'galleries.index',
        ],

    ],
    'bendahara' => [
        [
            'title' => 'Dashboard',
            'icon' => '🏠',
            'route' => 'dashboard.bendahara',
        ],
        [
            'title' => 'Donasi Publik',
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
          
        ],
        [
            'title' => 'Galeri',
            'icon'  => '🖼️',
            'route' => 'galleries.index',
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
        [
            'title' => 'Histori Donasi',
            'icon' => '🕘',
            'route' => 'anggota.histori_donasi',
        ],
    ],

];
