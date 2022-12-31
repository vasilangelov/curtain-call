@extends('layouts.app')

@section('content')
    <div class="breadcrumbs d-flex align-items-center"
         style="background-image: url('/assets/img/hero.jpg'); background-position: bottom center">
        <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">
            <div class="d-flex align-items-center gap-5">
                <a href="/{{ $performance->poster ?? 'assets/img/no_poster.png' }}"
                   class="d-block glightbox mb-4">
                    <img src="/{{ $performance->poster ?? 'assets/img/no_poster.png' }}"
                         class="img-fluid"
                         style="object-fit: contain; max-height: 20rem;"
                         alt="{{ $performance->name }} poster">
                </a>

                <div class="text-center">
                    <h2>{{ $performance->name }}</h2>
                    <p style="color: #fff; font-weight: 100;">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        {{ $performance->theater }}, {{ $performance->city }}
                    </p>
                    <p style="color: #fff; font-weight: 100;">
                        <i class="fa fa-clock"></i> {{ $performance->performance_date->format('d F Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section class="mx-auto" style="max-width: min(60rem, 90%)">
        <h2 class="text-center mb-5">About</h2>

        {!! $performance->description !!}
    </section>

    <section id="tickets" class="mx-auto" style="max-width: min(60rem, 90%)">
        <h2 class="text-center"><i class="fa fa-ticket"></i> Tickets <i class="fa fa-ticket"></i></h2>

        <ul class="text-center mt-4">
            @foreach($performance->tickets as $ticket)
                <li class="my-3" style="font-size: 1.25rem">{{ $ticket->type }} - {{ number_format($ticket->price, 2, ',') }} BGN</li>
            @endforeach
        </ul>
    </section>
@endsection
