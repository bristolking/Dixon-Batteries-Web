<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dixon-Batteries | Promotions</title>
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
                    <h1>Promotions<small>List</small></h1>
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
                <section class="content" ng-app="promotionsApp" ng-controller="promotionsController" ng-cloak="">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <button id="btnExport" name="btnExport" style="display:none" ng-json-export-excel data="filteredItemsdata" 
                report-fields="{title: 'Title',content:'Content',expiry_date:'Expiry Date',created_at:'Date/Time'}" filename =" 'Promotions' "></button>
                                    <button class="btn btn-primary btn-xs mrg pull-left" ng-click="exportExcel()">Export CSV</button>
                                    <a href="{{ url('/promotion/add')}}" class="btn btn-primary btn-xs mrg pull-right">Add</a>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-1" >
                                            <select class="form-control select2" ng-model="entryLimit">
                                                <option>5</option>
                                                <option >10</option>
                                                <option>20</option>
                                                <option>50</option>
                                                <option>100</option>
                                            </select>  
                                        </div>
                                        <div class="col-md-3 pull-right" > 
                                            <input type="text" class="form-control" ng-model="search" ng-change="filter()" placeholder="Search" />
                                        </div>
                                    </div><br/>
                                    <div id="exportable">
                                    <table id="" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5%"> S No <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                <th ng-click="sort_by('title');"> Title <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                <th ng-click="sort_by('content');"> Content <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                <th ng-click="sort_by('image_path');"> Image <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                <th ng-click="sort_by('expiry_date');"> Expiry <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                <th ng-click="sort_by('status');" width="8%"> Status <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                <th width="8%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody ng-show="filteredItems > 0">
                                            <tr ng-repeat="data in filtered = (list| filter:search | orderBy : predicate :reverse) | startFrom:(currentPage - 1) * entryLimit | limitTo:entryLimit">
                                                <td>@{{$index+1 + (entryLimit * (currentPage-1))}}</td>
                                                <td>@{{ data.title}}</td>
                                                <td>@{{ data.content}}</td>
                                                <td><img src="@{{ data.image_path }}" style="width: 30%"/></td>
                                                <td>@{{ data.expiry_date }}</td>
                                                <td ng-if="data.status == '1'" style="text-align:center">
                                                    <a href="">
                                                        <span class="label label-success">
                                                            Published
                                                        </span>
                                                    </a>
                                                </td>
                                                <td ng-if="data.status == '0'" style="text-align:center">
                                                    <a href="">
                                                        <span class="label label-danger" ng-click="update_status(data.promotion_id, 1)">
                                                            Publish
                                                        </span>
                                                    </a>
                                                </td>
                                                <td style="text-align:center">
                                                    <a href="{{ url('/promotion/view')}}/@{{ data.promotion_id}}" class="btn btn-warning btn-xs mrg"><i class="fa fa-eye"></i></a>
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

            var app = angular.module('promotionsApp', ['ui.bootstrap','ngJsonExportExcel']);
            //For List
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
            app.filter('startFrom', function () {
            return function (input, start) {
            if (input) {
            start = + start; //parse to int
            return input.slice(start);
            }
            return [];
            }
            });
            app.controller('promotionsController', function ($scope, $http, $timeout) {
            $http({
            method: 'GET',
                    url: '{{ url('promotions_list_json') }}'
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
                    url: '{{ url('promotions_list_json') }}'
            }).then(function successCallback(response) {
            $scope.list = response.data;
            $scope.currentPage = 1;
            $scope.entryLimit = 10;
            $scope.filteredItems = $scope.list.length;
            $scope.totalItems = $scope.list.length;
            });
            };
            $scope.update_status = function (id, status){
            $http({
            method: 'GET',
                    url: '{{ url('update_status') }}/promotions/' + id + '/' + status
            }).then(function successCallback(response) {
            $scope.reload();
            });
            }
            $scope.exportExcel = function () {
            document.getElementById('btnExport').click();
            }
            });
            //For List 

        </script>
    </body>
</html>
