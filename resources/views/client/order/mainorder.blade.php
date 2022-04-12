<main id="main" class="main-site">
    <form action="" id="detail-order" method="POST">
        @csrf
        {{-- @method('GET') --}}
        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ route('client.index') }}" class="link">home</a>
                    </li>
                    <li class="item-link"><span></span></li>
                </ul>
            </div>
            <div class=" main-content-area">
                <div class="wrap-address-billing">
                    <h3 class="box-title">Billing Address</h3>
                    <form action="#" method="get" name="frm-billing">
                        <p class="row-in-form">
                            <label for="">Name</label>
                            <td>{{ $posts['username'] }}</td>
                        </p>
                        <p class="row-in-form">
                            <label for="">Number phone</label>
                            <td>{{ $posts['userphone'] }}</td>
                        </p>
                        <p class="row-in-form">
                            <label for="">Address</label>
                            <td>{{ $posts['useraddress'] }}</td>
                        </p>
                        <p class="row-in-form">
                            <label for="">Email</label>
                            <td>{{ $posts['useremail'] }}</td>
                        </p>
                    </form>
                    @php
                        $total = 0;
                    @endphp
                    @foreach (Session::get('cart') as $key => $cart)
                        @php
                            $subtotal = $cart['price'] * $cart['quantity'];
                            $total += $subtotal;
                        @endphp
                    @endforeach
                </div>
                <div class="summary summary-checkout">
                    <div class="summary-item payment-method">
                        <h4 class="title-box">Payment Method</h4>
                        <div class="choose-payment-methods">
                            <label class="payment-method">
                                <input name="paymentMethod" id="payment-method-bank" value="bank" type="radio">
                                <span>VN Pay</span>
                            </label>
                            <label class="payment-method">
                                <input name="paymentMethod" id="payment-method-visa" value="visa" type="radio">
                                <span>visa</span>
                            </label>
                            <label class="payment-method">
                                <input name="paymentMethod" id="payment-method-paypal" value="paypal" type="radio">
                                <span>Paypal</span>
                            </label>
                        </div>
                        <p class="summary-info grand-total" ><span>Grand Total</span> <span
                                class="grand-total-price" name="total" id="total">{{ number_format($total, 0, ',', '.') }}</span><span> VND</span></p>
                        <a href="{{route('client.cart')}}" class="btn btn-back">Back</a>
                        <a class="btn btn-medium" name="payUrl" id="pay">Place order now</a>
                    </div>
                    <div class="summary-item shipping-method">
                        <h4 class="title-box f-title">Shipping method</h4>
                        <p class="summary-info"><span class="title">Free Shipping</span></p>
                        <h4 class="title-box">Discount Codes</h4>
                        <p class="row-in-form">
                            <label for="coupon-code">Enter Your Coupon code:</label>
                            <input id="coupon-code" type="text" name="coupon-code" value="" placeholder="">
                        </p>
                        <a href="#" class="btn btn-small">Apply</a>
                    </div>
                </div>
            </div>
            <!--end main content area-->
        </div>
        <!--end container-->
    </form>
</main>
