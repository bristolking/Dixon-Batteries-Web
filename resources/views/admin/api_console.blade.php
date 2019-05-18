<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | API Console</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('admin/includes/styles')
    </head>
    <body class="skin-blue sidebar-mini" style="height: auto; min-height: 100%;">
        <div id="load"></div>
        <div class="wrapper" style="height: auto; min-height: 100%;">

            @include('admin/includes/header')

            @include('admin/includes/sidemenu')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="min-height: 946.3px;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        API Console
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#" class="active">API Console</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body">
                                    <div class="col-md-12 form-group">
                                        <label for="">URL </label>
                                        <input type="text" class="form-control" id="url" placeholder="Enter URL" required="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="">Method </label>
                                        <select class="form-control select2" id="method">
                                            <option value="">Please select...</option>
                                            <option value="GET">GET</option>
                                            <option value="POST">POST</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="">Input </label>
                                        <textarea class="form-control" name="input" id="input" placeholder="Enter input"></textarea>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="">Output </label>
                                        <textarea class="form-control" rows="5" readonly="" id="output" placeholder="Results"></textarea>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="button" class="btn btn-info pull-right" id="submit-btn">Submit</button>
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
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
        <script>
            $("#submit-btn").click(function () {
                var url = $("#url").val();
                var method = $("#method").val();
                var input = $("#input").val();
                if (url != '' && method != '') {
                    $.ajax({
                        url: "{{ url('/') }}/app/" + url,
                        type: method,
                        data: input,
                        success: function (response) {
                            $("#output").val(response);
                        },
                        error: function (xhr, textStatus, error) {
                            $("#output").val(xhr.status+" : "+error);
                        },
                    })
                } else {
                    alert('Please input!');
                }
            });
        </script>
    </body>
</html>

