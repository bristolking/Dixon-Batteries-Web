<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Uploads</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('admin/includes/styles')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div id="load"></div>
        <div class="wrapper">

            @include('admin/includes/header')

            @include('admin/includes/sidemenu')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Import <small>Dealers</small>
                    </h1>
                    @if (Session::has('success'))
                    <ol id="alert" style="color:green;">
                        {!! session('success') !!}
                    </ol>
                    @endif
                    @if (Session::has('fail'))
                    <ol id="alert" style="color:red;">
                        {!! session('fail') !!}
                    </ol>
                    @endif
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/dealers') }}">Dealers</a></li>
                        <li><a href="#" class="active">Import Dealers</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <form class="form-horizontal" action="{{url('dealer/import')}}" method="post" enctype="multipart/form-data">
                                        {!! csrf_field() !!}	
                                        <div class="box-body">
                                            <div class="row"> 
                                                <div class="form-group">
                                                    <label for="" class="col-sm-2 control-label">File input :</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" id="uploaddoc" onchange="loadFile(event)" name="dealers" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-sm-2 control-label">Note :</label>
                                                    <div class="col-sm-3" style="color: #988c4f;">
                                                        Please input standard file.Headers must be the same.
                                                        For example <a href="{{ asset('public/plugins/dealers.xlsx') }}" onclick="downloadexcel();">Click Here!</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            @include('admin/includes/footer')
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        @include('admin/includes/scripts')

    </body>
</html>
<script>
    var loadFile = function (event) {
        var type = event.target.files[0].type;
        if (type == 'application/vnd.ms-excel' | type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' | type == 'text/csv') {
            output.src = URL.createObjectURL(event.target.files[0]);
        } else {
            output = '';
            $("#uploaddoc").val('');
            output.src = '';
            alert('Please input excel(.xls Or .xlsx Or csv) document only!');
        }
    };
</script>
<script>
    function downloadexcel() {
        setInterval(function () {
            document.getElementById('load').style.visibility = "hidden";
        }, 1000);
    }
</script>
