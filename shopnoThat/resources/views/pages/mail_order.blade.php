<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

</head>
<body>
    <div class="container" style="background: #FFFFCC; border-radius: 12px; padding: 15px;">
        <div class="col-md-12">
            <p style="text-align: center; color: #fff">Đây là email tự động. Quý khách không vui lòng trả lời email này.</p>
            <div class="row" style="background: cadetblue; padding: 15px">
                <div class="col-md-6" style="text-align : center; color: #fff; font-weight: bold; font-size: 30px">
                    <h4 style="margin: 0">CỬA HÀNG NỘI THẤT MIN:FULLHOUSE</h4>
                </div>

                <div class="col-md-6 logo" style="color: #fff">
                    <p>Chào bạn <strong style="color: #000; text-decoration: underline;">{{$shipping_array['cus_name']}}</strong></p>
                </div>

                <div class="col-md-12">
                    <p style="color: #fff; font-size: 17px;">Bạn hoặc một ai đó đã đã mua hàng tại của hàng của chúng tôi. Thông tin như sau:</p>
                    <h4 style="color: #000; text-transform: uppercase;">Thông tin đơn hàng</h4>
                    <p>Mã đơn hàng: <strong style="color: #fff; text-transform: uppercase;">{{$code['order_code']}}</strong></p>
                    <p>Mã khuyến mãi áp dụng: <strong style="color: #fff; text-transform: uppercase;">{{$code['coupon_code']}}</strong></p>
                    <p>Dịch vụ: <strong style="color: #fff; text-transform: uppercase;">Đặt hàng trực tuyến</strong></p>
                    <h4 style="color: #000; text-transform: uppercase;">Thông tin người nhận</h4>
                    <p>Email: 
                        @if($shipping_array['ship_email']=='')
                            Không có
                        @else
                            <span style="color: #fff">{{$shipping_array['ship_email']}}</span>
                        @endif
                    </p>
                    <p>Họ và tên người nhận: 
                        @if($shipping_array['ship_name']=='')
                            Không có
                        @else
                            <span style="color: #fff">{{$shipping_array['ship_name']}}</span>
                        @endif
                    </p>
                    <p>Địa chỉ người nhận: 
                        @if($shipping_array['ship_address']=='')
                            Không có
                        @else
                            <span style="color: #fff">{{$shipping_array['ship_address']}}</span>
                        @endif
                    </p>
                    <p>Số điện thoại: 
                        @if($shipping_array['ship_phone']=='')
                            Không có
                        @else
                            <span style="color: #fff">{{$shipping_array['ship_phone']}}</span>
                        @endif
                    </p>
                    <p>Ghi chú đơn hàng: 
                        @if($shipping_array['ship_notes']=='')
                            Không có
                        @else
                            <span style="color: #fff">{{$shipping_array['ship_notes']}}</span>
                        @endif
                    </p>
                    <p>Hình thức thanh toán: 
                        @if($shipping_array['ship_method']==0)
                            Chuyển khoản
                        @else
                            Tiền mặt
                        @endif
                    </p>
                    <p style="color:#fff">Nếu thông tin người nhận thiếu hoặc không chính xác, chúng tôi sẽ liên hệ với người đặt hàng để trao đổi thêm thông tin về đơn hàng đã đặt.</p>
                    <h4 style="color:#000; text-transform: uppercase;">Sản phẩm đã đặt</h4>
                    <table class="table table-striped" style="border:1px">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Giá tiền</td>
                                <td>Số lượng đặt</td>
                                <td>Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sub_total = 0;
                                $total1 = 0;
                            @endphp
                            @foreach($cart_array as $cart)
                                @php
                                    $sub_total = $cart['pro_price']*$cart['pro_qty'];
                                    $total1 +=$subtotal;
                                @endphp
                                <tr>
                                    <td>{{$cart['pro_name']}}</td>
                                    <td>{{number_format($cart['pro_price'],0,',','.')}} VNĐ</td>
                                    <td>{{$cart['pro_qty']}}</td>
                                    <td>{{number_format($sub_total,0,',','.')}} VNĐ</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right">Tổng tiền thanh toán: {{number_format($total1,0,',','.')}} VNĐ</td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <p style="color:#fff">Mọi thông tin chi tiết xin liên hệ đến hotline: 0392907386. Xin chân thành cảm ơn quý khách đã mua hàng tại cửa hàng.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>