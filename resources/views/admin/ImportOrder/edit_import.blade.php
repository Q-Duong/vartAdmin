@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật đơn nhập hàng
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="{{ URL::to('/list-import') }}" class="btn btn-info edit">Quản lý</a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ route('update-import-order', $import_order ->import_order_id) }}" method="post">
                            @csrf
                            <input type="hidden" name="import_order_id" value="{{ $import_order ->import_order_id }}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nhân viên nhập hàng</label>
                                <input type="text" class="form-control " readonly name="user_id" value="{{ $import_order ->user->profile->profile_firstname }}&nbsp;{{ $import_order ->user->profile->profile_lastname }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tổng tiền đơn hàng</label>
                                <input type="text" readonly
                                    value="{{$import_order ->import_order_total}}"
                                    name="import_order_total" class="form-control import_order_total_edit">
                            </div>
                            <button type="submit" class="btn btn-info ">Lưu đơn nhập hàng</button>
                        </form>
                    </div>
                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">
                    Chi tiết đơn nhập
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="javascript:void0();" class="btn btn-info edit add-import-order-detail-btn">Thêm
                            chi
                            tiết đơn nhập</a>
                    </span>
                </header>
                <div class="panel-body list-order-detail">
                    @foreach ($getAllImportOrderDetail as $key => $import_order_detail)
                        <div class="form-group detail-item">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label for="exampleInputEmail1">
                                        Danh mục: <span
                                            class="name-title">{{ $import_order_detail ->wareHouse ->product ->category ->category_name }}</span>
                                    </label>
                                </div>
                                <div class="col-lg-3">
                                    <label for="exampleInputEmail1">
                                        Loại sản phẩm: <span
                                            class="name-title">{{ $import_order_detail ->wareHouse ->product ->productType ->product_type_name }}</span>
                                    </label>
                                </div>
                                <div class="col-lg-5">
                                    <label for="exampleInputEmail1">
                                        Sản phẩm: <span
                                            class="name-title">{{ $import_order_detail ->wareHouse ->product ->product_name }}</span>
                                    </label>
                                </div>
                                <div class="col-lg-1">
                                    <label for="exampleInputEmail1">
                                        Màu: <span
                                            class="name-title">{{ $import_order_detail ->wareHouse ->color ->color_name }}</span>
                                    </label>
                                </div>
                                <div class="col-lg-1">
                                    <label for="exampleInputEmail1">
                                        Size: <span
                                            class="name-title">{{ $import_order_detail ->wareHouse ->size ->size_attribute }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="section-input">
                                <div class="section-quantity">
                                    <strong>Số lượng:</strong><input type="text" name="import_order_detail_quantity"
                                        class="form-control"
                                        value="{{ $import_order_detail ->import_order_detail_quantity }}">
                                </div>
                                <div class="section-price">
                                    <strong>Giá tiền:</strong><input type="text" name="import_order_detail_price"
                                        class="form-control"
                                        value="{{ number_format($import_order_detail ->import_order_detail_price, 0, ',', '.') }}">
                                </div>
                                <div class="section-sub-total">
                                    <strong>Tạm tính:</strong><input type="text" name="sub_total_import_order_detail"
                                        class="form-control"
                                        value="{{ number_format($import_order_detail ->import_order_detail_price * $import_order_detail ->import_order_detail_quantity, 0, ',', '.') }}">
                                </div> &nbsp;
                                <div>
                                    <button type="button" onclick="deleteImportOrderDetail({{ $import_order_detail->import_order_id }})"
                                        class="btn btn-info ">X</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            {{-- Review Popup --}}
            <div class="popup-model-review">
                <div class="overlay-model-review"></div>
                <div class="model-review-content">
                    <div class="model-review-close">
                        <p class="model-review-tile">Thêm chi tiết đơn nhập</p>
                        <p class="close-model"><i class="fas fa-times"></i></p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group section-category">
                            <label>Danh mục sản phẩm</label>
                            <select name="category_id" class="form-control m-bot15 choose_category">
                                <option value="">--Chọn Danh Mục--</option>
                                @foreach ($getAllCategory as $key => $category)
                                    <option value="{{ $category -> category_id }}">
                                        {{ $category ->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại sản phẩm</label>
                            <select name="product_type_id" class="form-control m-bot15 choose_product_type">
                                <option value="">--Chọn Loại Sản Phẩm--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <select name="product_id" class="form-control m-bot15 choose_product">
                                <option value="">--Chọn Sản Phẩm--</option>
                            </select>
                        </div>
                        <form id="import-order-detail">
                            <div class="form-group">
                                <label>Kho hàng</label>
                                <select name="ware_house_id"
                                    class="form-control m-bot15 choose_ware_house ware_house_id">
                                    <option value="">--Chọn Sản Phẩm Trong Kho--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number" value="1" min="1"
                                    name="import_order_detail_quantity" class="form-control import_order_detail_quantity">
                            </div>
                            <div class="form-group">
                                <label>Đơn giá</label>
                                <input type="text" name="import_order_detail_price" class="form-control import_order_detail_price">
                            </div>
                            <button type="button" name="send-rating"
                                class="btn btn-info send-import-order-detail">
                                Thêm chi tiết sản phẩm
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Review Popup -->
        </div>
    </div>
@endsection
