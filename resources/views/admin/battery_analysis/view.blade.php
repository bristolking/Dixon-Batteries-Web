<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | View Battery Analysis</title>
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
                        View Battery Analysis
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/battery_analysis') }}">Battery Analysis</a></li>
                        <li><a href="#" class="active">View Battery Analysis</a></li>
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
                                            <label for="">Dealer Name </label>
                                            <input type="text" value="{{ $battery_analysis->name }}" class="form-control" placeholder="Enter dealer name" readonly="">

                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Dealer Code </label>
                                            <input type="text" value="{{ $battery_analysis->dealer_code }}" class="form-control" placeholder="Enter dealer code" readonly="">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Battery Serial Number </label>
                                            <input type="text" value="{{ $battery_analysis->battery_sno }}" class="form-control" placeholder="Enter serial number" readonly="">

                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Model </label>
                                            <input type="text" value="{{ $battery_analysis->model }}" class="form-control" placeholder="Enter model" readonly="">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Category </label>
                                            <input type="text" class="form-control"  placeholder="Enter category" value="{{ $battery_analysis->category_name }} months" readonly="">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Warranty/Life </label>
                                            <input type="text" class="form-control"  placeholder="Enter warranty" value="{{ $battery_analysis->sub_category_name }} months" readonly="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">OCV </label>
                                            <input type="text" value="{{ $battery_analysis->ocv }}" class="form-control"   placeholder="Enter ocv" readonly="">

                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Physical Status </label>
                                            <input type="text" value="{{ $battery_analysis->physical_status }}" class="form-control"  placeholder="Enter physical status" readonly="">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Acid Level </label>
                                            <input type="text" value="{{ $battery_analysis->acid_level }}" class="form-control"  placeholder="Enter acid level" readonly="">

                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Cell Wise Acid(SP GR) </label>
                                            <input type="text" value="{{ $battery_analysis->cell_wise_acid_sp_gr }}" class="form-control"  placeholder="Enter cell wise acid" readonly="">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Charge Details </label>
                                            <input type="text" value="{{ $battery_analysis->charge_details }}" class="form-control"  placeholder="Enter charge details" readonly="">

                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Test Details </label>
                                            <input type="text" value="{{ $battery_analysis->test_details }}" class="form-control"  placeholder="Enter test details" readonly="">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Battery Resends On </label>
                                            <input type="text" value="{{ $battery_analysis->battery_resend_on }}" class="form-control" placeholder="Enter resends on" readonly="">

                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Replaced Battery Serial Number </label>
                                            <input type="text" value="{{ $battery_analysis->replaced_battery_sno }}" class="form-control" placeholder="Enter replaced serial number" readonly="">

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

