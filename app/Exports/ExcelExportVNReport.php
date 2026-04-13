<?php

namespace App\Exports;

use App\Models\Report;
use Illuminate\Support\Str;
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
            'Hình thức',
            'Tiêu đề bài báo cáo',
            'Bài báo cáo',
            'Lý lịch khoa học'
        ];
    }

    public function query()
    {
        return Report::join('members', 'members.id', 'reports.member_id')->join('topics', 'topics.id', 'reports.report_topics')
            ->select(
                'reports.conference_id',
                'reports.id',
                'reports.created_at',
                'report_code',
                'report_file_title',
                'report_file',
                'report_file_background',
                'report_share',
                'report_type',
                'report_status',
                'reports.locale',
                'topic_title_en',
                'member_degree',
                'member_full_name',
                'member_gender',
                'member_date',
                'member_month',
                'member_year',
                'member_place_of_birth',
                'member_nation',
                'member_work_unit',
                'member_graduation_year',
                'member_email',
                'member_phone',
                'member_image',
                'member_image_card',
            )
            ->where('reports.conference_id', $this->conference_id)
            ->where('reports.locale', 'vn')
            ->orderBy('reports.id', 'DESC');
    }

    public function map($report): array
    {
        return [
            \Carbon\Carbon::parse($report->created_at)->format('H:i:s d/m/Y'),
            $report->id,
            $report->report_code,
            $report->member_degree,
            Str::title($report->member_full_name),
            $report->member_gender == 0 ? 'Nam' : 'Nữ',
            $report->member_date,
            $report->member_month,
            $report->member_year,
            $report->member_work_unit,
            $report->member_place_of_birth,
            $report->member_email,
            $report->member_phone,
            $report->member_graduation_year,
            $report->member_image != null ? 'https://drive.google.com/file/d/' . $report->member_image . '/view' : '',
            $report->member_image_card != null ? 'https://drive.google.com/file/d/' . $report->member_image_card . '/view' : '',
            $report->topic_title_en,
            Str::title($report->report_type),
            $report->report_file_title,
            $report->report_file != null ? 'https://drive.google.com/file/d/' . $report->report_file . '/view' : '',
            $report->report_file_background != null ? 'https://drive.google.com/file/d/' . $report->report_file_background . '/view' : '',
        ];
    }
}
