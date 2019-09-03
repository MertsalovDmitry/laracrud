@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/laravel.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('title', 'Positions')

@section('content_header')
    <h1>
        Positions
        <a href="javascript:void(0)" class="btn btn-primary btn-flat btn-sm pull-right" id="create-new-position">Add position</a>
    </h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Positions list</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <table id="positions-table" class="table table-bordered table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th style="width:15%">Last update</th>
                        <th style="width:7%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- include edit.blade.php -->
    @include('dashboard.positions.edit')

    <!-- include delete.blade.php -->
    @include('dashboard.positions.delete')
@stop

@section('js')
    <!-- include scripts.blade.php -->
    @include('dashboard.positions.scripts')
@stop