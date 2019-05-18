<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | View Order</title>
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
                        View Order
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/orders') }}">Orders</a></li>
                        <li><a href="#" class="active">View Order</a></li>
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
                                                <label for="">Order Number  </label>
                                                <input type="text" class="form-control" readonly="" value="{{ $order->order_number }}" placeholder="Enter order name">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Dealer  </label>
                                                <input type="text" class="form-control" readonly="" value="{{ $order->name }}" placeholder="Enter dealer">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Dealer Code </label>
                                                <input type="text" class="form-control" readonly="" value="{{ $order->dealer_code }}" placeholder="Enter dealer code">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Product  </label>
                                                <input type="text" class="form-control" readonly="" value="{{ $order->model }}" placeholder="Enter product">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Category </label>
                                                <input type="text" class="form-control" readonly="" id="category" value="{{ $order->category_name }}"   placeholder="Enter category">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Warranty/Life </label>
                                                <input type="text" class="form-control" readonly="" id="sub_category" value="{{ $order->sub_category_name }}"  placeholder="Enter Warranty">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Quantity  </label>
                                                <input type="text" class="form-control" readonly="" value="{{ $order->quantity }}" placeholder="Enter quantity">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">LR Number  </label>
                                                <input type="text" class="form-control" readonly="" value="{{ $order->lr_number }}" placeholder="Enter LR number">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Accepted Date  </label>
                                                <input type="text" class="form-control" readonly="" value="{{ $order->accepted_date }}" placeholder="Enter accepted date">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Dispatched Date  </label>
                                                <input type="text" class="form-control" readonly="" value="{{ $order->dispatched_date }}" placeholder="Enter dispatched date">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Pending Date  </label>
                                                <input type="text" class="form-control" readonly="" value="{{ $order->pending_date }}" placeholder="Enter pending date">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Declined Date  </label>
                                                <input type="text" class="form-control" readonly="" value="{{ $order->declined_date }}" placeholder="Enter declined date">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Delivered Date  </label>
                                                <input type="text" class="form-control" readonly="" value="{{ $order->delivered_date }}" placeholder="Enter delivered date">
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

