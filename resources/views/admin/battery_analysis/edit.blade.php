<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Update Battery Analysis</title>
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
                        Update Battery Analysis
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/battery_analysis') }}">Battery Analysis</a></li>
                        <li><a href="#" class="active">Update Battery Analysis</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form  id="product-form" action="{{ url('/battery_analysis/edit') }}/{{ $battery_analysis->battery_analysis_id }}"  data-toggle="validator" method="post">
                                    {!! csrf_field() !!}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Dealer <span class="label-star">*</span></label>
                                                <select class="form-control select2" name="dealer_id">
                                                    <option value="">Please select...</option>
                                                    @if(isset($dealers) && !empty($dealers))
                                                    @foreach($dealers as $dealer)
                                                    @if($dealer->id==$battery_analysis->dealer_id)
                                                    <option value="{{ $dealer->id }}" selected="">{{ $dealer->name }}</option>
                                                    @else
                                                    <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="help-block has-error" id="dealer_id-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Serial Number <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="battery_sno" value="{{ $battery_analysis->battery_sno }}" placeholder="Enter serial number">
                                                <span class="help-block has-error" id="battery_sno-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Product Model <span class="label-star">*</span></label>
                                                <select class="form-control select2" id="product_details" name="product_details" onchange="get_product_details();">
                                                    <option value="">Please select...</option>
                                                    @if(isset($products) && !empty($products))
                                                    @foreach($products as $product)
                                                    @if($product->product_id==$battery_analysis->product_id)
                                                    <option value="{{ $product->product_id }}_{{ $product->category_name }}_{{ $product->sub_category_name }}" selected="">{{ $product->model }}</option>
                                                    @else
                                                    <option value="{{ $product->product_id }}_{{ $product->category_name }}_{{ $product->sub_category_name }}" >{{ $product->model }}</option>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="help-block has-error" id="product_details-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Category </label>
                                                <input type="text" class="form-control" readonly="" id="category" value="{{ $battery_analysis->category_name }}"   placeholder="Enter category">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Warranty/Life </label>
                                                <input type="text" class="form-control" readonly="" id="sub_category" value="{{ $battery_analysis->sub_category_name }}"  placeholder="Enter Warranty">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">OCV </label>
                                                <input type="text" class="form-control" name="ocv" value="{{ $battery_analysis->ocv }}"  placeholder="Enter ocv" >
                                                <span class="help-block has-error" id="ocv-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Physical Status <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="physical_status" value="{{ $battery_analysis->physical_status }}" placeholder="Enter physical status" >
                                                <span class="help-block has-error" id="physical_status-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Acid Level <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="acid_level" value="{{ $battery_analysis->acid_level }}" placeholder="Enter acid level">
                                                <span class="help-block has-error" id="acid_level-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Cell Wise Acid(SP GR) </label>
                                                <input type="text" class="form-control" name="cell_wise_acid_sp_gr" value="{{ $battery_analysis->cell_wise_acid_sp_gr }}" placeholder="Enter cell wise acid">
                                                <span class="help-block has-error" id="cell_wise_acid_sp_gr-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Charge Details </label>
                                                <input type="text" class="form-control" name="charge_details" value="{{ $battery_analysis->charge_details }}" placeholder="Enter charge details">
                                                <span class="help-block has-error" id="charge_details-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Test Details </label>
                                                <input type="text" class="form-control" name="test_details" value="{{ $battery_analysis->test_details }}" placeholder="Enter test details">
                                                <span class="help-block has-error" id="test_details-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Battery Resends On </label>
                                                <input type="text" class="form-control datepicker" readonly="" name="battery_resend_on" value="{{ $battery_analysis->battery_resend_on }}" placeholder="Enter resends on">
                                                <span class="help-block has-error" id="battery_resend_on-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Replaced Battery Serial Number </label>
                                                <input type="text" class="form-control" name="replaced_battery_sno" value="{{ $battery_analysis->replaced_battery_sno }}" placeholder="Enter replaced serial number">
                                                <span class="help-block has-error" id="replaced_battery_sno-error"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                                    </div>
                                </form>
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
            function get_product_details() {
                var details = $("#product_details").val();
                if (details != '') {
                    var sep = details.split('_');
                    $("#category").val(sep[1]);
                    $("#sub_category").val(sep[2]);
                } else {
                    $("#category").val('');
                    $("#sub_category").val('');
                }
            }
        </script>
        <script>
            $(document).ready(function () {
                $('.datepicker').datepicker({
                    format: "dd-mm-yyyy",
                    todayHighlight: true,
                    autoclose: true,
                })
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#product-form').bootstrapValidator({
                    message: 'This value is not valid',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                    },
                    fields: {
                        dealer_id: {
                            container: '#dealer_id-error',
                            validators: {
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
                        battery_sno: {
                            container: '#battery_sno-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 150,
                                    message: '* Limit exceeded!'
                                },
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
                        product_details: {
                            container: '#product_details-error',
                            validators: {
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
                        physical_status: {
                            container: '#physical_status-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 150,
                                    message: '* Limit exceeded!'
                                },
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
                        acid_level: {
                            container: '#acid_level-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 150,
                                    message: '* Limit exceeded!'
                                },
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
                    }
                });
            });
        </script>
    </body>
</html>


