<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Create Product</title>
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
                        Create Product
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/products') }}">Products</a></li>
                        <li><a href="#" class="active">Create Product</a></li>
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
                                <form  id="product-form" action="{{ url('/product/add') }}"  data-toggle="validator" method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Model <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="model" value="{{ old('model') }}" placeholder="Enter model">
                                                <span class="help-block has-error" id="model-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Container <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="container" value="{{ old('container') }}" placeholder="Enter container">
                                                <span class="help-block has-error" id="container-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Capacity <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="capacity" value="{{ old('capacity') }}" placeholder="Enter capacity">
                                                <span class="help-block has-error" id="capacity-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Length(Dimention:MM) <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="length" value="{{ old('length') }}" placeholder="Enter length">
                                                <span class="help-block has-error" id="length-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Width(Dimention:MM) <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="width" value="{{ old('width') }}" placeholder="Enter width">
                                                <span class="help-block has-error" id="width-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Height(Dimention:MM) <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="height" value="{{ old('height') }}" placeholder="Enter height">
                                                <span class="help-block has-error" id="height-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Charging Current <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="charging_current" value="{{ old('charging_current') }}" placeholder="Enter charging current">
                                                <span class="help-block has-error" id="charging_current-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Filled Weight <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="filled_weight" value="{{ old('filled_weight') }}" placeholder="Enter filled weight">
                                                <span class="help-block has-error" id="filled_weight-error"/>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Category </label>
                                                <select class="form-control select2" onchange="get_sub_categories(this.value);">
                                                    <option value="">Please select...</option>
                                                    @if(isset($categories) && !empty($categories))
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Warranty/Life <span class="label-star">*</span></label>
                                                <select class="form-control select2" id="sub_categories" name="sub_category_id" value="{{ old('sub_category_id') }}">
                                                    <option value="">Please select...</option>
                                                </select>
                                                <div class="overlay" id="overlay" style="display:none;">
                                                    <i class="fa fa-refresh fa-spin"></i>
                                                </div>
                                                <span class="help-block has-error" id="sub_category_id-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Points <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="points" value="{{ old('points') }}" placeholder="Enter points">
                                                <span class="help-block has-error" id="points-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Price <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="price" value="{{ old('price') }}" placeholder="Enter price">
                                                <span class="help-block has-error" id="price-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Upload Images</label>
                                                <input id="upload_pic" type="file" accept="image/*" name="pic[]" multiple="" onchange="loadFile(event)"/>
                                                <span class="help-block" id="img-show"></span>
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
            var loadFile = function (event) {
                var type = event.target.files[0].type;
                if (type == 'image/jpeg' || type == 'image/png' || type == 'image/gif' || type == 'image/tiff' || type == 'image/x-icon') {
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
                            if (height >= 175) {
                                //                        var output = document.getElementById('show_upload');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                $("#img-show").hide();
                                $("#submitbtn").attr("disabled", false);
                            } else {
                                output = '';
                                $("#upload_pic").val('');
                                //                        var output = document.getElementById('show_upload');
                                output.src = '';
                                $("#img-show").html("Image height doesn't matched!");
                                $("#img-show").show();
                                alert('The image height should be greater-than 175');
                            }
                        };
                        img.src = _URL.createObjectURL(file);
                    }

                    //Get Image Width and Heght

                } else {
                    output = '';
                    $("#upload_pic").val('');
                    var output = document.getElementById('show_upload');
                    output.src = '';
                    $("#img-show").html("Please select image only!");
                    $("#img-show").show();
                }
            };
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
                        model: {
                            container: '#model-error',
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
                        container: {
                            container: '#container-error',
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
                        capacity: {
                            container: '#capacity-error',
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
                        length: {
                            container: '#length-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 3,
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
                        width: {
                            container: '#width-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 3,
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
                        height: {
                            container: '#height-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 3,
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
                        charging_current: {
                            container: '#charging_current-error',
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
                        filled_weight: {
                            container: '#filled_weight-error',
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
                        sub_category_id: {
                            container: '#sub_category_id-error',
                            validators: {
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
                        points: {
                            container: '#points-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 3,
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
                        price: {
                            container: '#price-error',
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
                    }
                });
            });



            function get_sub_categories(category_id) {
                if (category_id != '') {
                    $("#overlay").show();
                    var select_id = '';
                    $.ajax({
                        url: "{{ url('get_sub_categories') }}",
                        type: "POST",
                        dataType: "JSON",
                        data: {category_id: category_id, select_id: select_id},
                        success: function (response) {
                            $("#sub_categories").html(response);
                            $("#overlay").hide();
                        }
                    })
                } else {
                    $("#sub_categories").html('');
                }
            }
        </script>
    </body>
</html>


