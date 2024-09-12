<?php

namespace App\Builders;

use App\Models\Register;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

final class RegisterBuilder extends Builder
{
    public function getAllRegister($conference_id)
    {
        $registers = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->select(
                'registers.conference_id',
                'payment_id',
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
                'payment_status'
            )
            ->where('registers.conference_id', $conference_id)
            ->orderBy('registers.id', 'DESC')
            ->get();

        return $registers;
    }

    public function getAllRegisterWithPaginate($conference_id)
    {
        $registers = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->select(
                'registers.conference_id',
                'payment_id',
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
                'payment_status'
            )
            ->where('registers.conference_id', $conference_id)
            ->orderBy('registers.id', 'DESC')
            ->paginate(10);

        return $registers;
    }

    public function getAllRegisterByParamCode($conference_id, $code)
    {
        $counter = 0;
        $prices = 0;
        $registers = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->select(
                'registers.conference_id',
                'payment_id',
                'registers.id',
                'register_code',
                'payment_price',
            )
            ->where('registers.conference_id', $conference_id)
            ->orderBy('registers.id', 'DESC')
            ->get();
        foreach ($registers as $key => $register) {
            if (mb_substr($register->register_code, 0, 2) == $code) {
                $counter++;
                $prices += $register->payment_price;
            }
        }
        $response = ['counter' => $counter, 'prices' => $prices];
        return $response;
    }

    public function getAllRegisterAmount($conference_id)
    {
        $counter = 0;
        $prices = 0;
        $registers = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->select(
                'registers.conference_id',
                'payment_id',
                'registers.id',
                'register_code',
                'payment_price',
            )
            ->where('registers.conference_id', $conference_id)
            ->orderBy('registers.id', 'DESC')
            ->get();
        foreach ($registers as $key => $register) {
            $counter++;
            $prices += $register->payment_price;
        }
        $response = ['counter' => $counter, 'prices' => $prices];
        return $response;
    }

    public function getAllRegisterAmountStatus($conference_id)
    {
        $status1 = 0;
        $status2 = 0;
        $status3 = 0;
        $status4 = 0;
        $registers = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->select(
                'registers.conference_id',
                'payment_id',
                'registers.id',
                'payment_status'
            )
            ->where('registers.conference_id', $conference_id)
            ->orderBy('registers.id', 'DESC')
            ->get();
        foreach ($registers as $key => $register) {
            if ($register->payment_status == 1) {
                $status1++;
            }
            if ($register->payment_status == 2) {
                $status2++;
            }
            if ($register->payment_status == 3) {
                $status3++;
            }
            if ($register->payment_status == 4) {
                $status4++;
            }
        }
        $response = ['status1' => $status1, 'status2' => $status2, 'status3' => $status3, 'status4' => $status4];
        return $response;
    }
}
