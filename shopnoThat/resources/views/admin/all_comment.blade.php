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
      Quản lý bình luận
    </div>
    <div id="notify_comment"></div>
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
            <th>Duyệt</th>
            <th>Tên người bình luận</th>
            <th>Bình luận</th>
            <th>Ngày</th>
            <th>Sản phẩm</th>
            <th>Quản lý</th>
          </tr>
        </thead>
        <tbody>
        @foreach($comment as $key => $cmt)
          <tr>
            <td>
                @if($cmt->cmt_status == 1)
                    <input type="button" data-comment_status="0" data-comment_id="{{$cmt->cmt_id}}" id="{{$cmt->comment_pro_id}}" class="btn btn-primary btn-xs comment_status_btn" value="Duyệt">
                @else
                    <input type="button" data-comment_status="1" data-comment_id="{{$cmt->cmt_id}}" id="{{$cmt->comment_pro_id}}" class="btn btn-danger btn-xs comment_status_btn" value="Bỏ duyệt">
                @endif
            </td>
            <td>{{ $cmt->cmt_name }}</td>
            <td>{{ $cmt->comment }} <br>
            <style>
                ul.list_rep li{
                    list-style-type: decimal;
                    color: blue;
                    margin: 5px 40px;
                }
            </style>
                <ul class="list_rep">
                Trả lời:
                    @foreach($comment_rep as $key => $cmt_re)
                        @if($cmt_re->comment_parent_cmt == $cmt->cmt_id)
                            <li>{{$cmt_re->comment}}</li>
                        @endif
                    @endforeach
                </ul>
                @if($cmt->cmt_status == 0)
                    <textarea class="form-control reply_comment_{{$cmt->cmt_id}}" rows="3"></textarea> <br>
                    <button class="btn btn-default btn-xs btn-reply-cmt" data-comment_id="{{$cmt->cmt_id}}" data-product_id="{{$cmt->comment_pro_id}}">Trả lời</button>
                @endif
            </td>
            <td>{{ $cmt->cmt_date }}</td>
            <td><a href="{{URL::to('/chi-tiet-sp/'.$cmt->product->pro_slug)}}" target="_blank">{{ $cmt->product->pro_name}}</a></td>
            <td>
                <a onclick="return confirm('Bạn có chắc là muốn xóa bình luận này không?')" href="{{URL::to('/delete-cmt/'.$cmt->cmt_id)}}" class="active styling-edit" ui-toggle-class="">
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