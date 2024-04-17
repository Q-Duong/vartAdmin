<?php

namespace App\Exports;

use App\Models\EnReport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExportENReport implements WithHeadings, FromQuery, WithMapping
{
    protected $conference_id;

    public function __construct($conference_id)
    {
        $this->conference_id = $conference_id;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'First name',
            'Last name',
            'Birth date',
            'Birth month',
            'Birth year',
            'Email',
            'Profession',
            'Organization',
            'Department',
            'Country',
            'Title of abstract, paper',
            'Abstract, paper',
        ];
    }

    public function query()
    {
        return EnReport::query()->where('conference_id', $this->conference_id);
    }

    public function map($en_report): array
    {
        return [
            $en_report->en_report_id,
            $en_report->en_report_title,
            $en_report->en_report_firstname,
            $en_report->en_report_lastname,
            $en_report->en_report_date,
            $en_report->en_report_month,
            $en_report->en_report_year,
            $en_report->en_report_email,
            $en_report->en_report_profession,
            $en_report->en_report_organization,
            $en_report->en_report_department,
            $en_report->en_report_nationality,
            $en_report->en_report_file_title,
            $en_report->en_report_file != null ? 'https://drive.google.com/file/d/' . $en_report->en_report_file . '/view' : '',
        ];
    }
}
