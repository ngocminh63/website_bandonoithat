@extends('admin_layout')
@section('admin_content')
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
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê Banner
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
            <th>Tên slide</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Tình trạng</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_slider as $key => $slider)
          <tr>
            <td>{{ $slider->slider_name }}</td>
            <td><img src="public/uploads/slider/{{ $slider->slider_img }}" height="120" width="300"></td>
            <td>{{ $slider->slider_desc }}</td>
            <td><span class="text-ellipsis">
            <?php
               if($slider->slider_status==0){
                ?>
                <!-- bắt sự kiện ẩn hiển thị -->
                <a href="{{URL::to('/unactive-slider/'.$slider->slider_id)}}"><span class="fa-solid fa fa-toggle-on"></span></a>
                <?php
                 }else{
                ?>  
                 <a href="{{URL::to('/active-slider/'.$slider->slider_id)}}"><span class="fa-solid fa fa-toggle-off"></span></a>
                <?php
               }
              ?>
            </span></td>
            <td>
              <a onclick="return confirm('Bạn có chắc là muốn xóa ảnh slide này không?')" href="{{URL::to('/delete-slide/'.$slider->slider_id)}}" class="active styling-edit" ui-toggle-class="">
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