<!------ FOOTER-WIDGET ------>
<div class="footer-widget">
    <div class="container-xl container-fluid">
        <div class="row">
            <div class="col-md-5 col-sm-6">
                <div class="site-info-widget">
                    <div class="footer-logo">
                        <h4>{{$siteInfo->site_name}}</h4>
                    </div>
                    <p>{{$siteInfo->footer_desc}}</p>
                </div>
                <ul class="social-links">
                    @foreach($social as $item)
                        @if($item->facebook != '')
                            <li>
                                <a href="{{$item->facebook}}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            </li>
                        @endif
                        @if($item->twitter != '')
                            <li>
                                <a href="{{$item->twitter}}" class="twitter"><i class="fab fa-twitter"></i></a>
                            </li>
                        @endif
                        @if($item->instagram != '')
                            <li>
                                <a href="{{$item->instagram}}" class="instagram"><i class="fab fa-instagram"></i></a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 d-flex justify-content-md-center justify-content-sm-center">
                <div class="menu-widget">
                    <h4 class="widget-title">Quick Menu</h4>
                    <ul class="menu-list">
                        <li><a href="{{url('/')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Home</a></li>
                        <li><a href="{{url('/contact')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-8 d-flex justify-content-md-center">
                <div class="contact-widget">
                    <h4 class="widget-title">Contact Us</h4>
                    <ul class="contact-list">
                        <li>
                            <span class="icon"><i class="fas fa-phone-alt"></i></span>
                            <span>{{$siteInfo->phone}}</span>
                        </li>
                        <li>
                            <span class="icon"><i class="fas fa-envelope"></i></span>
                            <a href="mailto:" class="email">{{$siteInfo->email}}</a>
                        </li>
                        <li>
                            <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                            <span>{{$siteInfo->address}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!------/FOOTER-WIDGET------>

<!------ FOOTER ------>
<div class="footer">
    <div class="container-xl container-fluid">
        <div class="row">
            <div class="col-md-12">
                <p class="copyright-text">Copyright © 2024&nbsp<a href="https://github.com/prabhu-ji">Prabhu Ji</a></p>
            </div>
        </div>
    </div>
</div>
<input type="text" hidden id="url" value="{{url('/')}}">
<!------/FOOTER------>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<!-- <script src="{{asset('assets/js/main_ajax.js')}}"></script> -->
<script src="{{asset('assets/js/action.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.select2').select2();
    });
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCloseButton: false,
        timer: 2000,
        timerProgressBar:true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert',({detail:{type,message}})=>{
        Toast.fire({
            icon:type,
            title:message
        })
    });

    var owl = $('.owl-carousel');
        owl.owlCarousel({
            margin: 30,
            loop: true,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                450: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                },
            }
    });

    $('.test').parent('.table').hide();
    $('.select-seat').change(function(){
        if ($(this).prop('checked')==true){ 
            $(this).parent('.seat').addClass('active');
        }else{
            $(this).parent('.seat').removeClass('active');
        }
        // if($(this).parent('.seat').hasClass('active')){
        //     $(this).parent('.seat').removeClass('active');
        // }else{
        //     $(this).parent('.seat').addClass('active');
        // }
        
        var id = $(this).val();

        var price = $('input[name=price]').val();
        var seat_list = $('input[name=seat_list]').val();
        if(seat_list != ''){
            var seat_array = seat_list.split(',');
            seat_array = seat_array.filter(item => item);
            if ($.inArray(id, seat_array) != -1)
            {
                var index = seat_array.indexOf(id);
                if (index !== -1) {
                    seat_array.splice(index, 1);
                    var seats = seat_array.join(',');
                    $('input[name=seat_list]').val(seats);
                    $('tr.'+id).remove();
                    var sub_total = $('.sub-total').html();
                    sub_total = parseInt(sub_total) - parseInt(price);
                    $('.sub-total').html(sub_total);
                    if(seat_array.length == 0){
                        $('.test').parent('.table').hide();
                        $('.sub-total').html('');
                    }
                }
            }else{
                seat_array.push(id);
                var seats = seat_array.join(',');
                $('input[name=seat_list]').val(seats);
                var tr = '<tr class="'+id+'"><td>'+id+'</td><td>'+price+'</td></tr>';
                var sub_total = $('.sub-total').html();
                sub_total = parseInt(sub_total) + parseInt(price);
                $('.sub-total').html(sub_total);
                $('.test').append(tr);
            }
        }else{
            $('input[name=seat_list]').val(id+',');
            var tr = '<tr class="'+id+'"><td>'+id+'</td><td>'+price+'</td></tr>';
            $('.sub-total').html(price);
            $('.test').html(tr);
            $('.test').parent('.table').show();
        }
    });


</script>
@yield('pageJsScripts')
</body>
</html>