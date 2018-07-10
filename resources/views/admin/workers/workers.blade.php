@extends('layouts.admin')
@section('title', 'Page Title')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Список працівників</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.index') }}">Головна </a>
                </li>
                <li class="active">
                    <strong>Список працівників</strong>
                </li>
            </ol>
        </div>
        <div class="ibox-title">
            <div class="ibox-tools">
                <a href="{{ route('workers.create') }}" class="btn btn-primary btn-xs">Створити нового працівника</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                            <thead>
                            <tr>
                                <th data-toggle="true">Імя</th>
                                <th data-hide="all">Прізвище</th>
                                <th data-hide="all">Побатькові</th>
                                <th data-hide="all">Посада</th>
                                <th data-hide="all">Спеціалізація</th>
                                <th data-hide="all">Назва відділу</th>
                                <th data-hide="all">Адресса відділу відділу</th>
                                <th class="text-right" data-sort-ignore="true">Дія</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>
                                        {{$item->name}}
                                    </td>
                                    <td>
                                        {{$item->second_name}}
                                    </td>
                                    <td>
                                        {{$item->last_name}}
                                    </td>
                                    <td>
                                        {{$item->positionWorker}}
                                    </td>
                                    <td>
                                        {{$item->specializationWorker}}
                                    </td>
                                    <td>
                                        {{$item->departmentName}}
                                    </td>
                                    <td>
                                        {{$item->departmentAddress}}
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            {{ link_to_route('workers.show', 'Переглянути', ['id'=>$item->idWorker], ['class'=>'btn-white btn btn-xs']) }}
                                            {{ link_to_route('workers.edit', 'Редагувати', ['id'=>$item->idWorker], ['class'=>'btn-white btn btn-xs']) }}
                                            {{ Form::open(['method' => 'DELETE', 'route' => ['workers.destroy', $item->idWorker]]) }}
                                            {{ Form::submit('Видалити', ['class' => 'btn btn-danger btn btn-xs']) }}
                                            {{ Form::close() }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection