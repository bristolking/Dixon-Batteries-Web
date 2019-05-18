<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Update Dealer</title>
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
                        Update Dealer
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url ( '/' ) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('/dealers') }}">Dealers</a></li>
                        <li><a href="#" class="active">Update Dealer</a></li>
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
                                <form  id="dealer-form" action="{{ url('/dealer/edit') }}/{{ $dealer->id }}"  data-toggle="validator" method="post">
                                    {!! csrf_field() !!}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Full Name <span class="label-star">*</span> </label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{ $dealer->name }}">
                                                <span class="help-block has-error" id="name-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Firm Name <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="firm_name" value="{{ $dealer->firm_name }}"  placeholder="Enter firm name" >
                                                <span class="help-block has-error" id="firm_name-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Address </label>
                                                <textarea class="form-control" name="address" placeholder="Enter address">{{ $dealer->address }}</textarea>
                                                <span class="help-block has-error" id="address-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Location <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="location" value="{{ $dealer->location }}"  placeholder="Enter location" >
                                                <span class="help-block has-error" id="location-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Email <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="email"  placeholder="Enter email" value="{{ $dealer->email }}">
                                                <span class="help-block has-error" id="email-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Mobile Number <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="mobile_number" placeholder="Enter mobile number" value="{{ $dealer->mobile_number }}">
                                                <span class="help-block has-error" id="mobile_number-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Dealer Code <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="dealer_code" placeholder="Enter dealer code" value="{{ $dealer->dealer_code }}">
                                                <span class="help-block has-error" id="dealer_code-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">GST No <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="gst_no" placeholder="Enter GST No" value="{{ $dealer->gst_no }}">
                                                <span class="help-block has-error" id="gst_no-error"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">VAT No <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="vat_no" value="{{ $dealer->vat_no }}" placeholder="Enter VAT No">
                                                <span class="help-block has-error" id="vat_no-error"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Rating <span class="label-star">*</span></label>
                                                <input type="text" class="form-control" name="rating" value="{{ $dealer->rating }}" placeholder="Enter rating">
                                                <span class="help-block has-error" id="rating-error"/>
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
        $('#dealer-form').bootstrapValidator({
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
                        firm_name: {
                            container: '#firm_name-error',
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
                         address: {
                            container: '#address-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 150,
                                    message: '* Limit exceeded!'
                                },
                            }
                        },
                        location: {
                            container: '#location-error',
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
                        dealer_code: {
                            container: '#dealer_code-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 50,
                                    message: '* Limit exceeded!'
                                },
                                regexp: {
                                    regexp: /^[_A-za-z0-9 ]{1,}$/,
                                    message: '* Please enter only alphabets&numbers!'
                                },
                                notEmpty: {
                                    message: '* This field is required!'
                                }
                            }
                        },
                        gst_no: {
                            container: '#gst_no-error',
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
                        vat_no: {
                            container: '#vat_no-error',
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
                        rating: {
                            container: '#rating-error',
                            validators: {
                                stringLength: {
                                    min: 1,
                                    max: 1,
                                    message: '* Limit exceeded!'
                                },
                                regexp: {
                                    regexp: /^[_0-5 ]{1,}$/,
                                    message: '* Please enter only numbers with Min 1 and Max of 5!'
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

