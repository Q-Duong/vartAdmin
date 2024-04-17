<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Staff;

class StaffController extends Controller
{
    //Admin
    public function add_staff(){
    	return view('admin.Staff.add_staff');
    }
    
    public function list_staff(){
        $all_staff = Staff::orderBy('staff_id','DESC')->get();
    	return view('admin.Staff.list_staff')->with(compact('all_staff'));
    }

    public function save_staff(Request $request){
        $this->checkStaff($request);
    	$data = $request->all();
        $staff = new Staff();
    	$staff->staff_name = $data['staff_name'];
        $staff->staff_phone = $data['staff_phone'];
        $staff->staff_gender = $data['staff_gender'];
        $staff->staff_birthday = $data['staff_birthday'];
        $staff->staff_role = $data['staff_role'];
        $staff->save();
    	return Redirect()->back()->with('success','Thêm nhân viên thành công');
    }
    
    public function edit_staff($staff_id){
        $staff = Staff::find($staff_id);
        return view('admin.Staff.edit_staff')->with(compact('staff'));
    }
    public function update_staff(Request $request,$staff_id){
        $this->checkStaff($request);
        $data = $request->all();
        $staff = Staff::find($staff_id);
        $staff->staff_name = $data['staff_name'];
        $staff->staff_phone = $data['staff_phone'];
        $staff->staff_gender = $data['staff_gender'];
        $staff->staff_birthday = $data['staff_birthday'];
        $staff->staff_role = $data['staff_role'];
        $staff->save();
    	return Redirect::to('admin/staff/list')->with('success','Cập nhật thông tin nhân viên thành công');
    }
    
    public function delete_staff($staff_id){
        $staff = Staff::find($staff_id);
        $staff->delete();
        return Redirect()->back()->with('success','Xóa nhân viên thành công');
    }
    //End Admin

    public function formatDate($date){
		$format=explode("/",$date);
		$day = array_shift($format);
        $year = array_pop($format);
        $month = implode(" ", $format);
		$dateFormat= $year."-".$month."-".$day;
    	return $dateFormat;
    }
    //Validation
    public function checkStaff(Request $request){
        $this-> validate($request,
        [
            'staff_name' => 'required',
            'staff_phone' => 'required|numeric|digits_between:10,10',
            'staff_gender' => 'required',
            'staff_birthday' => 'required',
            'staff_role' => 'required',
        ],
        [
            'staff_name.required' =>'Vui lòng điền họ và tên',
            'staff_gender.required' =>'Vui lòng chọn giới tính',
            'staff_phone.required' =>'Vui lòng điền số điện thoại',
            'staff_birthday.required' =>'Vui lòng chọn ngày sinh',
            'staff_phone.digits_between' =>'Vui lòng kiểm tra lại số điện thoại',
            'staff_phone.numeric' =>'Vui lòng kiểm tra lại số điện thoại',
            'staff_role.required' =>'Vui lòng chọn vai trò nhân viên',
            
        ]);
    }
}
