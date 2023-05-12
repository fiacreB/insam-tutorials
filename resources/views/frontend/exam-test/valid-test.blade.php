<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>
@extends('frontend.partials.main')
@section('title', 'Valide Test ')
@section('content')
    <div class="container">
        <div class="text-center">
            <h3>Merci pour votre test, {{ Auth::user()->name }}</h3>
            <p>Veuillez cliquer ici pour confirmer votre test.
            </p>

            <div><a href="{{ route('layout-frontend.categories.resultDashboard', $chapter->slug) }}"
                    class="list-group-item list-group-item-action py-2 ripple text-uppercase text-info" aria-current="true">
                    <i class="fa fa-list-alt fa-fw me-3 "></i><span><b> Mes Résultats</b></span>
                </a>
            </div>

        </div>
    </div>
@endsection
