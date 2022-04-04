<main id="main" class="main-site">
    <form id="form-booking">
        <div class="container">

            <div class="wrap-breadcrumb">
                @if (session('message'))
                    <div>{{ session('message') }}</div>
                @endif
                <ul>
                    <li class="item-link"><a href="{{ route('client.index') }}" class="link">home</a>
                    </li>
                    <li class="item-link"><span>cart</span></li>
                </ul>
            </div>
            <div class=" main-content-area">

                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Products Name</h3>
                    @php
                        $total = 0;
                    @endphp
                    @foreach (Session::get('cart') as $key => $cart)
                        @php
                            $subtotal = $cart['price'] * $cart['quantity'];
                            $total += $subtotal;
                        @endphp
                        <div class="products-cart">
                            <li class="pr-cart-item">
                                <div>
                                    {{-- <input type="hidden" class="session_id" value="{{ $cart['session_id'] }}"> --}}
                                </div>
                                <div class="product-image">
                                    <figure><img src="{{ asset('assets1/upload/product/' . $cart['image']) }}" alt="">
                                    </figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product" href="{{ url('client/detail/' . $cart['id']) }}">
                                        {{ $cart['name'] . '-' . $cart['session_id'] }}
                                    </a>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">{{ number_format($cart['price'], 0, ',', '.') }} VND</p>
                                </div>
                                <div class="quantity">
                                    <p class="quantity-input">
                                        {{ $cart['quantity'] }}
                                    </p>
                                </div>
                                <div class="price-field sub-total">
                                    <p class="price">{{ number_format($subtotal, 0, ',', '.') }} VND</p>
                                </div>
                                {{-- {{ url('client/delete-cart/' . $cart['id']) }} --}}
                                <div class="delete">
                                    {{-- <button type="button" class="btn btn-delete delete-cart-item" title="">
                                    <i class="fa fa-times-circle"></i>
                                </button> --}}
                                    <a href="{{ url('client/delete-cart/' . $cart['session_id']) }}"
                                        class="btn btn-delete delete-cart-item" title="">
                                        <span>Delete from your cart</span>
                                        <i class="fa fa-times-circle"></i>
                                    </a>
                                </div>
                            </li>
                        </div>
                    @endforeach
                </div>
                <div class="summary">
                    <div class="order-summary">
                        <h4 class="title-box">Order Summary</h4>
                        <p class="summary-info"><span class="title">Subtotal</span><b
                                class="index">{{ number_format($total, 0, ',', '.') }} VND</b></p>
                        <p class="summary-info"><span class="title">Shipping</span><b
                                class="index">Free
                                Shipping</b></p>
                        <p class="summary-info total-info"><span class="title">Total</span><b
                                class="index subtotal">{{ number_format($total, 0, ',', '.') }} VND</b></p>
                    </div>
                    <div class="checkout-info">
                        <a class="btn btn-checkout check-out">Check out</a>
                        <a class="link-to-shop" href="{{ route('client.index') }}">Continue Shopping<i
                                class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </div>
                </div>

            </div>
            <div class="row form form-infor" id="form-infor">
                <div class="col-lg-12">
                    @csrf
                    <h3 align="center">Information</h3>
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAddress1">Address</label>
                        <input type="text" name="useraddress" class="form-control" id="useraddress"
                            placeholder="Enter your address">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone1">Phone number</label>
                        <input type="tel" name="userphone" class="form-control" id="userphone"
                            placeholder="Enter your phone number" pattern="[0-9]*">
                    </div>
                    <div class="form-group">
                        <a class="btn btn-warning return">Return</a>
                        <button type="submit" class="btn btn-primary detail">Information detail</button>
                    </div>
                </div>
            </div>
            <!--end main content area-->
        </div>
        <!--end container-->
    </form>
</main>
