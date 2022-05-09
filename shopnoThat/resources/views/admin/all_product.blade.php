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
      Liệt kê sản phẩm
    </div>
    <!-- <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div> -->
    <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message',null);
    }
    ?>
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>Tên sản phẩm</th>
            <th>Thư viện ảnh</th>
            <th>Số lượng còn</th>
            <th>Đã bán</th>
            <!-- <th>Slug</th>
            <th>Mô tả</th> -->
            <th>Ảnh sản phẩm</th>
            <th>Danh mục sản phẩm</th>
            <th>Thương hiệu</th>
            <th>Phòng</th>
            <th>Giá bán</th>
            <th>Giá nhập</th>
            <!-- <th>Kích thước</th>
            <th>Màu sắc</th>
            <th>Chất liệu</th> -->
            <th>Trạng thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_product as $key => $pro)
          <tr>
            <td>{{ $pro->pro_name }}</td>
            <td><a href="{{URL::to('/add-gallery/'.$pro->pro_id)}}">Thêm thư viện ảnh</a></td>
            <td>{{ $pro->pro_qty }}</td>
            <td>{{ $pro->pro_sold }}</td>
            <!-- <td>{{ $pro->pro_slug }}</td>
            <td>{{ $pro->pro_desc }}</td> -->
            <td><img src="public/uploads/product/{{ $pro->pro_img }}" height="100" width="100"></td>
            <td>{{ $pro->cate_name }}</td>
            <td>{{ $pro->brand_name}}</td>
            <td>{{ $pro->room_name}}</td>
            <td>{{ $pro->pro_price }}</td>
            <td>{{ $pro->pro_cost }}</td>
            <!-- <td>{{ $pro->pro_size }}</td>
            <td>{{ $pro->pro_color }}</td>
            <td>{{ $pro->pro_material }}</td> -->
            <td><span class="text-ellipsis">
            <?php
               if($pro->pro_status==0){
                ?>
                <!-- bắt sự kiện ẩn hiển thị -->
                <a href="{{URL::to('/unactive-product/'.$pro->pro_id)}}"><span class="fa-solid fa fa-toggle-on"></span></a>
                <?php
                 }else{
                ?>  
                 <a href="{{URL::to('/active-product/'.$pro->pro_id)}}"><span class="fa-solid fa fa-toggle-off"></span></a>
                <?php
               }
              ?>
            </span></td>
            <td>
            <a href="{{URL::to('/edit-product/'.$pro->pro_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')" href="{{URL::to('/delete-product/'.$pro->pro_id)}}" class="active styling-edit" ui-toggle-class="">
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