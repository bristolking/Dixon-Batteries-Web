<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Orders</title>
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
                    <h1>Orders<small>List</small></h1>
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
                        <li><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">List</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content" ng-app="orderApp" ng-controller="orderController" ng-cloak="">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
        <button id="btnExport" name="btnExport" style="display:none" ng-json-export-excel data="filteredItemsdata" 
                report-fields="{name: 'Dealer',dealer_code:'Dealer Code',order_number:'Order Number',model:'Product',category_name:'Category',sub_category_name:'Warranty/Life',lr_number:'LR Number',quantity:'Quantity',accepted_date:'Accepted Date',dispatched_date:'Dispatched Date',pending_date:'Pending Date',declined_date:'Declined Date',delivered_date:'Delivered Date',created_at:'Date/Time'}" filename =" 'Orders' "></button>
                                    <button class="btn btn-primary btn-xs mrg pull-left" ng-click="exportExcel()">Export CSV</button>
                                    <a href="{{ url('/order/add')}}" class="btn btn-primary btn-xs mrg pull-right">Add</a>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-1" >
                                            <select class="form-control select2" ng-model="entryLimit">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>  
                                        </div>
                                        <div class="col-md-3" >
                                            <select class="form-control select2" ng-model="a.dealer_code" ng-change="filter()">
                                                <option value="">Please select dealer...</option>
                                                @if(isset($dealers) && !empty($dealers))
                                                @foreach($dealers as $dealer)
                                                <option value="{{ $dealer->dealer_code }}">{{ $dealer->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>  
                                        </div>
                                        <div class="col-md-3" >
                                            <select class="form-control select2" ng-model="b.model" ng-change="filter()">
                                                <option value="">Please select product...</option>
                                                @if(isset($products) && !empty($products))
                                                @foreach($products as $product)
                                                <option value="{{ $product->model }}">{{ $product->model }}</option>
                                                @endforeach
                                                @endif
                                            </select>  
                                        </div>
                                        <div class="col-md-3" >
                                            <select class="form-control select2" ng-model="c.status" ng-change="filter()">
                                                <option value="">Please select status...</option>
                                                <option value="1">Accepted</option>
                                                <option value="2">Dispatched</option>
                                                <option value="3">Pending</option>
                                                <option value="4">Declined</option>
                                                <option value="5">Delivered</option>
                                            </select>  
                                        </div>
                                        <div class="col-md-2 pull-right" > 
                                            <input type="text" class="form-control" ng-model="search" ng-change="filter()" placeholder="Search" />
                                        </div>
                                    </div><br/>
                                    <div id="exportable">
                                        <table id="" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th ng-click="sort_by('order_id');" width="9%"> S No <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                    <th ng-click="sort_by('name');"> Dealer <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                    <th ng-click="sort_by('dealer_code');" width="12%">Dealer Code <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                    <th ng-click="sort_by('order_number');" width="13%"> Order Number <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                    <th ng-click="sort_by('model');" width="13%"> Product <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                    <th ng-click="sort_by('category_name');" width="13%"> Category <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                    <th ng-click="sort_by('quantity');" width="10%"> Quantity <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                    <th ng-click="sort_by('ordered_date');" width="10%"> Order Date <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                    <th ng-click="sort_by('status');" width="9%"> Status <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                    <th width="8%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody ng-show="filteredItems > 0">
                                                <tr ng-repeat="data in filtered = (list| filter:search | filter:a | filter:b | filter:c | orderBy : predicate :reverse) | startFrom:(currentPage - 1) * entryLimit | limitTo:entryLimit">
                                                    <td>@{{$index+1 + (entryLimit * (currentPage-1))}}</td>
                                                    <td><a href="{{ url('/dealer/view') }}/@{{ data.dealer_id }}">@{{ data.name}}</a></td>
                                                    <td>@{{ data.dealer_code}}</td>
                                                    <td>@{{ data.order_number}}</td>
                                                    <td><a href="{{ url('/product/view') }}/@{{ data.product_id }}">@{{ data.model}}</a></td>
                                                    <td>@{{ data.category_name }}</td>
                                                    <td>@{{ data.quantity}}</td>
                                                    <td>@{{ data.ordered_date }}</td>
                                                    <td style="text-align:center">
                                                        <a href="" ng-if="data.status == '1'">
                                                            <span class="label label-primary" popover="@{{ data.accepted_date }}" data-popover-trigger="mouseenter">
                                                                Accepted
                                                            </span>
                                                        </a>
                                                        <a href="" ng-if="data.status == '2'">
                                                            <span class="label label-info" popover="@{{ data.dispatched_date }}" data-popover-trigger="mouseenter">
                                                               Dispatched
                                                            </span>
                                                        </a>
                                                        <a href="" ng-if="data.status == '3'">
                                                            <span class="label label-warning" popover="@{{ data.pending_date }}" data-popover-trigger="mouseenter">
                                                                Pending
                                                            </span>
                                                        </a>
                                                        <a href="" ng-if="data.status == '4'">
                                                            <span class="label label-danger" popover="@{{ data.declined_date }}" data-popover-trigger="mouseenter">
                                                                Declined
                                                            </span>
                                                        </a>
                                                        <a href="" ng-if="data.status == '5'">
                                                            <span class="label label-success"  popover="@{{ data.delivered_date }}" data-popover-trigger="mouseenter">
                                                                Delivered
                                                            </span>
                                                        </a>
                                                    </td>
                                                    <td style="text-align:center">
                                                        <a href="{{ url('/order/view')}}/@{{ data.order_id}}" class="btn btn-warning btn-xs mrg"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
                                                        <a href="{{ url('/order/edit')}}/@{{ data.order_id}}" class="btn btn-info btn-xs mrg"><i class="fa fa-pencil"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div ng-show="filteredItems == 0" style="text-align: center;margin-top: 20px;">
                                        No matching records found
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4" style="margin-top: 35px;">
                                            Showing @{{ filtered.length}} of @{{ totalItems}} entries
                                        </div>
                                        <div class="pull-right" ng-show="filteredItems > 0" style="margin-right: 15px;"> 
                                            <pagination ng-model="currentPage" on-select-page="setPage(page)" total-items="filteredItems" items-per-page="entryLimit" max-size="5" boundary-links="true">
                                            </pagination>
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
                                                var app = angular.module('orderApp', ['ui.bootstrap','ngJsonExportExcel']);
                                                app.directive('select2', function () {
                                                    return {
                                                      restrict: 'C',
                                                      require: 'ngModel',
                                                      link: function (scope, element, attrs, ngModel) {
                                                        var $el = $(element);
                                                        $el.select2({
                                                          style: 'btn-default',
                                                          size: false
                                                        });
                                                        $el.on('change', function (ee, aa) {
                                                          ngModel.$setViewValue($el.val());
                                                          scope.$apply();
                                                        });
                                                      }
                                                    };
                                                  });
                                                //For List
                                                app.filter('startFrom', function () {
                                                return function (input, start) {
                                                if (input) {
                                                start = + start; //parse to int
                                                return input.slice(start);
                                                }
                                                return [];
                                                }
                                                });
                                                app.controller('orderController', function ($scope, $http, $timeout) {
                                                       
                                                $http({
                                                method: 'GET',
                                                        url: '{{ url('orders_list_json') }}'
                                                }).then(function successCallback(response) {
                                                $scope.list = response.data;
                                                $scope.currentPage = 1;
                                                $scope.entryLimit = 10;
                                                $scope.filteredItems = $scope.list.length;
                                                $scope.filteredItemsdata = $scope.list;
                                                $scope.totalItems = $scope.list.length;
                                                });
                                                $scope.setPage = function (pageNo) {
                                                $scope.currentPage = pageNo;
                                                };
                                                $scope.filter = function () {
                                                $timeout(function () {
                                                $scope.filteredItems = $scope.filtered.length;
                                                $scope.filteredItemsdata = $scope.filtered;
                                                }, 10);
                                                };
                                                $scope.sort_by = function (predicate) {
                                                $scope.predicate = predicate;
                                                $scope.reverse = !$scope.reverse;
                                                };
                                                $scope.reload = function (predicate) {
                                                $http({
                                                method: 'GET',
                                                        url: '{{ url('orders_list_json') }}'
                                                }).then(function successCallback(response) {
                                                $scope.list = response.data;
                                                $scope.currentPage = 1;
                                                $scope.entryLimit = 10;
                                                $scope.filteredItems = $scope.list.length;
                                                $scope.totalItems = $scope.list.length;
                                                });
                                                };
                                                $scope.exportExcel = function () {
                                                document.getElementById('btnExport').click();
                                                }
                                                });
                                                //For List 

        </script>
    </body>
</html>
