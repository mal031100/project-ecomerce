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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(".form-infor").hide();
        $(document).ready(function() {
            $('.check-out').click(function(event) {
                event.preventDefault();
                $('.form-infor').show();
                $('.main-content-area').hide();
            });
            $('.return').click(function(event) {
                event.preventDefault();
                $('.form-infor').hide();
                $('.main-content-area').show();
            });
            // $('.delete-cart-item').click(function(event) {
            //     event.preventDefault();
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
        $(document).on('submit', '#form-booking', function(event) {
            var form_booking = $(this);
            const username = $('#username').val();
            const userphone = $('#userphone').val();
            const useraddress = $('#useraddress').val();
            event.preventDefault();
            $.ajaxSetup({
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: "/client/order-detail",
                data: {
                    _token: "{{ csrf_token() }}",
                    username: username,
                    userphone: userphone,
                    useraddress: useraddress,
                },
                type: 'json', 
                success: function(data) {
                   
                    if (data.status == 405) {
                        let _html = '';
                        $.each(data['data'], function(key, value) {
                            _html += '<li>' + value + '</li>'
                        });
                        // console.log(data);
                        swal.fire({
                            title: data.errors,
                            html: _html,
                            type: 'error'
                        });
                    } else {
                        // console.log(data);
                        form_booking.parent().html(data);
                        form_booking.replaceWith(data.url);
                    }
                }
            });
        });
    </script>
</body>

</html>
