<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidateController extends Controller
{
    //Conference
    public function validateConference()
    {
        $rules = [
            'conference_code' => 'required',
            'conference_title' => 'required',
            'conference_title_en' => 'required',
            'conference_content' => 'required',
            'conference_content_en' => 'required',
        ];

        return $rules;
    }

    public static function messageConference()
    {
        $message = [
            'report_name.required' => __('validation.report.report_name_required'),
            'report_name.regex' => __('validation.report.report_name_regex'),
            'report_phone.required' => __('validation.report.report_phone_required'),
            'report_phone.numeric' => __('validation.report.report_phone_numeric'),
            'report_phone.digits_between' => __('validation.report.report_phone_digits_between'),
            'report_email.required' => __('validation.report.report_email_required'),
            'report_email.email' => __('validation.report.report_email_email'),
            'report_place_of_birth.required' => __('validation.report.report_place_of_birth_required'),
            'report_work_unit.required' => __('validation.report.report_work_unit_required'),
            'report_graduation_year.required' => __('validation.report.report_graduation_year_required'),
            'report_graduation_year.numeric' => __('validation.report.report_graduation_year_numeric'),
            'report_graduation_year.digits_between' => __('validation.report.report_graduation_year_digits_between'),
            'report_image.required' => __('validation.report.report_image_required'),
            'report_image_card.required' => __('validation.report.report_image_card_required'),
            'report_file_title.required' => __('validation.report.report_file_title_required'),
            'report_file.required' => __('validation.report.report_file_required'),
            'report_file_background.required' => __('validation.report.report_file_background_required'),
            'report_policy.accepted' => __('validation.report.report_policy_accepted'),

            'en_report_firstname.required' => __('validation.report.en_report_firstname_required'),
            'en_report_firstname.regex' => __('validation.report.en_report_firstname_regex'),
            'en_report_lastname.required' => __('validation.report.en_report_lastname_required'),
            'en_report_lastname.regex' => __('validation.report.en_report_lastname_regex'),
            'en_report_email.required' => __('validation.report.report_email_required'),
            'en_report_email.email' => __('validation.report.report_email_email'),
            'en_report_organization.required' => __('validation.report.en_report_organization_required'),
            'en_report_department.required' => __('validation.report.en_report_department_required'),
            'en_report_file_title.required' => __('validation.report.en_report_file_title_required'),
            'en_report_file.required' => __('validation.report.en_report_file_required'),
        ];

        return $message;
    }
    //Report
    public function validateReport($locale)
    {
        if ($locale == 'en') {
            $rules = [
                'en_report_firstname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_report_lastname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_report_email' => 'required|email|unique:users,email',
                'en_report_organization' => 'required',
                'en_report_department' => 'required',
                'en_report_file_title' => 'required',
            ];
        } else {
            $rules = [
                'report_name' => 'required|string|regex:/^([^0-9]*)$/',
                // 'report_issue_date' => 'required|date|after:1940-01-01|before_or_equal:2025-01-01',
                'report_phone' => 'required|numeric|digits_between:10,10',
                'report_email' => 'required|email|unique:users,email',
                'report_work_unit' => 'required|max:255',
                'report_file_title' => 'required|max:255',
                'report_place_of_birth' => 'required',
            ];
        }

        return $rules;
    }

    public function validateFindOldData($locale)
    {
        if ($locale == 'en') {
            $rules = [
                'en_report_email' => 'required|email|unique:users,email',
            ];
        } else {
            $rules = [
                'report_phone' => 'required|numeric|digits_between:10,10',
            ];
        }

        return $rules;
    }

    public static function messageReport()
    {
        $message = [
            'report_name.required' => __('validation.report.report_name_required'),
            'report_name.regex' => __('validation.report.report_name_regex'),
            'report_phone.required' => __('validation.report.report_phone_required'),
            'report_phone.numeric' => __('validation.report.report_phone_numeric'),
            'report_phone.digits_between' => __('validation.report.report_phone_digits_between'),
            'report_email.required' => __('validation.report.report_email_required'),
            'report_email.email' => __('validation.report.report_email_email'),
            'report_place_of_birth.required' => __('validation.report.report_place_of_birth_required'),
            'report_work_unit.required' => __('validation.report.report_work_unit_required'),
            'report_graduation_year.required' => __('validation.report.report_graduation_year_required'),
            'report_graduation_year.numeric' => __('validation.report.report_graduation_year_numeric'),
            'report_graduation_year.digits_between' => __('validation.report.report_graduation_year_digits_between'),
            'report_image.required' => __('validation.report.report_image_required'),
            'report_image_card.required' => __('validation.report.report_image_card_required'),
            'report_file_title.required' => __('validation.report.report_file_title_required'),
            'report_file.required' => __('validation.report.report_file_required'),
            'report_file_background.required' => __('validation.report.report_file_background_required'),
            'report_policy.accepted' => __('validation.report.report_policy_accepted'),

            'en_report_firstname.required' => __('validation.report.en_report_firstname_required'),
            'en_report_firstname.regex' => __('validation.report.en_report_firstname_regex'),
            'en_report_lastname.required' => __('validation.report.en_report_lastname_required'),
            'en_report_lastname.regex' => __('validation.report.en_report_lastname_regex'),
            'en_report_email.required' => __('validation.report.en_report_email_required'),
            'en_report_email.email' => __('validation.report.en_report_email_email'),
            'en_report_organization.required' => __('validation.report.en_report_organization_required'),
            'en_report_department.required' => __('validation.report.en_report_department_required'),
            'en_report_file_title.required' => __('validation.report.en_report_file_title_required'),
        ];

        return $message;
    }

    //Register
    public static function validateRegister($locale)
    {
        if ($locale == 'vn') {
            $rules = [
                'register_name' => 'required|string|regex:/^([^0-9]*)$/',
                'register_email' => 'required|email|unique:users,email',
                'register_phone' => 'required|numeric|digits_between:10,10',
                'register_nation' => 'required',
                'register_receiving_address' => 'required',
            ];
        } else {
            $rules = [
                'en_register_firstname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_register_lastname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_register_email' => 'required|email|unique:users,email',
                'en_register_phone' => 'required|numeric',
                'en_register_work_unit' => 'required',
            ];
        }
        return $rules;
    }

    public function validateRegisterFindOldData($locale)
    {
        if ($locale == 'en') {
            $rules = [
                'en_register_email' => 'required|email|unique:users,email',
            ];
        } else {
            $rules = [
                'register_phone' => 'required|numeric|digits_between:10,10',
            ];
        }

        return $rules;
    }

    public static function messageRegister()
    {
        $message = [
            'register_name.required' => __('validation.register.register_name_required'),
            'register_name.regex' => __('validation.register.register_name_regex'),
            'register_phone.required' => __('validation.register.register_phone_required'),
            'register_phone.numeric' => __('validation.register.register_phone_numeric'),
            'register_phone.digits_between' => __('validation.register.register_phone_digits_between'),
            'register_email.required' => __('validation.register.register_email_required'),
            'register_email.email' => __('validation.register.register_email_email'),
            'register_place_of_birth.required' => __('validation.register.register_place_of_birth_required'),
            'register_object_group.required' => __('validation.register.register_object_group_required'),
            'register_work_unit.required' => __('validation.register.register_work_unit_required'),
            'register_receiving_address.required' => __('validation.register.register_receiving_address_required'),
            'province_id.required' => __('validation.register.province_id_required'),
            'district_id.required' => __('validation.register.district_id_required'),
            'wards_id.required' => __('validation.register.wards_id_required'),
            'register_nation.required' => __('validation.register.register_nation_required'),
            'register_type.required' => __('validation.register.register_type_required'),
            'register_graduation_year.required' => __('validation.register.register_graduation_year_required'),
            'register_image.required' => __('validation.register.register_image_required'),
            'register_image_card.required' => __('validation.register.register_image_card_required'),
            'payment_image.required' => __('validation.register.payment_image_required'),
            'register_policy.accepted' => __('validation.register.register_policy_accepted'),
            'register_graduation_year.numeric' => __('validation.register.register_graduation_year_numeric'),
            'register_graduation_year.digits_between' => __('validation.register.register_graduation_year_between'),
            'province_id.numeric' => __('validation.register.province_id_required'),
            'district_id.numeric' => __('validation.register.district_id_required'),
            'wards_id.numeric' => __('validation.register.wards_id_required'),


            'en_register_firstname.required' => __('validation.register.en_register_firstname_required'),
            'en_register_firstname.regex' => __('validation.register.en_register_firstname_regex'),
            'en_register_lastname.required' => __('validation.register.en_register_lastname_required'),
            'en_register_lastname.regex' => __('validation.register.en_register_lastname_regex'),
            'en_register_email.required' => __('validation.register.en_register_email_required'),
            'en_register_email.email' => __('validation.register.en_register_email_email'),
            'en_register_phone.required' => __('validation.register.en_register_phone_required'),
            'en_register_phone.numeric' => __('validation.register.en_register_phone_numeric'),
            'en_register_work_unit.required' => __('validation.register.en_register_work_unit_required'),
        ];

        return $message;
    }

    //Blog Categories
    public function validateBlogCategory($action)
    {
        $rules = [
            'blog_category_name' => 'required',
            'blog_category_name_en' => 'required',
        ];
        return $rules;
    }

    public static function messageBlogCategory()
    {
        $message = [
            'blog_category_name.required' => __('validation.report.report_name_required'),
            'blog_category_image.required' => __('validation.report.report_image_card_required'),
            'blog_category_name_en.required' => __('validation.report.en_report_firstname_required'),
        ];

        return $message;
    }

    //Blog
    public function validateBlog($action)
    {
        $rules = [
            'blog_title' => 'required',
            'blog_title_en' => 'required',
            'blog_text' => 'required',
            'blog_text_en' => 'required',
        ];
        return $rules;
    }

    public static function messageBlog()
    {
        $message = [
            'blog_title.required' => __('validation.report.report_name_required'),
            'blog_text.required' => __('validation.report.report_image_card_required'),
            'blog_title_en.required' => __('validation.report.report_name_required'),
            'blog_text_en.required' => __('validation.report.report_image_card_required'),
        ];

        return $message;
    }
}
