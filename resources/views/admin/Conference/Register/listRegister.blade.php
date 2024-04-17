@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel-heading">
            Conference Registration List
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Học vị</th>
                        <th>Họ và tên</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Thánh sinh</th>
                        <th>Năm sinh</th>
                        <th>Đơn vị</th>
                        <th>Nơi sinh</th>
                        <th>Dân tộc</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Nhóm đối tượng</th>
                        <th>Loại đăng ký tham gia</th>
                        <th>Chi phí</th>
                        <th>Địa chỉ nhận giấy chứng nhận</th>
                        <th>Thời gian đăng ký</th>
                        <th>Năm tốt nghiệp trên bằng</th>
                        <th>Ảnh bằng đại học</th>
                        <th>Ảnh thẻ sinh viên</th>
                        <th>Ảnh chuyển khoản</th>
                        <th>Trạng thái</th>
                        <th style="width:60px;">Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllConferenceRegister as $key => $register)
                        <tr>
                            <td>{{ $register->register_id }}</td>
                            <td>{{ $register->register_code }}</td>
                            <td>{{ $register->register_degree }}</td>
                            <td>{{ $register->register_name }}</td>
                            <td>{{ $register->register_gender == 0 ? 'Nam' : 'Nữ' }}</td>
                            <td>{{ $register->register_date }}</td>
                            <td>{{ $register->register_month }}</td>
                            <td>{{ $register->register_year }}</td>
                            <td>{{ $register->register_work_unit }}</td>
                            <td>{{ $register->register_place_of_birth }}</td>
                            <td>{{ $register->register_nation }}</td>
                            <td>{{ $register->register_email }}</td>
                            <td>{{ $register->register_phone }}</td>
                            <td>{{ $register->register_object_group }}</td>
                            <td>{{ $register->conference_fee_title }}</td>
                            <td>{{ $register->payment_price < 1000 ? '$' . number_format($register->payment_price, 2) : number_format($register->payment_price, 0, ',', '.') . '₫' }}
                            </td>
                            <td>{{ $register->register_receiving_address }}</td>
                            <td>{{ \Carbon\Carbon::parse($register->created_at)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $register->register_graduation_year }}</td>
                            <td>
                                @if ($register->register_image)
                                    <a href="https://drive.google.com/file/d/{{ $register->register_image }}/view"
                                        target="_blank">
                                        Link
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if ($register->register_image_card)
                                    <a href="https://drive.google.com/file/d/{{ $register->register_image_card }}/view"
                                        target="_blank">
                                        Link
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if ($register->payment_image)
                                    <a href="https://drive.google.com/file/d/{{ $register->payment_image }}/view"
                                        target="_blank">
                                        Link
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if ($register->payment_status == 1)
                                    <span style="color: #27c24c;">Chờ kiểm tra</span>
                                @elseif ($register->payment_status == 2)
                                    <span style="color: #FCB322;">Đã thanh toán và chờ kiểm tra</span>
                                @elseif ($register->payment_status == 3)
                                    <span style="color: #c037df;">Chờ bổ sung</span>
                                @elseif ($register->payment_status == 4)
                                    <span style="color: #0071e3;">Đã kiểm tra và gửi mail</span>
                                @endif
                            </td>
                            <td class="management">
                                <a href="{{ Route('editConferenceRegister', $register->register_id) }}"
                                    class="management-btn" ui-toggle-class=""><i
                                        class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ Route('deleteConferenceRegister', $register->register_id) }}"
                                    method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="management-btn button-submit"><i
                                            class="fa fa-times text-danger text"></i></button>
                                </form>
                                <form action="{{ Route('sendMailReply', $register->register_id) }}" method="POST">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $register->register_email }}">
                                    <input type="hidden" name="type" value="register">
                                    <button type="submit" class="management-btn button-submit"><i class="far fa-envelope"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $getAllConferenceRegister->links('pagination::bootstrap-4') }}
        <div class="export-excel">
            <form action="{{ route('export-excel') }}" method="POST">
                @csrf
                <input type="hidden" name="conference_id" value="{{ $conference_id }}">
                <input type="hidden" name="export_type" value="vnrt">
                <div class="col-md-3">
                    <button type="submit" class="primary-btn-filter">Export Excel</button>
                </div>
            </form>
        </div>
    </div>
@endsection