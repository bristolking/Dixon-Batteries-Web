<!DOCTYPE html>
<html>
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
                        <li class="active">Settings</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content" ng-app="warrantyApp" ng-controller="warrantyController" ng-cloak="">
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
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Warranty List</h3>
                                                <a href="{{ url('/settings/warranty/add')}}" class="btn btn-primary btn-xs mrg pull-right">Add</a>
                                            </div>
                                            <div class="box-body" style="margin-bottom: 103px;">
                                                <div class="row">
                                                    <div class="col-md-2" style="width:11%;">
                                                        <select class="form-control" ng-model="entryLimit">
                                                            <option>5</option>
                                                            <option ng-selected="true">10</option>
                                                            <option>20</option>
                                                            <option>50</option>
                                                            <option>100</option>
                                                        </select>  
                                                    </div>
                                                    <div class="col-md-3 pull-right" > 
                                                        <input type="text" class="form-control" ng-model="search" ng-change="filter()" placeholder="Search" />
                                                    </div>
                                                </div><br/>
                                                <table id="" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th ng-click="sort_by('warranty_id');" width="10%"> Id <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                            <th ng-click="sort_by('months');"> Months <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                            <th ng-click="sort_by('description');"> Description <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                            <th ng-click="sort_by('status');" width="8%"> Status <i class="glyphicon glyphicon-sort-by-attributes"></i></th>
                                                            <th width="10%">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody ng-show="filteredItems > 0">
                                                        <tr ng-repeat="data in filtered = (list| filter:search | orderBy : predicate :reverse) | startFrom:(currentPage - 1) * entryLimit | limitTo:entryLimit">
                                                            <td>@{{ data.warranty_id}}</td>
                                                            <td>@{{ data.months}}</td>
                                                            <td>@{{ data.description}}</td>
                                                            <td ng-if="data.status == '1'" style="text-align:center">
                                                                <a href="">
                                                                    <span class="label label-success" ng-click="update_status(data.warranty_id, 0)">
                                                                        APPROVED
                                                                    </span>
                                                                </a>
                                                            </td>
                                                            <td ng-if="data.status == '0'" style="text-align:center">
                                                                <a href="">
                                                                    <span class="label label-danger" ng-click="update_status(data.warranty_id, 1)">
                                                                        DENIED
                                                                    </span>
                                                                </a>
                                                            </td>
                                                            <td style="text-align:center">
                                                                <a href="{{ url('/settings/warranty/edit')}}/@{{ data.warranty_id}}" class="btn btn-info btn-xs mrg"><i class="fa fa-pencil"></i></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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

            var app = angular.module('warrantyApp', ['ui.bootstrap']);
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
            app.controller('warrantyController', function ($scope, $http, $timeout) {
            $http({
            method: 'GET',
                    url: '{{ url('settings/warranty_list_json') }}'
            }).then(function successCallback(response) {
            $scope.list = response.data;
            $scope.currentPage = 1;
            $scope.entryLimit = 10;
            $scope.filteredItems = $scope.list.length;
            $scope.totalItems = $scope.list.length;
            });
            $scope.setPage = function (pageNo) {
            $scope.currentPage = pageNo;
            };
            $scope.filter = function () {
            $timeout(function () {
            $scope.filteredItems = $scope.filtered.length;
            }, 10);
            };
            $scope.sort_by = function (predicate) {
            $scope.predicate = predicate;
            $scope.reverse = !$scope.reverse;
            };
            $scope.reload = function (predicate) {
            $http({
            method: 'GET',
                    url: '{{ url('/settings/warranty_list_json') }}'
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
                    url: '{{ url('update_status') }}/warranty/' + id + '/' + status
            }).then(function successCallback(response) {
            $scope.reload();
            });
            }
            $scope.exportData = function () {
            var blob = new Blob([document.getElementById('leads_excel').innerHTML], {
            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8"
            });
            saveAs(blob, "Leads " + new Date() + ".xls");
            };
            });
            //For List 

        </script>
    </body>
</html>
