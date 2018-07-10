@extends('layouts.frontend')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="news">
                        <div class="image">
                            <img src="{{asset('image/1.jpg')}}">
                        </div>
                        <div class="short-description">
                            <p>У вигляді гуманітарної допомоги надала 5
                                інфузоматів "Numia Microfose", що забезпечить
                                дозовану подачу медикаментів з наперед заданим часом введення їх пацієнтам ,
                                це значно полегшить роботу медичного персоналу.
                            </p>
                            <a href="#">Подробніше</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

<style>
    .news {
        display: flex;
    }

    .image {
        flex: 1 1 25%;
    }

    .image img {
        max-width: 400px;
    }

    .short-description {
        flex: 1 1 75%;
        padding-left: 15px;
    }
</style>