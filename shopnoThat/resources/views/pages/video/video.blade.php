@extends('welcome')
@section('content')

<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Phong cách thiết kế</h2>
						@foreach($all_video as $key => $vi)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products single-products-video">
										<div class="productinfo text-center">
											<form>
												@csrf
												<!-- gửi dữ liệu sang welcome từ hidden -->
												

												<a href="">
													<img src="{{asset('public/uploads/video/'.$vi->video_img)}}" alt="{{$vi->video_title}}" height="200" width="100"/>
													<h2>{{$vi->video_title}}</h2>
													<p>{{$vi->video_desc}}</p>
												</a>
												<button type="button" class="btn btn-primary watch-video" data-toggle="modal" data-target="#modal_video" id="{{$vi->video_id}}">
													Xem video
												</button>
											</form>
											
										</div>
								</div>
							</div>	
						</div>	
						@endforeach
					</div><!--features_items-->
					<ul class="pagination pagination-sm m-t-none m-b-none">
						<span>{!!$all_video->links("pagination::bootstrap-4")!!}</span>
					</ul>
					<!-- Modal xem video-->
					<div class="modal fade" id="modal_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="video_title"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div id="video_desc"></div>
								<div id="video_link"></div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng video</button>
							</div>
							</div>
						</div>
					</div>

@endsection
