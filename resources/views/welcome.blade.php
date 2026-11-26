
@extends('layout.app')

@section('title', 'GETA LAB')

@section('top-content')
    <style>
        .research-detail {
            font-family: 'Arial', sans-serif;
        }

        #carouselExampleIndicators {
            width: 100%;
            margin: 0;
        }

        #carouselExampleIndicators .carousel-item img {
            width: 100%;
            height: 32vw;
            min-height: 350px;
            max-height: 520px;
            object-fit: cover;
            object-position: center;
        }
    </style>

    <div id="carouselExampleIndicators" class="carousel slide mt-4" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                class="active" aria-current="true" aria-label="Slide 1"></button>

            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>

            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://i.pinimg.com/1200x/bd/90/87/bd908749d8af201c2d7b6cd21c401143.jpg"
                    class="d-block w-100" alt="GETA LAB">
            </div>

            <div class="carousel-item">
                <img src="https://i.pinimg.com/736x/16/82/19/16821954abc9197ce94f7587d17da9c0.jpg"
                    class="d-block w-100" alt="GETA LAB">
            </div>

            <div class="carousel-item">
                <img src="https://i.pinimg.com/1200x/be/a2/d5/bea2d5bb3ef3ac9e26bbc1569a2744c9.jpg"
                    class="d-block w-100" alt="GETA LAB">
            </div>
        </div>

        <button class="carousel-control-prev" type="button"
            data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('messages.Previous') }}</span>
        </button>

        <button class="carousel-control-next" type="button"
            data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('messages.Next') }}</span>
        </button>
    </div>
@endsection

@section('content')

    <h2 class="mt-4">{{ __('messages.WelcomeTitle') }}</h2>

    <div style="border-bottom: 1px solid #ddd;">
        <div style="width: 30%; border-bottom: 1px solid #587529;"></div>
    </div>

    <p>{{ __('messages.WelcomeDescription') }}</p>

    <br>

    <p style="text-align: justify; line-height: 1.8;" class="mb-5">
        {{ __('messages.Announcements2026') }}
    </p>

    <p class="mb-5">{{ __('messages.Year2026') }}</p>

    <p style="text-align: justify; line-height: 1.8;">
        {{ __('messages.Announcements2025') }}
    </p>

@endsection
