@extends('layouts.admin')
@section('title', 'Page Title')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Список посад</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.index') }}">Головна </a>
                </li>
                <li class="active">
                    <strong>Список посад</strong>
                </li>
            </ol>
        </div>
        <div class="ibox-title">
            <div class="ibox-tools">
                <a href="{{ route('position-held.create') }}" class="btn btn-primary btn-xs">Створити нову посаду</a>
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
                                <th data-toggle="true">Номер</th>
                                <th data-toggle="true">Назва</th>
                                <th data-hide="all">Кількість працівників</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $item)
                                <tr>
                                    <td>
                                        {{++$key}}
                                    </td>
                                    <td>
                                        {{$item->name}}
                                    </td>
                                    <td>
                                        {{$item->workersCount}}
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            {{ link_to_route('position-held.show', 'Переглянути', ['id'=>$item->id], ['class'=>'btn-white btn btn-xs']) }}
                                            {{ link_to_route('position-held.edit', 'Редагувати', ['id'=>$item->id], ['class'=>'btn-white btn btn-xs']) }}
                                            {{ Form::open(['method' => 'DELETE', 'route' => ['position-held.destroy', $item->id]]) }}
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