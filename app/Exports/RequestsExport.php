<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RequestsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $requests;

    public function __construct($requests)
    {
        $this->requests = $requests;
    }

    public function collection()
    {
        return $this->requests;
    }

    public function headings(): array
    {
        return [
            'Título',
            'Descrição',
            'Categoria',
            'Status',
            'Solicitante',
            'Data de Criação'
        ];
    }

    public function map($request): array
    {
        return [
            $request->title,
            $request->description,
            $request->category->name ?? '-',
            $request->status->name ?? 'Sem Status',
            $request->requester_name,
            $request->created_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
