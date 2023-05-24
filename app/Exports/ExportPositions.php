<?php

namespace App\Exports;

use App\Models\Position;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ExportPositions implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Position::all();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Keterangan',
            'Alias',
            'Created At',
            'Updated At',
            // Add more headings if needed
        ];
    }

    /**
    * @return array
    */
    public function styles($excel): array
    {
        return [
            1 => [
                'font' => ['bold' => true],
            ],
        ];
    }
}
