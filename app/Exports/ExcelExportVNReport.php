<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExportVNReport implements WithHeadings, FromQuery, WithMapping
{
    protected $conference_id;

    public function __construct($conference_id)
    {
        $this->conference_id = $conference_id;
    }

    public function headings(): array
    {
        return [
            'Thời gian đăng ký',
            'ID',
            'Code',
            'Học vị',
            'Họ và tên',
            'Giới tính',
            'Ngày sinh',
            'Thánh sinh',
            'Năm sinh',
            'Đơn vị',
            'Nơi sinh',
            'Email',
            'Số điện thoại',
            'Năm tốt nghiệp trên bằng',
            'Ảnh bằng đại học',
            'Ảnh thẻ sinh viên',
            'Chủ đề',
            'Tiêu đề bài báo cáo',
            'Bài báo cáo',
            'Lý lịch khoa học'
        ];
    }

    public function query()
    {
        return Report::join('topics', 'topics.id', 'reports.report_topics')
        ->select(
            'conference_id',
            'reports.id',
            'reports.created_at',
            'report_code',
            'report_degree',
            'report_name',
            'report_gender',
            'report_date',
            'report_month',
            'report_year',
            'report_phone',
            'report_email',
            'report_work_unit',
            'report_place_of_birth',
            'report_graduation_year',
            'report_file_title',
            'report_image',
            'report_image_card',
            'report_file',
            'report_file_background',
            'topic_title_en'
        )->where('conference_id', $this->conference_id)
        ->orderBy('reports.id', 'DESC');
    }

    public function map($report): array
    {
        return [
            \Carbon\Carbon::parse($report->created_at)->format('H:i:s d/m/Y'),
            $report->id,
            $report->report_code,
            $report->report_degree,
            $report->report_name,
            $report->report_gender == 0 ? 'Nam' : 'Nữ',
            $report->report_date,
            $report->report_month,
            $report->report_year,
            $report->report_work_unit,
            $report->report_place_of_birth,
            $report->report_email,
            $report->report_phone,
            $report->report_graduation_year,
            $report->report_image != null ? 'https://drive.google.com/file/d/' . $report->report_image . '/view' : '',
            $report->report_image_card != null ? 'https://drive.google.com/file/d/' . $report->report_image_card . '/view' : '',
            $report->topic_title_en,
            $report->report_file_title,
            $report->report_file != null ? 'https://drive.google.com/file/d/' . $report->report_file . '/view' : '',
            $report->report_file_background != null ? 'https://drive.google.com/file/d/' . $report->report_file_background . '/view' : '',
        ];
    }
}
