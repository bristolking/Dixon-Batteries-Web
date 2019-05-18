<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | View Dealer</title>
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
                        View Dealer
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/dealers') }}">Dealers</a></li>
                        <li><a href="#" class="active">View Dealer</a></li>
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
                                            <label for="">Full Name  </label>
                                            <input type="text" class="form-control" placeholder="Full Name" value="{{ $dealer->name }}" readonly="">
                                            <span class="help-block has-error" id="name-error"/>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Firm Name </label>
                                            <input type="text" class="form-control" placeholder="Firm Name" readonly="" value="{{ $dealer->firm_name }}" readonly="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-6 form-group">
                                            <label for="">Address </label>
                                            <textarea class="form-control" placeholder="Address" readonly="">{{ $dealer->address }}</textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Location </label>
                                            <textarea class="form-control" placeholder="location" readonly="">{{ $dealer->location }}</textarea>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Email </label>
                                            <input type="text" class="form-control"  placeholder="Email" value="{{ $dealer->email }}" readonly="">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Mobile Number </label>
                                            <input type="text" class="form-control" placeholder="Mobile Number" value="{{ $dealer->mobile_number }}" readonly="">
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Dealer Code </label>
                                            <input type="text" class="form-control" placeholder="Dealer Code" value="{{ $dealer->dealer_code }}" readonly="">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">GST No </label>
                                            <input type="text" class="form-control" placeholder="GST No" value="{{ $dealer->gst_no }}" readonly="">
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">VAT No </label>
                                            <input type="text" class="form-control" value="{{ $dealer->vat_no }}" placeholder="Enter VAT No">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Rating </label>
                                            <input type="text" class="form-control" placeholder="Rating" value="{{ $dealer->rating }}" readonly="">
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

