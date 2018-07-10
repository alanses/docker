@extends('layouts.admin')
@section('title', 'Create Page Title')

@section('css')

    <link href="{{ asset('/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/plugins/switchery/switchery.css') }}" rel="stylesheet">

    @parent

@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Створити відділення</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.index') }}">Головна </a>
                </li>
                <li>
                    <a href="{{ route('departments.index') }}">Список відділень </a>
                </li>
                <li class="active">
                    <strong>Створити відділення</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        {{ Form::open(array('route' => 'departments.store','files' => true, 'method' => 'post')) }}
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
                                {!! Form::text('title', null, array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Адресса</label>
                            <div class="">
                                {!! Form::text('address', null, array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Директор</label>
                            <div class="">
                                {!! Form::text('director', null, array('class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::submit('Створити', array('class'=>'btn btn-primary dim')) !!}
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