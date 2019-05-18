<meta name="csrf-token" content="{{ csrf_token() }}">
<!--Angular JS-->
<script type="text/javascript" src="{{ asset('public/angular-js/angular.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/angular-js/ui-bootstrap-tpls-0.12.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/g/filesaver.js"></script>
<script type="text/javascript" src="{{ asset('public/angular-js/json-export-excel.js') }}"></script>
<!--<script type="text/javascript" src="{{ asset('public/angular-js/angular-sanitize.min.js') }}"></script>-->
<!--Angular JS-->

<script type="text/javascript" src="{{ asset('public/plugins/Themes/AdminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/plugins/Themes/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/plugins/Themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('public/plugins/Themes/AdminLTE/dist/js/adminlte.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('/public/plugins/Themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('public/plugins/Themes/AdminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function(){
       $('.select2').select2() 
    });
</script>

<!--Admin form scripts-->

<!--BOOTSTRAP VALIDATION-->
<script src="{{ asset('public/plugins/validation/bootstrapValidator.js') }}"></script>
<!--BOOTSTRAP VALIDATION-->

<!--Alert Messages-->

<script>
setInterval(function () {
    $("#alert").fadeOut();
    $(".alert-danger").fadeOut();
}, 3000);
</script>

<!--Alert Messages-->

<!--Loader-->
<script>
    $(window).bind('beforeunload', function () {
        document.getElementById('load').style.visibility = "visible";
    });
    window.onload = function () {
        var state = document.readyState
        if (state == 'complete') {
            setTimeout(function () {
                document.getElementById('load').style.visibility = "hidden";
            }, 250);
        }
    }
</script>
<!--Loader-->

<!--Ajax With Csrf token-->
<script src="{{ asset ( 'public/js/ajaxtoken.js' ) }}" ></script>
<!--Ajax With Csrf token-->


