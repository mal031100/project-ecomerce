<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    @include('client.layouts.style')
    @stack('styles')
</head>

<body class="home-page home-01 ">
    @include('client.layouts.header')
    @include('client.detail.maindetail')
    @include('client.layouts.footer')

    @include('client.layouts.script')
    @stack('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".add-to-cart").click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var _token = $('input[name = "_token"]').val();
                $.ajax({
                    url: '{{ url('client/add-cart') }}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_quantity: cart_product_quantity,
                        cart_product_price: cart_product_price,
                        _token: _token,
                    },
                    success: function(data) {
                        swal({
                                title: "Product added to cart",
                                text: "You can go to cart",
                                showCanceButton: true,
                                canceButtonText: "see more",
                                confirmButtonClass: "btn-sussecc",
                                confirmButtonText: "Ok",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{ url('client/cart') }}";
                            });
                    },
                    // function(response) {
                    //     swal("Login to Continue", response.status, "error");
                    // }
                });
            });
        });
    </script>
</body>

</html>
