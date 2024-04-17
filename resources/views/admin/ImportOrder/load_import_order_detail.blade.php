@foreach ($getAllImportOrderDetail as $key => $import_order_detail)
    <div class="form-group detail-item">
        <div class="row">
            <div class="col-lg-2">
                <label for="exampleInputEmail1">
                    Danh mục: <span
                        class="name-title">{{ $import_order_detail->wareHouse->product->category->category_name }}</span>
                </label>
            </div>
            <div class="col-lg-3">
                <label for="exampleInputEmail1">
                    Loại sản phẩm: <span
                        class="name-title">{{ $import_order_detail->wareHouse->product->productType->product_type_name }}</span>
                </label>
            </div>
            <div class="col-lg-5">
                <label for="exampleInputEmail1">
                    Sản phẩm: <span
                        class="name-title">{{ $import_order_detail->wareHouse->product->product_name }}</span>
                </label>
            </div>
            <div class="col-lg-1">
                <label for="exampleInputEmail1">
                    Màu: <span class="name-title">{{ $import_order_detail->wareHouse->color->color_name }}</span>
                </label>
            </div>
            <div class="col-lg-1">
                <label for="exampleInputEmail1">
                    Size: <span class="name-title">{{ $import_order_detail->wareHouse->size->size_attribute }}</span>
                </label>
            </div>
        </div>
        <div class="section-input">
            <div class="section-quantity">
                <strong>Số lượng:</strong><input type="text" name="import_order_detail_quantity" class="form-control import_order_detail_quantity_{{$import_order_detail->import_order_detail_id}}"
                    value="{{ $import_order_detail->import_order_detail_quantity }}">
            </div>
            <div class="section-price">
                <strong>Giá tiền:</strong><input type="text" name="import_order_detail_price" class="form-control import_order_detail_price_{{$import_order_detail->import_order_detail_id}}"
                    value="{{ number_format($import_order_detail->import_order_detail_price, 0, ',', '.') }}">
            </div>
            <div class="section-sub-total">
                <strong>Tạm tính:</strong><input type="text" name="sub_total_import_order_detail"
                    class="form-control"
                    value="{{ number_format($import_order_detail->import_order_detail_price * $import_order_detail->import_order_detail_quantity, 0, ',', '.') }}">
            </div> &nbsp;
            <div class="section-delete">
                <button type="button" onclick="deleteImportOrderDetail({{ $import_order_detail->import_order_detail_id }})"
                    class="btn btn-danger ">X</button>
            </div>
            <div class="section-update">
                <button type="button" onclick="updateImportOrderDetail({{ $import_order_detail->import_order_detail_id }})"
                    class="btn btn-info ">Cập nhật</button>
            </div>
        </div>
    </div>
@endforeach
