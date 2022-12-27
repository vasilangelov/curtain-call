@extends('layouts/app')

@section('content')
    <main id="main">
        <div class="breadcrumbs d-flex align-items-center"
             style="background-image: url('assets/img/hero.jpg'); background-position: bottom center">
            <div class="container position-relative d-flex flex-column align-items-center text-light" data-aos="fade">
                <h1 style="font-size: 4rem">Curtain Call</h1>
                <p style="font-size: 1.5rem; font-weight: 100; letter-spacing: .15rem">
                    Join us on a fabulous adventure.
                </p>
            </div>
        </div>

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
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
        <!-- End About Section -->

    </main><!-- End #main -->l
@endsection
