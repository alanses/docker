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
                    {{ link_to_route('workers.index', 'Працівники') }}
                </li>
                <li class="active">
                    <strong>{{ $data->name }}</strong>
                </li>
            </ol>
            <a href="{{ route('workers.edit', $data->idWorker) }}" class="btn btn-info">
                <i class="fa fa-pencil"></i> Редагувати</a>
            {{ Form::open(['method' => 'DELETE', 'route' => ['workers.destroy', $data->idWorker]]) }}
            {{ Form::submit('Видалити', ['class' => 'btn btn-danger']) }}
            {{ Form::close() }}
        </div>
    </div>
    <div class="row wrapper wrapper-content animated fadeInRight">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <img class="image-profile" src="{{asset('images/User/' . $data->image)}}">
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <p><strong>Імя: </strong><span>{{ $data->name }}</span></p>
                    <p><strong>Прізвище: </strong><span>{{ $data->second_name }}</span></p>
                    <p><strong>Побатькові: </strong><span>{{ $data->last_name }}</span></p>
                    <p><strong>Номер паспорта: </strong><span>{{ $data->passport_id }}</span></p>
                    <p><strong>Емейл: </strong><span>{{ $data->email }}</span></p>
                    <p><strong>Посада лікаря: </strong><span>{{ $data->positionWorker }}</span></p>
                    <p><strong>Спеціалізація лікаря: </strong><span>{{ $data->specializationWorker }}</span></p>
                    <p><strong>Відділ роботи: </strong><span>{{ $data->departmentName }}</span></p>
                </div>
            </div>
        </div>
    </div>


    <style>
        .image-profile {
            max-width: 220px;
            max-height: 220px;
        }
    </style>

@endsection