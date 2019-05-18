<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | View Promotion</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('admin/includes/styles')
        <style>
            .label-star{
                color: red;
            }
        </style>
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
                        View Promotion
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/promotions') }}">Promotions</a></li>
                        <li><a href="#" class="active">View Promotion</a></li>
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
                                    <div class="row" style="text-align:center;">

                                        <div class="col-md-3 "></div>
                                        <div class="col-md-6 ">
                                            <div class="col-md-12">
                                                <h1>{{ $promotion->title }}</h1>
                                            </div>
                                            <div class="col-md-12" >
                                                @if(isset($promotion->image_path) && !empty($promotion->image_path))
                                                <img src="{{ $promotion->image_path }}"/>&nbsp;&nbsp;
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <h4>{{ $promotion->content }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-3 "></div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
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
    </body>
</html>

