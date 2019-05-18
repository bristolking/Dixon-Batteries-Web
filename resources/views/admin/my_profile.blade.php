<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Profile</title>
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
                        My Profile
                    </h1>
                    @if (Session::has('success'))
                    <ol id="alert" style="color:green;">
                        {!! session('success') !!}
                    </ol>
                    @endif
                    @if (Session::has('fail'))
                    <ol id="alert" style="color:red;">
                        {!! session('fail') !!}
                    </ol>
                    @endif
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Profile</a></li>
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
                                <form  id="validateeditaccount" action="{{ url('/my_profile') }}"  data-toggle="validator" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden"  name="row_id" value="{{ $user['id'] }}">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Full Name <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{ $user['name'] }}">
                                                <span class="help-block has-error" id="name-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Email <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="email"  placeholder="Enter email" value="{{ $user['email'] }}">
                                                <span class="help-block has-error" id="email-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Mobile Number <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="mobile_number" placeholder="Enter mobile number" value="{{ $user['mobile_number'] }}">
                                                <span class="help-block has-error" id="mobile_number-error"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
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
                $('#validateeditaccount').bootstrapValidator({
                    message: 'This value is not valid',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                    },
                    fields: {
                        name: {
                            container: '#name-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 50,
                                    message: '* Limit exceeded!'
                                },
                                regexp: {
                                    regexp: /^[_A-za-z ]{1,}$/,
                                    message: '* Please enter only alphabets!'
                                },
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
                        email: {
                            container: '#email-error',
                            validators: {
                                notEmpty: {
                                    message: '* This field is required!'
                                },
                                regexp: {
                                    regexp: /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/,
                                    message: '* Please enter valid email Id!'
                                }
                            }
                        },
                        mobile_number: {
                            container: '#mobile_number-error',
                            validators: {
                                notEmpty: {
                                    message: '* This field is required!'
                                },
                                regexp: {
                                    regexp: /^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/,
                                    message: '* Please enter valid mobile no!'
                                }
                            }
                        },
                    }
                });
            });
        </script>
    </body>
</html>


