<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'The :attribute must not be greater than :max characters.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

    'report' => [
        'report_name_required' => 'Nhập họ và tên',
        'report_name_regex' => 'Nhập họ và tên đúng định dạng.',
        'report_phone_required' => 'Nhập số điện thoại',
        'report_phone_numeric' => 'Nhập số điện thoại hợp lệ',
        'report_phone_digits_between' => 'Nhập số điện thoại hợp lệ',
        'report_email_required' => 'Nhập Email',
        'report_email_email' => 'Nhập Email hợp lệ',
        'report_place_of_birth_required' => 'Chọn nơi sinh',
        'report_work_unit_required' => 'Nhập đơn vị công tác',
        'report_graduation_year_required' => 'Nhập năm tốt nghiệp',
        'report_image_required' => 'Thêm ảnh chụp bằng chuyên môn cao nhất',
        'report_image_card_required' => 'Thêm ảnh chụp thẻ sinh viên',
        'report_file_required' => 'Thêm tóm tắt (Abstract), Bài báo cáo khoa học',
        'report_policy_accepted' => 'Vui lòng bấm xác nhận',
        'report_graduation_year_numeric' => 'Nhập năm tốt nghiệp hợp lệ',
        'report_graduation_year_digits_between' => 'Nhập năm tốt nghiệp hợp lệ',
        'report_image_file' => 'Thêm ảnh đúng định dạng',
        'report_image_image' => 'Thêm ảnh đúng định dạng',
        'report_image_card_file' => 'Thêm ảnh đúng định dạng',
        'report_image_card_image' => 'Thêm ảnh đúng định dạng',
        'report_file_file' => 'Thêm Bài giảng, Bài báo cáo khoa học đúng định dạng',
        

        'en_report_firstname_required' => 'Please enter your first name.',
        'en_report_firstname_regex' => 'Please enter a valid first name.',
        'en_report_lastname_required' => 'Please enter your last name.',
        'en_report_lastname_regex' => 'Please enter a valid last name.',
        'en_report_email_required' => 'Please enter your email.',
        'en_report_email_email' => 'Please enter a valid email.',
        'en_report_organization_required' => 'Please enter your organization.',
        'en_report_department_required' => 'Please enter your department.',
        'en_report_file_title_required' => 'Please enter your title of abstract, paper.',
    ],

    'register' => [
        'register_name_required' => 'Nhập họ và tên',
        'register_phone_required' => 'Nhập số điện thoại',
        'register_email_required' => 'Nhập Email',
        'register_object_group_required' => 'Nhập nhóm đối tượng',
        'register_place_of_birth_required' => 'Chọn nơi sinh',
        'register_work_unit_required' => 'Nhập đơn vị công tác',
        'register_receiving_address_required' => 'Nhập địa chỉ nhận giấy chứng nhận',
        'register_nation_required' => 'Nhập dân tộc',
        'register_type_required' => 'Nhập loại đăng ký tham gia',
        'register_graduation_year_required' => 'Nhập năm tốt nghiệp',
        'register_image_required' => 'Thêm ảnh chụp bằng chuyên môn cao nhất',
        'register_image_card_required' => 'Thêm ảnh chụp thẻ sinh viên',
        'payment_image_required' => 'Thêm ảnh chụp thông tin giao dịch',
        'register_policy_accepted' => 'Vui lòng bấm xác nhận',
        'register_phone_numeric' => 'Nhập số điện thoại hợp lệ',
        'register_phone_digits_between' => 'Nhập số điện thoại hợp lệ',
        'register_email_email' => 'Nhập Email hợp lệ',
        'register_graduation_year_numeric' => 'Nhập năm tốt nghiệp hợp lệ',
        'register_graduation_year_digits_between' => 'Nhập năm tốt nghiệp hợp lệ',
        'register_image_file' => 'Thêm ảnh đúng định dạng',
        'register_image_image' => 'Thêm ảnh đúng định dạng',
        'register_image_card_file' => 'Thêm ảnh đúng định dạng',
        'register_image_card_image' => 'Thêm ảnh đúng định dạng',
        'payment_image_image' => 'Thêm ảnh đúng định dạng',
        'payment_image_required' => 'Thêm ảnh chụp thông tin giao dịch',
        'province_id_required' => 'Chọn tỉnh / thành phố ',
        'district_id_required' => 'Chọn quận / huyện',
        'wards_id_required' => 'Chọn phường / xã',
        'errors_exists_phone_message' => 'Số điện thoại của bạn đã được đăng ký hội nghị, vui lòng liên hệ ban tổ chức để được hướng dẫn.',
        'errors_exists_email_message' => 'Email của bạn đã được đăng ký hội nghị, vui lòng liên hệ ban tổ chức để được hướng dẫn.',
        'errors_exists_both_message' => 'Số điện thoại và Email của bạn đã được đăng ký hội nghị, vui lòng liên hệ ban tổ chức để được hướng dẫn.',
        'errors_exists_phone' => 'Số điện thoại của bạn đã được đăng ký.',
        'errors_exists_email' => 'Email của bạn đã được đăng ký.',
        'register_name_regex' => 'Nhập họ và tên đúng định dạng.',
        'register_code_required' => 'Vui lòng nhập mã code.',

        'en_register_firstname_required' => 'Please enter your first name.',
        'en_register_firstname_regex' => 'Please enter a valid first name.',
        'en_register_lastname_required' => 'Please enter your last name.',
        'en_register_lastname_regex' => 'Please enter a valid last name.',
        'en_register_phone_required' => 'Please enter your phone number.',
        'en_register_phone_numeric' => 'Please enter a valid phone number.',
        'en_register_email_required' => 'Please enter your email.',
        'en_register_email_email' => 'Please enter a valid email.',
        'en_register_email_exists' => 'Email has been registered for the conference',
        'en_register_work_unit_required' => ' Please enter your workplace.',
    ],
];
