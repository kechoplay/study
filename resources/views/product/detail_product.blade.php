@extends('home')
@section('content')
<!-- Navbar Start -->
<?php
    use Illuminate\Support\Facades\Session;
?>
<div class="container-fluid">
    <div class="row border-top px-xl-5 pt-4 pb-4 bg-white-smoke">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0 text-white">Danh mục sản phẩm</h6>
                <i class="fa fa-angle-down text-white"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                <div class="navbar-nav w-100 bg-white" style="height: 410px">
                    @foreach($selectCategory as $key => $c)
                    <div class="nav-item dropleft">
                        <a href="#" class="nav-link">{{$c->name_category}} <i class="fa fa-angle-right float-right mt-1"></i></a>
                        <div class="brand-hover dropdown-menu position-absolute bg-light border-0 rounded-5 w-100 m-0">
                            <h6 class="text-center">Hãng sản xuất</h4> 
                            <ul class="d-flex flex-wrap list-style-none pl-0" >
                                @foreach($selectBrand as $key => $b)
                                <li class="col-4">
                                    <a href="" class="dropdown-item text-muted text-12 text-center">{{$b->name_brand}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between bg-white-smoke" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="#" class="nav-item nav-link text-gray active">Trang chủ</a>
                        <a href="shop.html" class="nav-item nav-link text-gray">Shop</a>
                        <a href="detail.html" class="nav-item nav-link text-gray">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link text-gray dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                <a href="checkout.html" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link text-gray">Liên hệ</a>
                    </div>
                    <?php
                        $username = Session::get('username',null);
                        $imageCustomer = Session::get('imageCustomer',null);
                        $nameCustomer = Session::get('nameCustomer',null);
                        if(isset($username)){
                    ?>
                    <div class="ml-auto py-0 profile profile-hover dropdown">
                        <img class="w-37 h-25 img-profile profile-hover dropdown " src="{{url('images/customer/'.$imageCustomer)}}" alt="">
                        <div class="nav-item">
                            <div class="dropdown-menu d-none left-profile__63 top-profile__127 profile-info rounded-0 m-0">
                                <a href="#" class="dropdown-item text-muted f-14"><i class="fas fa-signature pr-1"></i>{{$nameCustomer}}</a>
                                <a href="cart.html" class="dropdown-item text-muted f-14"><i class="fas fa-envelope" style="padding-right: 7px !important;"></i>{{$username}}</a>
                                <a href="{{route('home.logout')}}" class="dropdown-item text-muted f-14"><i class="fas fa-right-from-bracket " style="padding-right: 7px !important;"></i>Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        }else{
                    ?>
                    <div class="navbar-nav ml-auto py-0">
                        <a href="{{route('home.loginForm')}}" class="nav-item nav-link text-gray">Đăng nhập</a>
                        <a href="{{route('home.loginForm')}}" class="nav-item nav-link text-gray">Đăng ký</a>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Chi tiết sản phẩm</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{route('home.page')}}">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">{{$selectProductId->name_category}}</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{url('images/product/'.$selectProductId->image_product)}}" alt="Image">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold">{{$selectProductId->name_product}}</h3>
            <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    @for($i = 1; $i <= round($selectAvgReview); $i++)
                        <span style="color:#ffcc00;">&#9733</span>
                    @endfor
                    @for($i = round($selectAvgReview); $i < 5; $i++)
                        <span style="color:#ccc;">&#9733</span>
                    @endfor
                </div>
                <small class="pt-1">({{$selectReview->count()}} reviews)</small>
            </div>
            <h3 class="font-weight-semi-bold mb-4">{{number_format($selectProductId->price_product,0,',','.')}} đ</h3>
            <p class="mb-4">{!!html_entity_decode($selectProductId->description_product,ENT_HTML5)!!}</p>
            <div class="d-flex mb-4">
                <p class="text-dark font-weight-medium mb-0 mr-3">Màu sắc:</p>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="color-1" name="color">
                    <label class="custom-control-label" for="color-1">Đen</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="color-2" name="color">
                    <label class="custom-control-label" for="color-2">Trắng</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="color-3" name="color">
                    <label class="custom-control-label" for="color-3">Đỏ</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="color-4" name="color">
                    <label class="custom-control-label" for="color-4">Xanh</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="color-5" name="color">
                    <label class="custom-control-label" for="color-5">Hồng</label>
                </div>
            </div>
            <form action="{{route('cart.addCart')}}" method="POST">
                @csrf
                <div class="d-flex align-items-center mb-4 pt-2">       
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <!-- <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus" >
                            <i class="fa fa-minus"></i>
                            </button>
                        </div> -->
                        <input type="hidden" name="id_product" value="{{$selectProductId->id}}">
                        <input type="number" min="0" max="{{$selectProductId->quantity_product}}" name="quantity_product" class="form-control bg-secondary text-center" value="1">
                        <!-- <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus" max>
                                <i class="fa fa-plus"></i>
                            </button>
                        </div> -->
                    </div>
                    <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Thêm vào giỏ hàng</button>
                </div>
            </form>
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Chia sẻ:</p>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô tả</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Thông tin</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Đánh giá sản phẩm</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-4">Hỏi và đáp</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Mô tả sản phẩm</h4>
                    {!!html_entity_decode($selectProductId->description_product,ENT_HTML5)!!}
                </div>
                <div class="tab-pane fade" id="tab-pane-2">
                    <h4 class="mb-3">Thông tin sản phẩm {{$selectProductId->name_product}}</h4>
                    {!!$selectProductId->content_product!!}
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4 f-16">{{$selectReview->count()}} đánh giá cho sản phẩm {{$selectProductId->name_product}}</h4>
                            <div class="media d-inline-block w-100 ">
                                @foreach($selectReview as $key => $review)
                                <div class="media-body pb-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="img-customer mr-2 d-flex justify-content-center">{{substr($review->name_review,0,1)}}</span>
                                            <span class="f-14">{{$review->name_review}}</h6>
                                        </div>
                                        <small>
                                            <i class="f-12">{{date('d/m/Y H:i',strtotime($review->created_at))}}</i>
                                        </small>
                                    </div>
                                    <div class="comment-customer">
                                        <div class="text-primary mb-2 d-flex align-items-center">
                                            <p class="f-12 pr-1" style="margin: 0; margin-bottom: 3px;">Đánh giá:</p> 
                                            <div>
                                                @for($i = 1; $i <= $review->rating; $i++)
                                                    <span style="color:#ffcc00;">&#9733</span>
                                                @endfor
                                                @for($i = $review->rating; $i < 5; $i++)
                                                    <span style="color:#ccc;">&#9733</span>
                                                @endfor
                                            </div> 
                                        </div>
                                        <span class="f-12"><span class="pr-1">Nhận xét:</span>{{$review->content_review}}.</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Để lại đánh giá</h4>
                            <form>
                                @csrf
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Đánh giá sao:</p>
                                    <div class="text-primary">
                                        @for($i = 1; $i <= 5; $i++)
                                            <li style="cursor: pointer; color: #ccc;"
                                                id="{{$selectProductId->id}}-{{$i}}" 
                                                data-index="{{$i}}" 
                                                data-product_id="{{$selectProductId->id}}" 
                                                data-rating="0"
                                                class="d-inline rating">&#9733
                                            </li>
                                        @endfor
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control review-id" id="name" value="{{$selectProductId->id}}">
                                </div>
                                <div class="form-group">
                                    <label for="name" class="f-14">Tên của bạn</label>
                                    <input type="text" class="form-control review-name f-12" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="message" class="f-14">Thông tin đánh giá</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control review-content f-12"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Gửi đánh giá" class="rounded btn btn-primary px-3 send-review">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-pane-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4 f-16">{{$selectComment->count()}} câu hỏi cho sản phẩm {{$selectProductId->name_product}}</h4>
                            <div class="media d-inline-block w-100 ">
                                @foreach($selectComment as $key => $comment)
                                @if($comment->name_comment !== "Quản trị viên")
                                <div class="media-body pb-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="img-customer mr-2 d-flex justify-content-center">{{substr($comment->name_comment,0,1)}}</span>
                                            <span class="f-14">{{$comment->name_comment}}</span>
                                        </div>
                                        <small>
                                            <i class="f-12">{{date('d/m/Y H:i',strtotime($comment->created_at))}}</i>
                                        </small>
                                    </div>
                                    <div class="comment-customer">
                                        <span class="f-12"><span class="pr-1">Câu hỏi:</span>{{$comment->comment}}</span>
                                    </div>
                                </div>
                                @endif
                                @foreach($selectComment as $key => $reply_comment)
                                @if($comment->id_comment == $reply_comment->reply_comment)
                                <div class="media-body pb-3 pl-4">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{asset('frontend/img/eshopper.png')}}" class="img-customer mr-2 d-flex justify-content-center">
                                            <span class="f-14">{{$reply_comment->name_comment}}</span>
                                            <span class="logo-qtv">QTV</span>
                                        </div>
                                        <small>
                                            <i class="f-12">{{date('d/m/Y H:i',strtotime($reply_comment->created_at))}}</i>
                                        </small>
                                    </div>
                                    <div class="comment-customer">
                                        <span class="f-12"><span class="pr-1">Câu hỏi:</span>{{$reply_comment->comment}}</span>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Hỏi và đáp</h4>
                            <form>
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" class="form-control product-id" id="name" value="{{$selectProductId->id}}">
                                </div>
                                <div class="form-group">
                                    <label for="name" class="f-14">Tên của bạn</label>
                                    <input type="text" class="form-control comment-name f-12" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="message" class="f-14">Câu hỏi của bạn</label>
                                    <textarea id="message" cols="30" rows="5" placeholder="Xin mời để lại câu hỏi, chúng tôi sẽ trả lời bạn trong khung giờ 9h-22h" class="f-12 form-control comment-content"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Gửi câu hỏi" class="rounded btn btn-primary px-3 send-comment">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Các sản phẩm cùng danh mục</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach($selectProductByCategory as $key => $productByCategory)
                <div class="card product-item border-0" style="width: 85%;">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid image-center py-3" src="{{url('images/product/'.$productByCategory->image_product)}}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{$productByCategory->name_product}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>{{number_format($productByCategory->price_product,0,',','.')}} đ</h6><h6 class="text-muted ml-2"><del>{{number_format($productByCategory->price_product,0,',','.')}} đ</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{route('product.detailProduct',['idProduct' => $productByCategory->id])}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Products End -->
@endsection