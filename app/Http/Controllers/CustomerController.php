<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerOptions;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //Admin
    public function add_customer_admin()
    {
        return view('admin.Customer.add_customer');
    }

    public function list_customer()
    {
        $list_customer = Customer::orderBy('customer_id', 'DESC')->get();
        return view('admin.Customer.list_customer')->with(compact('list_customer'));
    }

    public function save_customer(Request $request)
    {
        //$this->checkCustomer($request);
        $data = $request->all();
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_address = $data['customer_address'];
        $customer->customer_note = '';
        $customer->save();

        return Redirect()->back()->with('success', 'Thêm khách hàng thành công');
    }

    public function schedule_submit(Request $request)
    {
        if ($request->customer_type == 2) {
            $validator = Validator::make($request->all(), $this->validateCustomer(), $this->messageCustomer());
            if ($validator->fails()) {
                return response()->json(array('errors' => true, 'validator' => $validator->errors()));
            }
            $data = $request->all();
            $customer = new Customer();
            $customer->customer_name = $data['customer_name'];
            $customer->customer_phone = $data['customer_phone'];
            $customer->customer_email = $data['customer_email'];
            $customer->customer_message = $data['customer_message'];
            $customer->customer_type = $data['customer_type'];
            $customer->save();
            $customer_options = new CustomerOptions();
            $customer_options->customer_id = $customer->customer_id;
            $customer_options->types_of_tour = $data['types_of_tour'];
            $customer_options->agency = $data['agency'];
            $customer_options->save();
        } else {
            $validator = Validator::make($request->all(), $this->validateCustomer(), $this->messageCustomer());
            if ($validator->fails()) {
                return response()->json(array('errors' => true, 'validator' => $validator->errors()));
            }
            $data = $request->all();
            $customer = new Customer();
            $customer->customer_name = $data['customer_name'];
            $customer->customer_phone = $data['customer_phone'];
            $customer->customer_email = $data['customer_email'];
            $customer->customer_message = $data['customer_message'];
            $customer->customer_type = $data['customer_type'];
            $customer->save();
            $customer_options = new CustomerOptions();
            $customer_options->courses_id = $data['courses_id'];
            $customer_options->start_date = $data['start_date'];
            $customer_options->save();
        }
        return response()->json(array('success' => true));
    }

    //Validation

    public static function validateCustomer()
    {
        $rules = [
            'customer_name' => 'required',
            'customer_phone' => 'required|numeric|digits_between:10,10',
            'customer_email' => 'required|email|unique:users,email',
        ];
        return $rules;
    }
    public static function messageCustomer()
    {
        $message = [
            'customer_name.required' => 'Vui lòng điền họ và tên lót',
            'customer_email.required' => 'Vui lòng điền email',
            'customer_phone.required' => 'Vui lòng điền số điện thoại',
            'customer_email.email' => 'Vui lòng kiểm tra lại email',
            'customer_phone.digits_between' => 'Vui lòng kiểm tra lại số điện thoại',
            'customer_phone.numeric' => 'Vui lòng kiểm tra lại số điện thoại',
        ];
        return $message;
    }
}
