<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Update Target</title>
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
                        Update Target
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/targets') }}">Targets</a></li>
                        <li><a href="#" class="active">Update Target</a></li>
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
                                <form  id="product-form" action="{{ url('/target/edit') }}/{{ $target->target_id }}"  data-toggle="validator" method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Dealer <span class="label-star">*</span></label>
                                                <select class="form-control select2" name="dealer_id" disabled="">
                                                    <option>Please select...</option>
                                                    @if(isset($dealers) && !empty($dealers))
                                                    @foreach($dealers as $dealer)
                                                    @if($dealer->id==$target->dealer_id)
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
                                                <label for="">Month <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" readonly=""  value="{{ $target->month }}" placeholder="Enter month">
                                                <span class="help-block has-error" id="target_amount-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Year <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" readonly=""  value="{{ $target->year }}" placeholder="Enter year">
                                                <span class="help-block has-error" id="target_amount-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Target Amount <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="target_amount" value="{{ $target->target_amount }}" placeholder="Enter target amount">
                                                <span class="help-block has-error" id="target_amount-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Target Quantity </label>
                                                <input type="text" class="form-control" name="target_qty" value="{{ $target->target_qty }}" placeholder="Enter target quantity">
                                                <span class="help-block has-error" id="target_qty-error"/>
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
                        month_year: {
                            container: '#month_year-error',
                            validators: {
                                notEmpty: {
                                    message: '* This field is required!'
                                },
                            }
                        },
                        target_amount: {
                            container: '#target_amount-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 8,
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
                         target_qty: {
                            container: '#target_qty-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 6,
                                    message: '* Limit exceeded!'
                                },
                                regexp: {
                                    regexp: /^(0*[1-9][0-9]*(\.[0-9]+)?|0+\.[0-9]*[1-9][0-9]*)$/,
                                    message: '* Please enter numbers more than 0!'
                                },
                            }
                        },
                    }
                });
            });

        </script>
    </body>
</html>


