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
        var totalActual = 0;
        var prices = 0;
        var array = [
            
        ];
        $(document).ready(function() {
            $('.check-out').click(function(event) {
                event.preventDefault();
                $('.form-infor').show();
                $('.main-content-area').hide();
            });
            const total = 0
            if (array.lenght > 0) {
                array.map(item => item.total).reduce((p, c) => p + c, total);
            }
            console.log(total);

            totalActual += total;
            prices += total
            console.log(total);
            $('.return').click(function(event) {
                event.preventDefault();
                $('.form-infor').hide();
                $('.main-content-area').show();
            });
        })

        $(document).on('submit', '#form-booking', function(event) {
            var form_booking = $(this);
            const username = $('#username').val();
            const userphone = $('#userphone').val();
            const useraddress = $('#useraddress').val();
            const useremail = $('#useremail').val();
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
                    useremail: useremail,
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
                        $(document).ready(function() {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                }
                            });
                            $('#pay').click(function(event) {
                                console.log('ok');
                                var paymentMethod = $(
                                    'input[name=paymentMethod]:checked').val();
                                console.log('hihi');
                                event.preventDefault();
                                console.log('haha');
                                $.ajax({
                                    method: 'POST',
                                    url: "{{ route('client.payment') }}",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        username: username,
                                        useremail: useremail,
                                        userphone: userphone,
                                        useraddress: useraddress,
                                        paymentMethod: paymentMethod,
                                        // total: total,
                                    },
                                    type: 'json',
                                    success: function(data) {
                                        console.log(data);
                                        location.href = data.data;
                                    }
                                });
                            });
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>
