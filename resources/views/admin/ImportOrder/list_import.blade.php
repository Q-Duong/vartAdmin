@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê phiếu nhập hàng
            </div>
            <div class="table-responsive">

                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th>Mã đơn nhập</th>
                            <th>Nhân viên nhập đơn</th>
                            <th>Tổng tiền đơn nhập</th>
                            <th>Ngày tạo đơn</th>
                            <th style="width:100px;">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getAllListImport as $key => $import_order)
                            <tr>
                                <td>{{ $import_order ->import_order_id }}</td>
                                <td>{{ $import_order ->user ->profile ->profile_firstname }} {{ $import_order ->user ->profile ->profile_lastname }}</td>
                                <td>{{ number_format($import_order ->import_order_total, 0, ',', '.') }}₫</td>
                                <td>{{ $import_order ->created_at }}</td>
                                <td>
                                    <a href="{{ route('edit-import-order', $import_order ->import_order_id) }}" class="active style-edit"
                                        ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc muốn xóa phiếu nhập?')"
                                        href="{{ route('delete-import-order', $import_order ->import_order_id) }}"
                                        class="active style-edit" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
