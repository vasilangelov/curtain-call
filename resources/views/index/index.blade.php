@extends('layouts/app')

@section('content')
    <main id="main">
        <div class="breadcrumbs d-flex align-items-center"
             style="background-image: url(assets/img/hero.jpg); background-position: bottom center">
            <div class="container position-relative d-flex flex-column align-items-center text-light" data-aos="fade">
                <h1 style="font-size: 4rem">Curtain Call</h1>
                <p style="font-size: 1.5rem; font-weight: 100; letter-spacing: .15rem">
                    Join us on a fabulous adventure.
                </p>
            </div>
        </div>

        <section class="about">
            <div class="container" data-aos="fade-up">

                <div class="row position-relative">

                    <div class="col-lg-7 about-img" style="background-image: url(assets/img/home/actors.jpg);"></div>

                    <div class="col-lg-7">
                        <h2>Best theatrical group in Bulgaria.</h2>
                        <div class="our-story">
                            <h4>Est 2003</h4>
                            <h3>Our Story</h3>
                            <p>Every one of us gives their best to make you feel the art that we make.</p>
                            <p>Join us on an unforgettable adventure through one of the best experiences many want to
                                attain.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section>
            <h3 class="text-center mt-3 mb-5 fw-bold" style="font-size: 3rem">Upcoming events</h3>

            <div class="d-flex gap-5 justify-content-center">
                @foreach($upcomingPerformances as $performance)
                    <article class="d-flex flex-column align-items-center" style="max-width: 20rem">
                        <a href="/{{ $performance->poster ?? 'assets/img/no_poster.png' }}"
                           class="d-block glightbox mb-4">
                            <img src="/{{ $performance->poster ?? 'assets/img/no_poster.png' }}"
                                 class="img-fluid"
                                 style="object-fit: contain; max-height: 20rem;"
                                 alt="{{$performance->performance}} poster">
                        </a>
                        <div class="text-center">
                            <h5>{{$performance->performance}}</h5>
                            <p>
                                <i class="fa fa-map-marker"
                                   aria-hidden="true"></i> {{$performance->theater}}, {{$performance->city}}
                            </p>
                            <p>
                                <i class="fa fa-clock"></i> {{date('d F Y H:i', strtotime($performance->performance_date))}}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

    </main><!-- End #main -->
@endsection
