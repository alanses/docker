@extends('layouts.admin')
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Список викликів на дім </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <select-patient-for-call-doctor :call_doctor_at_home="{{json_encode($callDoctorsAtHome)}}"></select-patient-for-call-doctor>
                </div>
            </div>
        </div>
    </div>
@endsection