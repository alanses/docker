@extends('layouts.account')

@section('content')
        <doctor-cabinet :doctor="{{json_encode($user)}}"></doctor-cabinet>
@endsection