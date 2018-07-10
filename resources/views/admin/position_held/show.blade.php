@extends('layouts.admin')
@section('title', 'Page Title')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $data->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    {{ link_to_route('admin.index', 'Головна') }}
                </li>
                <li>
                    {{ link_to_route('position-held.index', 'Працівники') }}
                </li>
                <li class="active">
                    <strong>{{ $data->title }}</strong>
                </li>
            </ol>
            <a href="{{ route('position-held.edit', $data->id) }}" class="btn btn-info">
                <i class="fa fa-pencil"></i> Редагувати</a>
            {{ Form::open(['method' => 'DELETE', 'route' => ['position-held.destroy', $data->id]]) }}
            {{ Form::submit('Видалити', ['class' => 'btn btn-danger']) }}
            {{ Form::close() }}
        </div>
    </div>

    <div class="row wrapper wrapper-content animated fadeInRight">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <p>{{ $data->name }}</p>
                    <p>{{ $data->count_of_workers}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection