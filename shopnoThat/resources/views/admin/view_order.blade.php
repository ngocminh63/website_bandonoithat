@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
<style>
	span.fa-solid.fa.fa-toggle-on {
    color: blue;
    font-size: 28px;
    }
    span.fa-solid.fa.fa-toggle-off {
    color: blue;
    font-size: 28px;
    }
    span.text-alert {
    color: blue;
    font-size: 17px;
    width: 100%;
    text-align: center;
    font-weight: bold;
    }
    a.active.styling-edit {
    font-size: 20px;
    }
</style>
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin khách hàng
    </div>
    <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message',null);
    }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th>Số điện thoại</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$customer->cus_name}}</td>
            <td>{{$customer->cus_email}}</td>
            <td>{{$customer->cus_phone}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
<div class="panel panel-default">
    <div class="panel-heading">
      Thông tin địa chỉ nhận hàng
    </div>
    <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message',null);
    }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$shipping->ship_name}}</td>
            <td>{{$shipping->ship_address}}</td>
            <td>{{$shipping->ship_phone}}</td>
            <td>{{$shipping->ship_notes}}</td>
            <td>
              @if($shipping->ship_method==0) Chuyển khoản 
              @else Tiền mặt @endif
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
<div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết đơn hàng
    </div>
    <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message',null);
    }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng kho còn</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
          </tr>
        </thead>
        <tbody>
          @php 
          $i = 0;
          $total = 0;
          @endphp
          @foreach($order_details as $key =>$deta)
          @php 
          $i++;
          $subtotal = $deta->pro_price*$deta->pro_sales_qty;
          $total+=$subtotal;
          @endphp
          <tr>
            <td><i>{{$i}}</i></td>
            <td>{{$deta->pro_name}}</td>
            <td>{{$deta->product->pro_qty}}</td>
            <td>
              <!-- Nếu có mã giảm -->
              @if($deta->pro_coupon!='Không có mã')            
                  {{$deta->pro_coupon}}
                @else 
                  Không có mã
                @endif
            </td>
            <td>
              <input type="number" min="1" {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$deta->pro_id}}" value="{{$deta->pro_sales_qty}}" name="product_sales_quantity">

              <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$deta->product_id}}" value="{{$deta->product->pro_qty}}">

              <input type="hidden" name="order_code" class="order_code" value="{{$deta->order_code}}">

              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$deta->pro_id}}">
              
            </td>
            <td>{{number_format($deta->pro_price ,0,',','.')}} VNĐ</td>
            <td>{{number_format($subtotal ,0,',','.')}} VNĐ</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="2">  
              @php 
                  $total_coupon = 0;                      
                @endphp
                @if($coupon_condition==1)
                    @php
                    $total_after_coupon = ($total*$coupon_number)/100;
                    echo 'Tổng giảm :'.number_format($total_after_coupon,0,',','.').'</br>';
                    $total_coupon = $total + $deta->pro_feeship - $total_after_coupon ;
                    @endphp
                @else 
                    @php
                    echo 'Tổng giảm :'.number_format($coupon_number,0,',','.').'VNĐ'.'</br>';
                    $total_coupon = $total + $deta->pro_fee - $coupon_number ;

                    @endphp
                @endif

                Phí ship : {{number_format($deta->pro_fee,0,',','.')}} VNĐ</br> 
              Thanh toán: {{number_format($total_coupon,0,',','.')}} VNĐ
            </td>
          </tr>
          <tr>
            <td colspan="6">
              @foreach($order as $key => $or)
                @if($or->order_status==1)
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>
                @elseif($or->order_status==2)
                <form>
                  @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}" selected value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>

                @else
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}"  value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" selected value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>

                @endif
                @endforeach


            </td>
          </tr>
        </tbody>
      </table>
      <!-- target="_blank" khi ấn in đon hàng sẽ sang tag mới -->
      <a target="_blank" href="{{url('/print-order/'.$deta->order_code)}}">In đơn hàng</a>
    </div>
  </div>
</div>
@endsection