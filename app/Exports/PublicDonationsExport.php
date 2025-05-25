<?php

namespace App\Exports;

use App\Models\PublicDonation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;

class PublicDonationsExport implements FromCollection, WithHeadings
{
    protected $data;

    // Kirim data dari controller
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($donation) {
            return [
                'Nama'     => $donation->nama,
                'Email'    => $donation->email,
                'Telepon'  => $donation->telepon,
                'Nominal'  => $donation->nominal,
                'Pesan'    => $donation->pesan,
                'Tanggal'  => $donation->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama', 'Email', 'Telepon', 'Nominal', 'Pesan', 'Tanggal'];
    }
}
