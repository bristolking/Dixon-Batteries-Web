<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Create Battery Complaint</title>
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
                        Create Battery Complaint
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/battery_complaints') }}">Battery Complaint</a></li>
                        <li><a href="#" class="active">Create Battery Complaint</a></li>
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
                                <form  id="complaint-form" action="{{ url('/battery_complaint/add') }}"  data-toggle="validator" method="post">
                                    {!! csrf_field() !!}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Dealer <span class="label-star">*</span></label>
                                                <select class="form-control select2" name="dealer_id" >
                                                    <option value="">Please select...</option>
                                                    @if(isset($dealers) && !empty($dealers))
                                                    @foreach($dealers as $dealer)
                                                    <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="help-block has-error" id="dealer_id-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Customer Name  </label>
                                                <input type="text" class="form-control" name="customer_name" value="{{ old('customer_name') }}" placeholder="Enter customer name">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Product Model <span class="label-star">*</span></label>
                                                <select class="form-control select2" name="product_details" id="product_details" onchange="get_product_details();">
                                                    <option value="">Please select...</option>
                                                    @if(isset($products) && !empty($products))
                                                    @foreach($products as $product)
                                                    <option value="{{ $product->product_id }}_{{ $product->category_name }}_{{ $product->sub_category_name }}">{{ $product->model }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="help-block has-error" id="product_details-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Serial Number <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="battery_serial_no" value="{{ old('battery_serial_no') }}" placeholder="Enter serial number">
                                                <span class="help-block has-error" id="battery_serial_no-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Category </label>
                                                <input type="text" class="form-control" readonly="" id="category"  placeholder="Enter category">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Warranty/Life </label>
                                                <input type="text" class="form-control" readonly="" id="sub_category"  placeholder="Enter Warranty">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Complaint Date <span class="label-star">*</span></label>
                                                <input type="text" class="form-control datepicker" readonly="" name="complaint_date" placeholder="Enter complaint date" value="{{ old('complaint_date') }}">
                                                <span class="help-block has-error" id="complaint_date-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Complaint <span class="label-star">*</span></label>
                                                <textarea class="form-control" name="complaint" placeholder="Enter complaint" >{{ old('complaint') }}</textarea>
                                                <span class="help-block has-error" id="complaint-error"/>
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
            $(document).ready(function () {
                //Date Picker
//                var today = "@php echo date('d-m-Y') @endphp";
                $('.datepicker').datepicker({
                    format: "dd-mm-yyyy",
                    todayHighlight: true,
//                    startDate: today,
                    autoclose: true,
                }).on('change.dp', function (e) {
                    $(this).closest('form').bootstrapValidator('revalidateField', 'complaint_date');
                });
                //Date Picker
            });
        </script>
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
    </body>
</html>
<script>
    $(document).ready(function () {
        $('#complaint-form').bootstrapValidator({
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
                product_details: {
                    container: '#product_details-error',
                    validators: {
                        notEmpty: {
                            message: '* This field is required!'
                        }
                    }
                },
                battery_serial_no: {
                    container: '#battery_serial_no-error',
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
                complaint_date: {
                    container: '#complaint_date-error',
                    validators: {
                        notEmpty: {
                            message: '* This field is required!'
                        },
                    }
                },
                complaint: {
                    container: '#complaint-error',
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

