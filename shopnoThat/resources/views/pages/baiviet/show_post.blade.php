@extends('welcome')
@section('content')

<div class="features_items"><!--features_items-->
						@foreach($catepos as $key => $cat)
							<h2 class="title text-center">{{$cat->cate_post_name}} </h2>
						@endforeach
							<div class="product-image-wrapper">
								@foreach($post as $key => $p)
								<div class="single-products" style="margin:10px 0;">
										<div class="productinfo text-center">
											@csrf
											<a href="{{URL::to('/bai-viet/'.$p->post_slug)}}">
												<img style="float:left; width: 200px;; padding: 5px;" src="{{URL::to('public/uploads/post/'.$p->post_img)}}" height="200" width="300"  alt="{{$p->post_id}}"/>
												<h2 style="color:#000; padding:5px"><b>{{$p->post_title}}</b></h2>
												<p>{!!$p->post_desc!!}</p>
											</a>
										</div>
										<div class="text-right">
											<a href="{{URL::to('/bai-viet/'.$p->post_slug)}}" class="btn btn-warning btn-sm">Xem bài viết</a>
										</div>
								</div>
							</div>	
						</div>	
						@endforeach
					</div><!--features_items-->
                    <ul class="pagination pagination-sm m-t-none m-b-none">
						<span>{!!$post->links("pagination::bootstrap-4")!!}</span>
					</ul>

@endsection
