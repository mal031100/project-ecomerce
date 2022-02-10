<div class="wrap-show-advance-info-box style-1">
    <h3 class="title-box">Product Categories</h3>
    <div class="wrap-top-banner">
        <a href="#" class="link-banner banner-effect-2">
            <figure><img src="{{ asset('assets/images/516946')}}.jpg" width="1170" height="240" alt=""></figure>
        </a>
    </div>
    <div class="wrap-products">
        <div class="wrap-product-tab tab-style-1">
            <div class="tab-control">
                <a href="#fashion_1a" class="tab-control-item active">TIVI</a>
                <a href="#fashion_1b" class="tab-control-item">Tủ Lạnh</a>
                <a href="#fashion_1c" class="tab-control-item">Máy giặt</a>
                <a href="#fashion_1d" class="tab-control-item">Tablet</a>
            </div>
            <div class="tab-contents">

                <div class="tab-content-item active" id="fashion_1a">
                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                        @foreach ($tivi as $item)
                        <div class="product product-style-2 equal-elem ">
                           <div class="product-thumnail">
                            <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="{{ asset('assets1/upload/product/'.$item->image)}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item new-label">new</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>{{$item->name}}</span></a>
                                <div class="wrap-price"><span class="product-price">{{number_format($item->price,0,',','.')}} VNĐ</span></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-content-item" id="fashion_1b">
                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                        @foreach ($tulanh as $item)
                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{ asset('assets1/upload/product/'.$item->image)}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item bestseller-label">Bestseller</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>{{$item->name}}</span></a>
                                <div class="wrap-price"><span class="product-price">{{number_format($item->price,0,',','.')}} VNĐ</span></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-content-item" id="fashion_1c">
                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                        @foreach ($maygiat as $item)
                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{ asset('assets1/upload/product/'.$item->image)}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item bestseller-label">Bestseller</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>{{$item->name}}</span></a>
                                <div class="wrap-price"><span class="product-price">{{number_format($item->price,0,',','.')}} VNĐ</span></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

              
            </div>
        </div>
    </div>
</div>