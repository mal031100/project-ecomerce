<div class="wrap-show-advance-info-box style-1 has-countdown">
    <h3 class="title-box">On Sale</h3>
    <div class="wrap-countdown mercado-countdown" data-expire="2020/12/12 12:34:56"></div>
    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

        @foreach ($product as $item)
        <div class="product product-style-2 equal-elem ">
            <div class="product-thumnail">
                <a href="{{asset('client/detail/'.$item->id)}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                    <figure><img src="{{ asset('assets1/upload/product/'.$item->image)}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                </a>
                <div class="group-flash">
                    <span class="flash-item sale-label">sale</span>
                </div>
                <div class="wrap-btn">
                    <a href="#" class="function-link">quick view</a>
                </div>
            </div>
            <div class="product-info">
                <a href="{{asset('client/detail/'.$item->id)}}" class="product-name"><span>{{$item->name}}</span></a>
                <div class="wrap-price"><span class="product-price">{{number_format($item->price,0,',','.')}} VNĐ</span></div>
            </div>
        </div>
        @endforeach
    </div>
</div>