<?php

namespace App\Exports;

use App\Models\Register;
use Illuminate\Support\Str;
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
            'Registration period',
            'ID',
            'Code',
            'Title',
            'First Name',
            'Last Name',
            'Country',
            'Gender',
            'Month',
            'Day',
            'Year',
            'Workplace',
            'Email Address',
            'Phone Number',
            'Register type',
            'Fee',
            'Status'
        ];
    }

    public function query()
    {
        return Register::with(['fees', 'payment', 'member'])
            ->where('registers.conference_id', $this->conference_id)
            ->where('registers.locale', 'en')
            ->orderBy('registers.id', 'DESC');
    }

    public function map($register): array
    {
        return [
            \Carbon\Carbon::parse($register->created_at)->format('H:i:s d/m/Y'),
            $register->id,
            $register->register_code,
            $register->member->member_title,
            Str::title($register->member->member_first_name),
            Str::title($register->member->member_last_name),
            $register->member->member_country,
            $register->member->member_gender == 0 ? 'Male' : 'Female',
            $register->member->member_month,
            $register->member->member_date,
            $register->member->member_year,
            $register->member->member_work_unit,
            $register->member->member_email,
            $register->member->member_phone,
            $register->conference_fee_title,
            $register->payment->payment_price,
            $register->payment->payment_status == 1 ? 'Wait checking' : 'Processed'
        ];
    }
}
