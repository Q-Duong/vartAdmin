<?php

namespace App\Exports;

use App\Models\EnRegister;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExportEnRegister implements WithHeadings, FromQuery, WithMapping
{
    protected $conference_id;

    public function __construct($conference_id)
    {
        $this->conference_id = $conference_id;
    }

    public function headings(): array
    {
        return [
            'Registration time',
            'ID',
            'Code',
            'Title',
            'First name',
            'Last name',
            'Gender',
            'Official Company Name',
            'Country',
            'Email',
            'Phone',
            'Register type',
            'Fee',
            'Status'
        ];
    }

    public function query()
    {
        return EnRegister::join('payments', 'payments.id', '=', 'en_registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->where('en_registers.conference_id', $this->conference_id)
            ->select(
                'en_registers.id',
                'en_register_code',
                'en_register_title',
                'en_register_firstname',
                'en_register_lastname',
                'en_register_gender',
                'en_register_work_unit',
                'en_register_nation',
                'en_register_email',
                'en_register_phone',
                'conference_fee_title',
                'payment_price',
                'en_registers.created_at',
                'payment_status')
            ->orderBy('en_registers.id', 'DESC');
    }

    public function map($en_register): array
    {
        return [
            \Carbon\Carbon::parse($en_register->created_at)->format('H:i:s d/m/Y'),
            $en_register->id,
            $en_register->en_register_code,
            $en_register->en_register_title,
            $en_register->en_register_firstname,
            $en_register->en_register_lastname,
            $en_register->en_register_gender == 0 ? 'Male' : 'Female',
            $en_register->en_register_work_unit,
            $en_register->en_register_nation,
            $en_register->en_register_email,
            $en_register->en_register_phone,
            $en_register->conference_fee_title,
            '$' . number_format($en_register->payment_price, 2),
            $en_register->payment_status == 1 ? 'Wait checking' : 'Processed'
        ];
    }
}
