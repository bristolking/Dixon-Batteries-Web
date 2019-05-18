<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Update Category</title>
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
                        Update Category
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/categories') }}">Categories</a></li>
                        <li><a href="#" class="active">Update Category</a></li>
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
                                <form  id="category-form" action="{{ url('/category/edit') }}/{{ $category->category_id }}"  data-toggle="validator" method="post">
                                    {!! csrf_field() !!}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Category Name <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="category_name" placeholder="Enter category name" value="{{ $category->category_name }}">
                                                <span class="help-block has-error" id="category_name-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Description </label>
                                                <textarea class="form-control" name="category_desc" placeholder="Enter description">{{ $category->category_desc }}</textarea>
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
    </body>
</html>
<script>
    $(document).ready(function () {
        $('#category-form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
            },
            fields: {
                category_name: {
                    container: '#category_name-error',
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
                category_desc: {
                    container: '#category_desc-error',
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

