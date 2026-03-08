<?php

namespace App\Exports;

use App\Models\Dealer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DealersExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * Database se data fetch karna
     */
    public function collection()
    {
        // Latest registered dealers pehle aayenge
        return Dealer::latest()->get();
    }

    /**
     * Excel ke columns ka data map karna (Order set karna)
     */
    public function map($dealer): array
    {
        return [
            $dealer->dealer_id_custom,
            $dealer->name,
            $dealer->shop_name,
            $dealer->email,
            $dealer->phone,
            $dealer->gst_no ?? 'N/A',
            $dealer->pan_no ?? 'N/A',
            $dealer->address . ', ' . $dealer->district . ' (' . $dealer->state . ')',
            $dealer->pincode,
            date('d-M-Y', strtotime($dealer->valid_from)),
            date('d-M-Y', strtotime($dealer->valid_till)),
            ucfirst($dealer->status),
            $dealer->created_at->format('d-M-Y'),
        ];
    }

    /**
     * Excel file ki headings set karna
     */
    public function headings(): array
    {
        return [
            "Dealer ID",
            "Full Name",
            "Shop Name",
            "Email Address",
            "Phone Number",
            "GST Number",
            "PAN Number",
            "Full Address",
            "Pincode",
            "Valid From",
            "Valid Till",
            "Account Status",
            "Registered Date"
        ];
    }

    /**
     * Excel formatting: Heading ko bold karna
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Row 1 (Headings) ko Bold aur Blue color dena
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '448AFF']
                ]
            ],
        ];
    }
}