<?php

namespace App\Exports;

use App\Models\Register;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExportVnRegister implements WithHeadings, FromQuery, WithMapping
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
            'Dân tộc',
            'Email',
            'Số điện thoại',
            'Nhóm đối tượng',
            'Loại đăng ký tham gia',
            'Chi phí',
            'Loại CME',
            'Địa chỉ nhận giấy chứng nhận',
            'Năm tốt nghiệp trên bằng',
            'Ảnh bằng chuyên môn cao nhất (Mặt chính)',
            'Ảnh thẻ sinh viên',
            'Ảnh chuyển khoản',
            'Trạng Thái'
        ];
    }

    public function query()
    {
        return Register::with(['fees', 'payment', 'member'])
            ->where('registers.conference_id', $this->conference_id)
            ->where('registers.locale', 'vn')
            ->orderBy('registers.id', 'DESC');
    }

    public function map($register): array
    {
        return [
            \Carbon\Carbon::parse($register->created_at)->format('H:i:s d/m/Y'),
            $register->id,
            $register->register_code,
            $register->member->member_degree,
            Str::title($register->member->member_full_name),
            $register->member->member_gender == 0 ? 'Nam' : 'Nữ',
            $register->member->member_date,
            $register->member->member_month,
            $register->member->member_year,
            $register->member->member_work_unit,
            $register->member->member_place_of_birth,
            $register->member->member_nation,
            $register->member->member_email,
            $register->member->member_phone,
            $register->member->member_object_group,
            $register->fees->implode('conference_fee_title', ', '),
            $register->payment->payment_price,
            $register->register_cme_type,
            $register->member->member_full_address,
            $register->member->member_graduation_year,
            $register->member->member_image != null ? 'https://drive.google.com/file/d/' . $register->member->member_image . '/view' : '',
            $register->member->member_image_card != null ? 'https://drive.google.com/file/d/' . $register->member->member_image_card . '/view' : '',
            $register->payment->payment_image != null ? 'https://drive.google.com/file/d/' . $register->payment->payment_image . '/view' : '',
            $register->payment->payment_status == 1 ? 'Chờ kiểm tra' : 'Đã xử lý',
        ];
    }
}
