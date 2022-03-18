<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
    @include('client.layouts.style')
    @stack('styles')
</head>

<body class="home-page home-01 ">
    @include('client.layouts.header')
    @include('client.cart.maincart')
    @include('client.layouts.footer')
    @include('client.layouts.script')
    @stack('scripts')
    <script>
        $(".form-infor").hide();
        $(document).ready(function() {
            $('.check-out').click(function(even) {
                event.preventDefault();
                $('.form-infor').show();
                $('.main-content-area').hide();
            });
            $('.return').click(function(even) {
                even.preventDefault();
                $('.form-infor').hide();
                $('.main-content-area').show();
            });
            // $('.delete-cart-item').click(function(even) {
            //     even.preventDefault();
            //     var session_id = $('.session_id').val();
            //     $.ajax({
            //         method: "GET",
            //         url: "{{ url('client/delete-cart') }}",
            //         data: {
            //             session_id: session_id,
            //         },
            //         success: function(response) {
            //             swal("", response.status, "succsess");
            //         }
            //     });
            // });
        })
    </script>
</body>

</html>
