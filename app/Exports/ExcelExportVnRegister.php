<?php

namespace App\Exports;

use App\Models\Register;
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
        return Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->where('registers.conference_id', $this->conference_id)
            ->select(
                'registers.id',
                'register_code',
                'register_degree',
                'register_name',
                'register_gender',
                'register_date',
                'register_month',
                'register_year',
                'register_work_unit',
                'register_place_of_birth',
                'register_nation',
                'register_email',
                'register_phone',
                'register_object_group',
                'conference_fee_title',
                'payment_price',
                'register_receiving_address',
                'registers.created_at',
                'register_graduation_year',
                'register_image',
                'register_image_card',
                'payment_image',
                'payment_status')
            ->orderBy('registers.id', 'DESC');
    }

    public function map($register): array
    {
        return [
            \Carbon\Carbon::parse($register->created_at)->format('H:i:s d/m/Y'),
            $register->id,
            $register->register_code,
            $register->register_degree,
            $register->register_name,
            $register->register_gender == 0 ? 'Nam' : 'Nữ',
            $register->register_date,
            $register->register_month,
            $register->register_year,
            $register->register_work_unit,
            $register->register_place_of_birth,
            $register->register_nation,
            $register->register_email,
            $register->register_phone,
            $register->register_object_group,
            $register->conference_fee_title,
            number_format($register->payment_price, 0, ',', '.') . '₫',
            $register->register_receiving_address,
            $register->register_graduation_year,
            $register->register_image != null ? 'https://drive.google.com/file/d/' . $register->register_image . '/view' : '',
            $register->register_image_card != null ? 'https://drive.google.com/file/d/' . $register->register_image_card . '/view' : '',
            $register->payment_image != null ? 'https://drive.google.com/file/d/' . $register->payment_image . '/view' : '',
            $register->payment_status == 1 ? 'Chờ kiểm tra' : 'Đã xử lý',
        ];
    }
}
