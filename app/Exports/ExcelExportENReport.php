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
            'Registration period',
            'ID',
            'Code',
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
            'Topics',
            'Title of abstract, paper',
            'Abstract, paper',
        ];
    }

    public function query()
    {
        return EnReport::join('topics', 'topics.id', 'en_reports.en_report_topics')
        ->select(
            'conference_id',
            'en_reports.id',
            'en_reports.created_at',
            'en_report_code',
            'en_report_firstname',
            'en_report_lastname',
            'en_report_title',
            'en_report_date',
            'en_report_month',
            'en_report_year',
            'en_report_email',
            'en_report_profession',
            'en_report_organization',
            'en_report_department',
            'en_report_nationality',
            'en_report_topics',
            'en_report_file',
            'en_report_file_title',
            'topic_title_en'
        )->where('conference_id', $this->conference_id)
        ->orderBy('en_reports.id', 'DESC');
    }

    public function map($en_report): array
    {
        return [
            \Carbon\Carbon::parse($en_report->created_at)->format('H:i:s d/m/Y'),
            $en_report->id,
            $en_report->en_report_code,
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
            $en_report->topic_title_en,
            $en_report->en_report_file_title,
            $en_report->en_report_file != null ? 'https://drive.google.com/file/d/' . $en_report->en_report_file . '/view' : '',
        ];
    }
}
