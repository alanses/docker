@extends('layouts.frontend')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <search-component
                        :departments="{{json_encode($departments)}}"
                        :specializations="{{$specializations}}"
                        :user="{{json_encode(Auth::user()) ?? ''}}"
                    >
                    </search-component>
                </div>
            </div>
        </div>
    </div>
@endsection