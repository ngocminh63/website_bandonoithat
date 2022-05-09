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
      Liệt kê thương hiệu sản phẩm
    </div>
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
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_brand_product as $key => $brand)
          <tr>
            <td>{{ $brand->brand_name }}</td>
            <td>{{ $brand->brand_slug }}</td>
            <td>{{ $brand->brand_desc }}</td>
            <td><span class="text-ellipsis">
            <?php
               if($brand->brand_status==0){
                ?>
                <!-- bắt sự kiện ẩn hiển thị -->
                <a href="{{URL::to('/unactive-brand-product/'.$brand->brand_id)}}"><span class="fa-solid fa fa-toggle-on"></span></a>
                <?php
                 }else{
                ?>  
                 <a href="{{URL::to('/active-brand-product/'.$brand->brand_id)}}"><span class="fa-solid fa fa-toggle-off"></span></a>
                <?php
               }
              ?>
            </span></td>
            <td>
            <a href="{{URL::to('/edit-brand-product/'.$brand->brand_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa thương hiệu này không?')" href="{{URL::to('/delete-brand-product/'.$brand->brand_id)}}" class="active styling-edit" ui-toggle-class="">
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