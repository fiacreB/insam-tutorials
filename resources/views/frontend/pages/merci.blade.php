<script src="{{ asset('/assets-frontend/js/jquery.min.js') }}"></script>
@extends('frontend.partials.main')
@section('content')
    <div class="container">
        <div class="text-center">
            <h2>Merci pour votre test, {{ Auth::user()->name }}</h2>
            <p>Veuillez confirmer votre test pour passer au chapitre suivant.</p>

            <div><a href="{{ route('layout-frontend.categories.resultDashboard', $chapter->slug) }}"
                    class="list-group-item list-group-item-action py-2 ripple text-uppercase text-info" aria-current="true">
                    <i class="fa fa-list-alt fa-fw me-3 "></i><span><b> Mes Résultats</b></span>
                </a>
            </div>

        </div>
    </div>
@endsection
