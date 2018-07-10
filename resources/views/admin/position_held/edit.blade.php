@extends('layouts.admin')
@section('title', 'Edit Page Title')

@section('css')

    <link href="{{ asset('/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/plugins/switchery/switchery.css') }}" rel="stylesheet">

    @parent

@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Редагувати посаду: {{$data->title}}</h2>
            <ol class="breadcrumb">
                <li>
                    {{ link_to_route('admin.index', 'Головна') }}
                </li>
                <li>
                    {{ link_to_route('position-held.index', 'Посади') }}
                </li>
                <li class="active">
                    <strong>Редагувати посади</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        {{ Form::model($data, ['route' => ['position-held.update', $data->id], 'method' =>'PUT' ]) }}
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Дані</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="control-label">Назва</label>
                            <div class="">
                                {!! Form::text('name', null, array('class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::submit('Обновити', array('class'=>'btn btn-primary dim')) !!}
        {!! Form::close() !!}
    </div>

@endsection

@section('javascript')
    @parent
    <!-- Switchery -->
    <script src="/js/plugins/switchery/switchery.js"></script>


    <script>
        $(document).ready(function () {


            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, {color: '#1AB394', secondaryColor: "#ED5565"});

        });
    </script>
@endsection