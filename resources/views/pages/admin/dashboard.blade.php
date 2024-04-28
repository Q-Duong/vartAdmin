@extends('layouts.default_auth')
@section('content')
    <div class="market-updates">
        <div class="col-md-3 market-update-gd">
            <a href="{{ URL::to('/list-customer') }}">
                <div class="market-update-block clr-block-1">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Khách hàng</h4>
                        <h3></h3>
                        <p>Tổng số khách hàng đã đăng ký.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 market-update-gd">
            <a href="{{ URL::to('/all-product') }}">
                <div class="market-update-block clr-block-3">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-usd"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Dịch vụ</h4>
                        <h3></h3>
                        <p>Tổng số dịch vụ đã kinh doanh.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 market-update-gd">
            <a href="">
                <div class="market-update-block clr-block-4">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Đơn hàng</h4>
                        <h3></h3>
                        <p>Tổng số đơn hàng đã nhận.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 market-update-gd">
            <a href="{{ URL::to('/list-post') }}">
                <div class="market-update-block clr-block-2">
                    <div class="col-md-4 market-update-right">
                        <i class="fab fa-blogger-b"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Bài viết</h4>
                        <h3>{{ $blog }}</h3>
                        <p>Tổng bài viết có trên web.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </a>
        </div>
        <div class="clearfix"> </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('backend/js/chart/raphael-min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/chart/morris.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/chart/chart.min.js') }}" defer ></script>
@endpush
