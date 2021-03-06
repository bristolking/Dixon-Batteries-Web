<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | View Target</title>
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
                        View Target
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/targets') }}">Targets</a></li>
                        <li><a href="#" class="active">View Target</a></li>
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
                                        @if(isset($target->products) && !empty($target->products))
                                        <table class="table table-bordered table-hover">
                                        <tr>
                                            <th width="5%">S No</th>
                                            <th width="7%">Order Id</th>
                                            <th width="8%">Order Date</th>
                                            <th>Category</th>
                                            <th>Model</th>
                                            <th>Container</th>
                                            <th width="5%">Points</th>
                                            <th width="6%">Price</th>
                                            <th width="6%">Quantity</th>
                                            <th>Points(E)</th>
                                            <th>Amount(E)</th>
                                        </tr>
                                        @foreach($target->products as $k=> $product)
                                        <tr>
                                            <td>{{ $k+1 }}</td>
                                            <td align="center"><a href="{{ url('order/view') }}/{{ $product->order_id }}">{{ $product->order_id }}</a></td>
                                            <td>{{ date('d-m-Y', strtotime($product->created_at))  }}</td>
                                            <td>{{ $product->category_name }}</td>
                                            <td>{{ $product->model }}</td>
                                            <td>{{ $product->container }}</td>
                                            <td align="center">{{ $product->points }}</td>
                                            <td align="center">&#8377; {{ $product->price }}</td>
                                            <td align="center">{{ $product->quantity }}</td>
                                            <td align="center"><b>{{ $product->points_earned }}</b></td>
                                            <td align="center"><b> &#8377; {{ $product->amount_earned }}</b></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"><b>Total</b></td>
                                            <td align="center"><b>{{ $target->achieve_qty }}</b></td>
                                            <td align="center"><b>{{ $target->achieve_points }}</b></td>
                                            <td align="center"><b>&#8377; {{ $target->achieve_amounts }}</b></td>
                                        </tr>
                                        </table><br/><hr>
                                        @endif
                                    
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Dealer Name </label>
                                            <input type="text" class="form-control"  placeholder="Enter Name" value="{{ $target->name }}"  readonly=""> 
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Month </label>
                                            <input type="text" class="form-control"  placeholder="Enter dealer_code" value="{{ $target->month }}"  readonly=""> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Year </label>
                                            <input type="text" class="form-control"  placeholder="Enter email" value="{{ $target->year }}"  readonly=""> 
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Target Amount </label>
                                            <input type="text" class="form-control"  placeholder="Enter target amount" value="{{ $target->target_amount }}"  readonly=""> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Target Quantity </label>
                                            <input type="text" class="form-control"  placeholder="Enter target quantity " value="{{ $target->target_qty }}"  readonly=""> 
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

