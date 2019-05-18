<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | View Product</title>
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
                        View Product
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/products') }}">Products</a></li>
                        <li><a href="#" class="active">View Product</a></li>
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
                                    @if(isset($product->image_paths) && !empty($product->image_paths))
                                    @php 
                                    $images = json_decode($product->image_paths,1);
                                    @endphp
                                    @foreach($images as $image)
                                    <img src="{{ $image }}" height="15%" width="15%"/>&nbsp;&nbsp;
                                    @endforeach
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Model </label>
                                            <input type="text" class="form-control"  placeholder="Enter model" value="{{ $product->model }}" readonly=""> 
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Container </label>
                                            <input type="text" class="form-control"  placeholder="Enter container" value="{{ $product->container }}" readonly=""> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Capacity </label>
                                            <input type="text" class="form-control"  placeholder="Enter capacity" value="{{ $product->capacity }}" readonly=""> 
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Length(Dimention:MM) </label>
                                            <input type="text" class="form-control"  placeholder="Enter dimensions" value="{{ $product->length }}" readonly=""> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Width(Dimention:MM) </label>
                                            <input type="text" class="form-control"  placeholder="Enter dimensions" value="{{ $product->width }}" readonly=""> 
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Height(Dimention:MM) </label>
                                            <input type="text" class="form-control"  placeholder="Enter dimensions" value="{{ $product->height }}" readonly=""> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Charging Current </label>
                                            <input type="text" class="form-control"  placeholder="Enter charging current" value="{{ $product->charging_current }}" readonly=""> 
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Filled Weight </label>
                                            <input type="text" class="form-control"  placeholder="Enter filled weight" value="{{ $product->filled_weight }}" readonly=""> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Category </label>
                                            <input type="text" class="form-control"  placeholder="Enter category" value="{{ $product->category_name }}" readonly="">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Warranty/Life </label>
                                            <input type="text" class="form-control"  placeholder="Enter warranty" value="{{ $product->sub_category_name }}" readonly="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Points </label>
                                            <input type="text" class="form-control"  placeholder="Enter points" value="{{ $product->points }}" readonly="">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Price </label>
                                            <input type="text" class="form-control"  placeholder="Enter price" value="{{ $product->price }}" readonly="">
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

