<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
        <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
        <link href="{{asset('css/material.css')}}">
        <script src="{{asset('js/material.js')}}"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-secondary navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Комунальна лікарня 19</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('frontend.index')}}">Головна</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('frontend.about')}}">Про нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('frontend.calldoctor')}}">Виклик лікаря</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('frontend.record')}}">Запис до лікаря</a>
                    </li>
                </ul>
                @if (auth()->user())
                    <div class="user-form">
                        @if(auth()->user()->role === 'user')
                            <a href="/cabinet-user" class="btn btn-primary">
                                Кабінет {{auth()->user()->name }}
                            </a>
                            <a href="/logout" class="btn btn-danger">Вийти</a>
                        @elseif(auth()->user()->role === 'worker')
                            <a href="/cabinet-doctor" class="btn btn-primary">
                                Кабінет {{auth()->user()->name }}
                            </a>
                            <a href="/logout" class="btn btn-danger">Вийти</a>
                        @elseif(auth()->user()->role === 'admin')
                            <a href="/admin" class="btn btn-primary">
                                Кабінет {{auth()->user()->name }}
                            </a>
                            <a href="/logout" class="btn btn-danger">Вийти</a>
                        @endif
                    </div>
                @else
                <a href="/login" class="btn btn-primary">Вхід</a>
                <a href="/register" class="btn btn-success">Реєстрація</a>
                @endif

            </div>
        </div>
    </nav>

        <slider-vue></slider-vue>

        @yield('content')

        <footer>
            <div class="bg-dark text-white">
                <div class="container">
                    <div class="row">
                        <div class="p-4 col-md-4">
                            <h2 class="mb-4 text-secondary">Комунальна лікарня 19</h2>
                            <p class="text-white">Ми піклуємся про ваше здоровя</p>
                        </div>
                        <div class="p-4 col-md-4">
                            <h2 class="mb-4 text-secondary">Карта сайта</h2>
                            <ul class="list-unstyled">
                                <a href="{{route('frontend.index')}}" class="text-white">Головна</a>
                                <br>
                                <a href="{{route('frontend.about')}}" class="text-white">Про нас</a>
                                <br>
                                <a href="{{route('frontend.services')}}" class="text-white">Послуги</a>
                                <br>
                            </ul>
                        </div>
                        <div class="p-4 col-md-4">
                            <h2 class="mb-4">Контакти</h2>
                            <p>
                                <a href="tel:+246 - 542 550 5462" class="text-white">
                                    <i class="fa d-inline mr-3 text-secondary fa-phone"></i>+246 - 542 550 5462</a>
                            </p>
                            <p>
                                <a href="mailto:info@pingendo.com" class="text-white">
                                    <i class="fa d-inline mr-3 text-secondary fa-envelope-o"></i>info@pingendo.com</a>
                            </p>
                            <p>
                                <a href="https://goo.gl/maps/AUq7b9W7yYJ2" class="text-white" target="_blank">
                                    <i class="fa d-inline mr-3 fa-map-marker text-secondary"></i>Хмельницького 12</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>