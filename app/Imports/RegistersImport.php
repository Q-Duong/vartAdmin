<?php

namespace App\Imports;

use App\Models\Register;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegistersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        // dd($row);
        return new Register([
            'conference_id' => $row['conference_id'],
            'payment_id' => $row['payment_id'],
            'register_code' => $row['code'],
            'register_degree' => $row['academic_degree'],
            'register_name' => $row['full_name'],
            'register_gender' => $row['gender'],
            'register_date' => $row['birth_date'],
            'register_month' => $row['birth_month'],
            'register_year' => $row['birth_year'],
            'register_work_unit' => $row['workplace'],
            'register_place_of_birth' => $row['birthplace'],
            'register_nation' => $row['nation'],
            'register_email' => $row['email'],
            'register_phone' => $row['phone_number'],
            'register_object_group' => $row['object_group'],
            'conference_fee_title' => $row['type_of_registration'],
            'payment_price' => $row['cost'],
            'register_receiving_address' => $row['address_to_receive_the_certificate'],
            'register_graduation_year' => $row['graduation_year'],
            'register_image' => $row['graduation_certificate_photo'],
            'register_image_card' => $row['student_identification_photo'],
        ]);
    }
}
