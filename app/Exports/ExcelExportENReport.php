<?php

namespace App\Exports;

use App\Models\Report;
use Illuminate\Support\Str;
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
            'Registration period',
            'ID',
            'Code',
            'Title',
            'Profession',
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
            'Topics',
            'Title of abstract, paper',
            'Abstract, paper',
        ];
    }

    public function query()
    {
        return Report::with(['member', 'topic'])
            ->where('reports.conference_id', $this->conference_id)
            ->where('reports.locale', 'en')
            ->orderBy('reports.id', 'DESC');
    }

    public function map($report): array
    {
        return [
            \Carbon\Carbon::parse($report->created_at)->format('H:i:s d/m/Y'),
            $report->id,
            $report->report_code,
            $report->member->member_title,
            $report->member->member_degree,
            Str::title($report->member->member_first_name),
            Str::title($report->member->member_last_name),
            $report->member->member_country,
            $report->member->member_gender == 0 ? 'Male' : 'Female',
            $report->member->member_month,
            $report->member->member_date,
            $report->member->member_year,
            $report->member->member_work_unit,
            $report->member->member_email,
            $report->member->member_phone,
            $report->topic->topic_title_en,
            $report->report_file_title,
            $report->report_file != null ? 'https://drive.google.com/file/d/' . $report->report_file . '/view' : '',
        ];
    }
}
