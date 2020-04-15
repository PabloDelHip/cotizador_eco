<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- daterange picker -->
        <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet"> <!--Añadimos el css generado con webpack-->
    </head>
    <body style="background-color: white;">

        {{-- <div class="container">
            <div class="row col-12 mt-2 d-flex align-items-end">
                <div class="col-6">
                    <img src="{{asset('img/logo-ecolomovil.png')}}" alt="logo-ecolomovil" style="width: 100px;">
                </div>
                <div class="col-6 text-right">
                    <span> <i class="fas fa-phone"></i> 0810 555-5500 </span> 
                </div>
            </div>
        </div> --}}

        {{-- <section>
            <div class="hero" style="background: url({{asset('img/fondo.jpg')}}) center center no-repeat;"></div>
        </section> --}}
        
        <div id="app" class="content"><!--La equita id debe ser app, como hemos visto en app.js-->
            <example-component></example-component><!--Añadimos nuestro componente vuejs-->
        </div>

        




        <script src="{{asset('js/app.js')}}"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->
        <!-- jQuery -->
        <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Select2 -->
        <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
        <!-- Bootstrap4 Duallistbox -->
        <script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
        <!-- InputMask -->
        <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
        <script src="{{asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
        <!-- date-range-picker -->
        <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- bootstrap color picker -->
        <script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
        <!-- Bootstrap Switch -->
        <script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('dist/js/demo.js')}}"></script>
        <!-- Page script -->
        <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
            format: 'LT'
            })
            
            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            });

            $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

        })
        </script>
    
    </body>
</html>