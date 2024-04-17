<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromArray;
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
            'ID',
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
            'Bài báo cáo',
        ];
    }

    public function query()
    {
        return Report::query()->where('conference_id', $this->conference_id);
    }

    public function map($vn_report): array
    {
        return [
            $vn_report->report_id,
            $vn_report->report_degree,
            $vn_report->report_name,
            $vn_report->report_gender == 0 ? 'Nam' : 'Nữ',
            $vn_report->report_date,
            $vn_report->report_month,
            $vn_report->report_year,
            $vn_report->report_work_unit,
            $vn_report->report_place_of_birth,
            $vn_report->report_email,
            $vn_report->report_phone,
            $vn_report->report_graduation_year,
            $vn_report->report_image != null ? 'https://drive.google.com/file/d/' . $vn_report->report_image . '/view' : '',
            $vn_report->report_image_card != null ? 'https://drive.google.com/file/d/' . $vn_report->report_image_card . '/view' : '',
            $vn_report->report_file != null ? 'https://drive.google.com/file/d/' . $vn_report->report_file . '/view' : '',
        ];
    }
}
