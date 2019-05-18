<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Create Promotion</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('admin/includes/styles')

        <style>
            .datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top {
                top: 75.4px !important;
                border: 1px solid #dedede;
            }
        </style>
        <!-- Daterange picker -->
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
                        Create Promotion
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/promotions') }}">Promotions</a></li>
                        <li><a href="#" class="active">Create Promotion</a></li>
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
                                <form  id="category-form" action="{{ url('/promotion/add') }}"  data-toggle="validator" method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Title <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter title(max:50 characters)">
                                                <span class="help-block has-error" id="title-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Content <span class="label-star">*</span></label>
                                                <textarea class="form-control" name="content" placeholder="Enter content(max:120 characters)">{{ old('content') }}</textarea>
                                                <span class="help-block has-error" id="content-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Expiry Date <span class="label-star">*</span></label>
                                                <input type="text" class="form-control datepicker" readonly="" name="expiry_date" placeholder="Enter expiry date" value="{{ old('expiry_date') }}">
                                                <span class="help-block has-error" id="expiry_date-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Upload Image</label>
                                                <input id="upload_pic" type="file" accept="image/*" name="pic" onchange="loadFile(event)"/>
                                                <span class="help-block" id="img-show" style="color: red;"></span>
                                                <img id="show_upload" style="max-width:80px;"/>
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
                var today = "@php echo date('d-m-Y') @endphp";
                $('.datepicker').datepicker({
                    format: "dd-mm-yyyy",
                    todayHighlight: true,
                    startDate: today,
                    autoclose: true,
                }).on('change.dp', function (e) {
                    $(this).closest('form').bootstrapValidator('revalidateField', 'expiry_date');
                });
                //Date Picker
            });
        </script>
        <script>
            var loadFile = function (event) {
                var type = event.target.files[0].type;
                var size = event.target.files[0].size;
                if (type == 'image/jpeg' || type == 'image/png' || type == 'image/gif' || type == 'image/tiff' || type == 'image/x-icon') {
                    if (size <= '1033414') {
                        //Get Image Width and Heght
                        var _URL = window.URL || window.webkitURL;
                        var file, img;
                        if ((file = event.target.files[0])) {
                            img = new Image();
                            img.onload = function () {
                                var width = this.width;
                                var height = this.height;
                                // (width >= 950 && width <= 1000) && 
                                // && height <= 190
//                                if (height >= 175) {
                                    var output = document.getElementById('show_upload');
                                    output.src = URL.createObjectURL(event.target.files[0]);
                                    $("#img-show").hide();
                                    $("#submitbtn").attr("disabled", false);
//                                } else {
//                                    output = '';
//                                    $("#upload_pic").val('');
//                                    var output = '';
//                                    output.src = '';
//                                    $("#img-show").html("* The image height doesn't matched!");
//                                    $("#img-show").show();
//                                    alert('* The image height should be greater-than 175');
//                                }
                            };
                            img.src = _URL.createObjectURL(file);
                        }

                        //Get Image Width and Heght
                    } else {
                        output = '';
                        $("#upload_pic").val('');
                        var output = document.getElementById('show_upload');
                        output.src = '';
                        $("#img-show").html("* Please select image  below 1mb.");
                        $("#img-show").show();
                    }

                } else {
                    output = '';
                    $("#upload_pic").val('');
                    var output = document.getElementById('show_upload');
                    output.src = '';
                    $("#img-show").html("* Please select image only.");
                    $("#img-show").show();
                }
            };
        </script>
        <script>
            $(document).ready(function () {
                $('#category-form').bootstrapValidator({
                    message: 'This value is not valid',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                    },
                    fields: {
                        title: {
                            container: '#title-error',
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
                        content: {
                            container: '#content-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 120,
                                    message: '* Limit exceeded!'
                                },
                                notEmpty: {
                                    message: '* This field is required!'
                                },
                            }
                        },
                        expiry_date: {
                            container: '#expiry_date-error',
                            validators: {
                                notEmpty: {
                                    message: '* This field is required!'
                                },
                            }
                        },
                    }
                });
            });
        </script>
    </body>
</html>


