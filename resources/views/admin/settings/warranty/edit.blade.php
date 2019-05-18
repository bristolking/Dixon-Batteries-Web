<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Settings</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        @include('admin/includes/styles')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div id="load"></div>
        <div class="wrapper">
            @include('admin/includes/header')

            @include('admin/includes/sidemenu')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Settings</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Settings</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="col-md-3">
                                        <div class="box box-primary">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Settings List</h3>
                                            </div>
                                            <ul class="nav nav-pills nav-stacked">
                                                <li class="active"><a href="">Warranty</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
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
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Update Warranty</h3>
                                            </div>
                                            <div class="box-body ">
                                                <form  id="category-form" action="{{ url('/settings/warranty/edit') }}/{{ $warranty->warranty_id }}"  data-toggle="validator" method="post">
                                                    {!! csrf_field() !!}
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label for="">Warranty(In Months) <span class="label-star">*</span> </label>
                                                                <input type="text" class="form-control" name="months" value="{{ $warranty->months }}" placeholder="Enter months">
                                                                <span class="help-block has-error" id="months-error"/>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="">Description </label>
                                                                <textarea class="form-control" name="description" placeholder="Enter description">{{ $warranty->description }}</textarea>
                                                                <span class="help-block has-error" id="description-error"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-body -->

                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            @include('admin/includes/footer')
            <div class="control-sidebar-bg"></div>
        </div>
        @include('admin/includes/scripts')
        <script>
            $(document).ready(function () {
                $('#category-form').bootstrapValidator({
                    message: 'This value is not valid',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                    },
                    fields: {
                        months: {
                            container: '#months-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 2,
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
                        description: {
                            container: '#description-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 150,
                                    message: '* Limit exceeded!'
                                },
                            }
                        },
                    }
                });
            });
        </script>
    </body>
</html>
