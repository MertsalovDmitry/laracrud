@extends('adminlte::page')

@section('css')
     <link rel="stylesheet" href="{{ asset('css\laravel.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('title', 'Employees')

@section('content_header')
    <h1>
        Employees
        <a href="javascript:void(0)" class="btn btn-primary btn-flat btn-sm pull-right" id="create-new-employee">Add employee</a>
    </h1> 
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Employees list</h3>
        </div>
        <!-- /.box-header -->
    
        <div class="box-body">
            <table id="employees-table" class="table table-bordered table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Created_at</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Positon</th>
                        <th>Date of employment</th>
                        <th>Phone number</th>
                        <th>Email</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- include edit.blade.php -->
    @include('dashboard.employees.edit')
    
    <!-- include delete.blade.php -->
    @include('dashboard.employees.delete')
@stop

@section('js')
    <!-- include scripts.blade.php -->
    @include('dashboard.employees.scripts')
@stop

