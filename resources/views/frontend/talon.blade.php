@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right"></label>
                            <h3>Талон на прийом до лікаря</h3>
                            <div class="col-md-6">
                                <p><strong>Адреса:</strong> {{$department['address']}}</p>
                                <p>
                                    <strong>Працієнт:</strong>
                                    {{$data->user->second_name}} {{$data->user->name}} {{$data->user->last_name}}
                                </p>
                                <p>
                                    <strong>Лікар:</strong>
                                    {{$data->doctor->second_name}} {{$data->doctor->name}} {{$data->doctor->last_name}}
                                </p>

                                <p><strong>Дата:</strong> {{explode(' ', $data['date'])[0]}}</p>
                                <p><strong>Початок прийому:</strong> {{$data['start']}}</p>
                                <p><strong>Закінчення прийому:</strong> {{$data['end']}}</p>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    p {
        font-size: 16px;
    }
</style>