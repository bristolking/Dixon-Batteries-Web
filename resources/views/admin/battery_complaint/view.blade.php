<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | View Battery Complaint</title>
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
                        View Battery Complaint
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/battery_complaints') }}">Battery Complaint</a></li>
                        <li><a href="#" class="active">View Battery Complaint</a></li>
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
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Dealer </label>
                                                <input type="text" class="form-control" value="{{ $battery_complaint->name }}" readonly="">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Dealer Code</label>
                                                <input type="text" class="form-control" value="{{ $battery_complaint->dealer_code }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Customer Name </label>
                                                <input type="text" class="form-control" value="{{ $battery_complaint->customer_name }}" readonly="">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Battery Serial Number </label>
                                                <input type="text" class="form-control" value="{{ $battery_complaint->battery_serial_no }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Product </label>
                                                <input type="text" class="form-control" value="{{ $battery_complaint->model }}" readonly="">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Category </label>
                                                <input type="text" class="form-control"  placeholder="Enter category" value="{{ $battery_complaint->category_name }} months" readonly="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Warranty/Life </label>
                                                <input type="text" class="form-control"  placeholder="Enter warranty" value="{{ $battery_complaint->sub_category_name }} months" readonly="">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Complaint Date </label>
                                                <input type="text" class="form-control"  placeholder="Enter complaint date" value="{{ $battery_complaint->complaint_date }}" readonly="">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Complaint </label>
                                                <textarea class="form-control" readonly="" >{{ $battery_complaint->complaint }}</textarea>
                                            </div>
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

