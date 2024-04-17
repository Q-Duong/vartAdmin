@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm đơn nhập hàng
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="{{ URL::to('/list-import') }}" class="btn btn-info edit">Quản lý</a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ route('save-import-order') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="status" value="0">
                                <label for="exampleInputPassword1">Nhân viên nhập hàng</label>
                                <input type="text" name="user_id" class="form-control" readonly
                                    value="{{ Auth::user()->profile->profile_firstname }} {{ Auth::user()->profile->profile_lastname }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tổng tiền đơn hàng</label>
                                <input type="text" readonly value="" name="import_order_total" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-info">Thêm đơn nhập hàng</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
