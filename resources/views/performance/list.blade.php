@extends('layouts.app')

@section('content')
    <div class="breadcrumbs d-flex align-items-center"
         style="background-image: url('assets/img/hero.jpg'); background-position: bottom center">
        <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">
            <h2>{{ $title }}</h2>
        </div>
    </div>

    @if($performances->count() !== 0)
        <section>
            @if($queryString || $startDate || $endDate)
                <div class="text-center mb-5">
                    @if($queryString)
                        <h2>
                            Results
                            for "{{ $queryString }}"
                        </h2>
                    @endif
                    @if($startDate || $endDate)
                        <p>
                            In the range
                            @if ($startDate)
                                from {{ $startDate->format('d F Y') }}
                            @endif
                            @if ($endDate)
                                before {{ $endDate->format('d F Y') }}
                            @endif
                        </p>
                    @endif
                </div>
            @endif

            <div class="d-flex flex-column align-items-center gap-4" style="width: min(40rem, 90%); margin-inline: auto">
                @foreach($performances as $performance)
                    <article class="d-flex gap-4" style="min-height: 10rem">
                        <a href="/{{ $performance->poster ?? 'assets/img/no_poster.png' }}"
                           class="d-block glightbox mb-4">
                            <img src="/{{ $performance->poster ?? 'assets/img/no_poster.png' }}"
                                 class="img-fluid"
                                 style="object-fit: contain; max-height: 20rem;"
                                 alt="{{ $performance->name }} poster">
                        </a>

                        <div class="d-flex flex-column">
                            <h3 class="mb-5">{{ $performance->name }}</h3>
                            <p>
                                <i class="fa fa-map-marker"
                                   aria-hidden="true"></i> {{ $performance->theaterName }}, {{ $performance->cityName }}
                            </p>
                            <p>
                                <i class="fa fa-clock"></i> {{ $performance->performance_date->format('d F Y H:i') }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>

            <div style="max-width: 40rem; margin-inline: auto">
                {{ $performances->withQueryString()->links() }}
            </div>
        </section>
    @else
        <div class="text-center my-5">
            <h2 class="mb-4">No performances found</h2>

            <a href="{{ route('index.index') }}" class="c-button c-button-link">Back to home</a>
        </div>
    @endif
@endsection