<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Customer;

class CommentController extends Controller
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

    public function comment_submit(Request $request)
    {
        //$this->checkCustomer($request);
        $data = $request->all();
        $comment = new Comment();
        $comment->comment_name = $data['comment_name'];
        $comment->comment_email = $data['comment_email'];
        $comment->comment_message = $data['comment_message'];
        $comment->blog_id = $data['blog_id'];
        $comment->comment_status = 1;
        $comment->save();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function paginate_comment(Request $request){
        $limit= $request->paginate + 2;
        $Comment = Comment::where('blog_id', $request->blog_id);
        $totalComment = count($Comment->get());
        $getPaginateComment = $Comment->paginate($limit);
        $remaining = $totalComment - count($getPaginateComment);
        $html = view('pages.blog.comment.paginate_records')->with(compact('getPaginateComment','remaining','limit'))->render();
		return response()->json(array('success' => true, 'html'=>$html));
    }

    //Validation
    public function checkCustomer(Request $request)
    {
        $this->validate(
            $request,
            [
                'customer_first_name' => 'required',
                'customer_last_name' => 'required',
                'customer_email' => 'required|email|unique:users,email',
                'customer_phone' => 'required|numeric|digits_between:10,10',
                'customer_password' => 'required|min:8',
            ],
            [
                'customer_first_name.required' => 'Vui lòng điền họ và tên lót',
                'customer_last_name.required' => 'Vui lòng điền tên',
                'customer_email.required' => 'Vui lòng điền email',
                'customer_phone.required' => 'Vui lòng điền số điện thoại',
                'customer_password.required' => 'Vui lòng điền mật khẩu',
                'customer_email.email' => 'Vui lòng kiểm tra lại email',
                'customer_phone.digits_between' => 'Vui lòng kiểm tra lại số điện thoại',
                'customer_phone.numeric' => 'Vui lòng kiểm tra lại số điện thoại',
                'customer_password.min' => 'Mật khẩu phải lớn hơn 8 ký tự',

            ]
        );
    }

    public function checkCustomerAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'customer_first_name' => 'required',
                'customer_last_name' => 'required',
                'customer_phone' => 'required|numeric|digits_between:10,10',
                'customer_password' => 'required|min:8',
            ],
            [
                'customer_first_name.required' => 'Vui lòng điền họ và tên lót',
                'customer_last_name.required' => 'Vui lòng điền tên',
                'customer_password.required' => 'Vui lòng điền mật khẩu',
                'customer_phone.required' => 'Vui lòng điền số điện thoại',
                'customer_phone.digits_between' => 'Vui lòng kiểm tra lại số điện thoại',
                'customer_phone.numeric' => 'Vui lòng kiểm tra lại số điện thoại',
                'customer_password.min' => 'Mật khẩu phải lớn hơn 8 ký tự',

            ]
        );
    }
}
