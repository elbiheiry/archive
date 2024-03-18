<!DOCTYPE html>
<html>
    <head>
        <!-- Meta Tags
        ======================-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="">

        <!-- Title Name
        ================================-->
        <title> {{$settings->site_name}} | @yield('title')</title>

        <!-- Fave Icons
        ================================-->
        <link rel="shortcut icon" href="{{asset('storage/uploads/logo/'.$settings->site_logo)}}">

        <!-- Google Web Fonts
        ===========================-->
        <link href="http://fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet" type="text/css">

        <!-- Css Base And Vendor
        ===================================-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('assets/admin/vendor/bootstrap/bootstrap-ar.css')}}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="{{asset('assets/admin/vendor/datepicker/jquery.datetimepicker.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/vendor/jquery-ui/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/vendor/animation/animate.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"/

        <!-- Site Css
        ====================================-->
        <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/css/theme/default-theme.css')}}">
        <link href="{{asset('assets/admin/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="wrapper">
            <div class="main">
                @include('admin.layouts.sidebar')
                <div class="page-content">
                    @include('admin.layouts.header')
                    @yield('content')
                </div>
            </div>
        </div>

        @yield('modals')
        @yield('templates')

        <!-- common edit modal with ajax for all project -->
        <div id="common-modal" class="modal fade" role="dialog">
            <!-- modal -->
        </div>

        <!-- delete with ajax for all project -->
        <div id="delete-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
            </div>
        </div>
        <script id="template-modal" type="text/html" >
            <div class = "modal-content" >
                <input type = "hidden" name = "_token" value="{{ csrf_token() }}" >
                <div class = "modal-header" >
                    <button type = "button" class = "close" data - dismiss = "modal" > &times; </button>
                    <h4 class = "modal-title bold" >مسح العنصر</h4>
                </div>
                <div class = "modal-body" >
                    <p >هل انت متاكد ؟</p>
                </div>
                <div class = "modal-footer" >
                    <a
                            href = "{url}"
                            id = "delete" class = "btn btn-danger" >
                        <li class = "fa fa-trash" > </li> مسح
                    </a>

                    <button type = "button" class = "btn btn-warning" data-dismiss = "modal" >
                        <li class = "fa fa-times" > </li> الغاء</button >
                </div>
            </div>
        </script>



        @include('admin.templates.alerts')
        @include('admin.templates.delete-modal')

        <form action="#" id="csrf">{!! csrf_field() !!}</form>

        <!-- JS Base And Vendor
        ===================================-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
        <script src="{{asset('assets/admin/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('assets/admin/vendor/datepicker/jquery.datetimepicker.full.min.js')}}"></script>
        <script src="{{asset('assets/admin/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/admin/vendor/count-to/jquery.countTo.js')}}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="{{asset('assets/admin/vendor/datatables.min.js')}}"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>


        <!--JS Main
        ====================================-->
        <script src="{{asset('assets/admin/js/main.js')}}"></script>
        <script src="{{asset('assets/admin/process.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/sweetalert.min.js')}}" type="text/javascript"></script>
    </body>
</html>