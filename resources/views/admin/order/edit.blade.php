<?php
$status_date = '';
if ($order->status == 1) {
    $status_date = $order->accepted_date;
} elseif ($order->status == 2) {
    $status_date = $order->dispatched_date;
} elseif ($order->status == 3) {
    $status_date = $order->pending_date;
} elseif ($order->status == 4) {
    $status_date = $order->declined_date;
} elseif ($order->status == 5) {
    $status_date = $order->delivered_date;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Update Order</title>
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
                        Update Order
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/orders') }}">Orders</a></li>
                        <li><a href="#" class="active">Update Order</a></li>
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
                                <form  id="order-form" action="{{ url('/order/edit') }}/{{ $order->order_id }}"  data-toggle="validator" method="post">
                                    {!! csrf_field() !!}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Order Number <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="order_number" value="{{ $order->order_number }}" placeholder="Enter order name">
                                                <span class="help-block has-error" id="order_number-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Dealer <span class="label-star">*</span></label>
                                                <select class="form-control select2" name="dealer_id">
                                                    <option value="">Please select...</option>
                                                    @if(isset($dealers) && !empty($dealers))
                                                    @foreach($dealers as $dealer)
                                                    @if($dealer->id==$order->dealer_id)
                                                    <option value="{{ $dealer->id }}" selected="">{{ $dealer->name }}</option>
                                                    @else
                                                    <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="help-block has-error" id="dealer_id-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Product Model <span class="label-star">*</span></label>
                                                <select class="form-control select2" id="product_details" name="product_details" onchange="get_product_details();">
                                                    <option value="">Please select...</option>
                                                    @if(isset($products) && !empty($products))
                                                    @foreach($products as $product)
                                                    @if($product->product_id==$order->product_id)
                                                    <option value="{{ $product->product_id }}_{{ $product->category_name }}_{{ $product->sub_category_name }}" selected="">{{ $product->model }}</option>
                                                    @else
                                                    <option value="{{ $product->product_id }}_{{ $product->category_name }}_{{ $product->sub_category_name }}">{{ $product->model }}</option>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="help-block has-error" id="product_details-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Quantity <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="quantity" value="{{ $order->quantity }}" placeholder="Enter quantity">
                                                <span class="help-block has-error" id="quantity-error"/>
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
                                                <label for="">LR Number <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="lr_number" value="{{ $order->lr_number }}" placeholder="Enter LR number">
                                                <span class="help-block has-error" id="lr_number-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status Date <span class="label-star">*</span></label>
                                                <input type="text" class="form-control datepicker" readonly="" id="status_date" name="status_date" value="{{ $status_date }}" placeholder="Enter status date">
                                                <span class="help-block has-error" id="status_date-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Status </label>
                                                <select class="form-control select2" name="status" onchange="check_date_changed(this.value);">
                                                    <option value="">Please select...</option>
                                                    @if($order->status==1)
                                                    <option value="1" selected="">Accepted</option>
                                                    <option value="2">Dispatched</option>
                                                    @endif
                                                    @if($order->status==2)
                                                    <option value="2" selected="">Dispatched</option>
                                                    <option value="3">Pending</option>
                                                    @endif
                                                    @if($order->status==3)
                                                    <option value="3" selected="">Pending</option>
                                                    <option value="4">Declined</option>
                                                    @endif
                                                    @if($order->status==4)
                                                    <option value="4" selected="">Declined</option>
                                                    <option value="5">Delivered</option>
                                                    @endif
                                                    @if($order->status==5)
                                                    <option value="5" selected="">Delivered</option>
                                                    @endif
                                                </select>
                                                <span class="help-block has-error" id="status-error"/>
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
            function check_date_changed() {
                $("#status_date").val('');
            }
        </script>
        <script>
            $(document).ready(function () {
                //Date Picker
                var today = "@php echo $status_date; @endphp";
                $('.datepicker').datepicker({
                    format: "dd-mm-yyyy",
                    todayHighlight: true,
                    startDate: today,
                    autoclose: true,
                }).on('change.dp', function (e) {
                    $(this).closest('form').bootstrapValidator('revalidateField', 'status_date');
                });
                //Date Picker
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#order-form').bootstrapValidator({
                    message: 'This value is not valid',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                    },
                    fields: {
                        order_number: {
                            container: '#order_number-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 50,
                                    message: '* Limit exceeded!'
                                },
                                regexp: {
                                    regexp: /^[_0-9 ]{1,}$/,
                                    message: '* Please enter only numbers!'
                                },
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
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
                        quantity: {
                            container: '#quantity-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 3,
                                    message: '* Limit exceeded!'
                                },
                                regexp: {
                                    regexp: /^[_0-9 ]{1,}$/,
                                    message: '* Please enter only alphabets!'
                                },
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
                        lr_number: {
                            container: '#lr_number-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 10,
                                    message: '* Limit exceeded!'
                                },
                                regexp: {
                                    regexp: /^[_A-Za-z0-9]{1,}$/,
                                    message: '* Please enter only alphanumerics!'
                                },
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
                        status_date: {
                            container: '#status_date-error',
                            validators: {
                                notEmpty: {
                                    message: '* This field is required!'
                                },
                            }
                        },
                        status: {
                            container: '#status-error',
                            validators: {
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
                    }
                });
            });
        </script>
        <script>
            $().ready(function () {
                $("form").submit(function (event) {
                    $(this).revalidation();
                });
            });
        </script>
    </body>
</html>

