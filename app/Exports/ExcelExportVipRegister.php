<?php

namespace App\Exports;

use App\Models\Vip;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExportVipRegister implements WithHeadings, FromQuery, WithMapping
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
            'Email',
            'Số điện thoại',
            'Địa chỉ nhận giấy chứng nhận',
        ];
    }

    public function query()
    {
        return Vip::where('conference_id', $this->conference_id)
            ->orderBy('id', 'DESC');
    }

    public function map($vip): array
    {
        return [
            \Carbon\Carbon::parse($vip->created_at)->format('H:i:s d/m/Y'),
            $vip->id,
            $vip->vip_code,
            $vip->vip_degree,
            $vip->vip_name,
            $vip->vip_gender == 0 ? 'Nam' : 'Nữ',
            $vip->vip_date,
            $vip->vip_month,
            $vip->vip_year,
            $vip->vip_work_unit,
            $vip->vip_email,
            $vip->vip_phone,
            $vip->vip_receiving_address,
        ];
    }
}
