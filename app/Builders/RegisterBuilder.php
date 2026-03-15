<?php

namespace App\Builders;

use App\Models\Register;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

final class RegisterBuilder extends Builder
{
    public function getAllRegister($conference_id, $locale)
    {
        // $registers = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
        //     ->join('members', 'members.id', 'registers.member_id')
        //     ->select(
        //         'registers.conference_id',
        //         'payment_id',
        //         'registers.id',
        //         'register_code',
        //         'registers.created_at',
        //         'register_cme_type',
        //         'locale',
        //         'member_degree',
        //         'member_full_name',
        //         'member_gender',
        //         'member_date',
        //         'member_month',
        //         'member_year',
        //         'member_place_of_birth',
        //         'member_nation',
        //         'member_object_group',
        //         'member_work_unit',
        //         'member_graduation_year',
        //         'member_email',
        //         'member_phone',
        //         'member_image',
        //         'member_image_card',
        //         'payment_price',
        //         'payment_image',
        //         'payment_status'
        //     )
        //     ->where('registers.conference_id', $conference_id)
        //     ->where('registers.locale', $locale)
        //     ->orderBy('registers.id', 'DESC')
        //     ->get();
        $registers = Register::with(['fees', 'payment', 'member'])
            ->where('conference_id', $conference_id)
            ->where('locale', $locale)
            ->orderBy('id', 'DESC')
            ->get();

        return $registers;
    }

    public function getAllRegisterWithPaginate($conference_id, $locale)
    {
        $registers = Register::with(['fees', 'payment', 'member'])
            ->where('registers.conference_id', $conference_id)
            ->where('registers.locale', $locale)
            ->orderBy('registers.id', 'DESC')
            ->paginate(10);

        return $registers;
    }

    public function getAllRegisterWithCurrentPage($conference_id, $current_page, $locale)
    {
        // $registers = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
        //     ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
        //     ->select(
        //         'registers.conference_id',
        //         'payment_id',
        //         'registers.id',
        //         'register_code',
        //         'register_degree',
        //         'register_name',
        //         'register_gender',
        //         'register_date',
        //         'register_month',
        //         'register_year',
        //         'register_work_unit',
        //         'register_place_of_birth',
        //         'register_nation',
        //         'register_email',
        //         'register_phone',
        //         'register_object_group',
        //         'conference_fee_title',
        //         'payment_price',
        //         'register_receiving_address',
        //         'registers.created_at',
        //         'register_graduation_year',
        //         'register_image',
        //         'register_image_card',
        //         'payment_image',
        //         'payment_status'
        //     )
        //     ->where('registers.conference_id', $conference_id)
        //     ->orderBy('registers.id', 'DESC')
        //     ->paginate(10, ['*'], 'page', $current_page)->items();

        $registers = Register::with(['fees', 'payment', 'member'])
            ->where('registers.conference_id', $conference_id)
            ->where('registers.locale', $locale)
            ->orderBy('registers.id', 'DESC')
            ->paginate(10, ['*'], 'page', $current_page)->items();


        return $registers;
    }

    public function getAllRegisterByParamCode($conference, $code, $multi)
    {
        $counter = 0;
        $prices = 0;
        if ($multi) {
            $registers = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
                ->select(
                    'registers.conference_id',
                    'payment_id',
                    'registers.id',
                    'register_code',
                    'payment_price',
                )
                ->whereIn('registers.conference_id', explode(',', $conference))
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

        $registers = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->select(
                'registers.conference_id',
                'payment_id',
                'registers.id',
                'register_code',
                'payment_price',
            )
            ->where('registers.conference_id', $conference)
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

    public function getAllRegisterAmount($conference, $multi, $locale)
    {
        $query = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->select(
                'registers.conference_id',
                'payment_id',
                'registers.id',
                'register_code',
                'payment_price',
            )->where('locale', $locale);
        if ($multi) {
            $registers = $query->whereIn('registers.conference_id', explode(',', $conference));

            $response = ['counter' => $registers->get()->count(), 'prices' => $registers->get()->sum('payment_price')];
            return $response;
        }

        $registers = $query->where('registers.conference_id', $conference);

        $response = ['counter' => $registers->get()->count(), 'prices' => $registers->get()->sum('payment_price')];
        return $response;
    }

    public function getAllRegisterAmountStatus($conference_id, $locale)
    {
        $status1 = 0;
        $status2 = 0;
        $status3 = 0;
        $status4 = 0;
        $registers = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->select(
                'registers.conference_id',
                'payment_id',
                'registers.id',
                'payment_status'
            )
            ->where('registers.conference_id', $conference_id)
            ->where('locale', $locale)
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

    public function getRegisterQueryBuilderBySearchData($searchData, $conference_id, $locale)
    {
        $query = Register::with(['fees', 'payment', 'member'])
            ->where('conference_id', $conference_id)
            ->where('locale', $locale);
        // $query = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
        //     ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
        //     ->select(
        //         'registers.conference_id',
        //         'payment_id',
        //         'registers.id',
        //         'register_code',
        //         'register_degree',
        //         'register_name',
        //         'register_gender',
        //         'register_date',
        //         'register_month',
        //         'register_year',
        //         'register_work_unit',
        //         'register_place_of_birth',
        //         'register_nation',
        //         'register_email',
        //         'register_phone',
        //         'register_object_group',
        //         'conference_fee_title',
        //         'payment_price',
        //         'register_receiving_address',
        //         'registers.created_at',
        //         'register_graduation_year',
        //         'register_image',
        //         'register_image_card',
        //         'payment_image',
        //         'payment_status'
        //     )
        //     ->where('registers.conference_id', $conference_id);

        if (!empty($searchData['id'])) {
            $query->whereIn('id', explode(',', $searchData['id']));
        }
        if (!empty($searchData['register_code'])) {
            $query->whereIn('register_code', explode(',', $searchData['register_code']));
        }
        if (!empty($searchData['member_full_name'])) {
            $full_names = explode(',', $searchData['member_full_name']);

            $query->whereHas('member', function ($q) use ($full_names) {
                $q->whereIn('member_full_name', $full_names);
            });
        }
        if (!empty($searchData['member_email'])) {
            $emails = explode(',', $searchData['member_email']);

            $query->whereHas('member', function ($q) use ($emails) {
                $q->whereIn('member_email', $emails);
            });
        }
        if (!empty($searchData['member_phone'])) {
            $phones = explode(',', $searchData['member_phone']);

            $query->whereHas('member', function ($q) use ($phones) {
                $q->whereIn('member_phone', $phones);
            });
        }
        if (!empty($searchData['payment_status'])) {
            $statuses = explode(',', $searchData['payment_status']);
            $query->whereHas('payment', function ($q) use ($statuses) {
                $q->whereIn('payment_status', $statuses);
            });
        }
        return $query->get();
    }
}
