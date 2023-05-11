@extends('frontend.main')


<style>
    iframe::-internal-media-controls-download-button {
        display: none;
    }

    iframe::-webkit-media-controls-enclosure {
        overflow: hidden;
    }

    iframe::-webkit-media-controls-panel {
        width: calc(100% + 30px);
        /* Ajuster le nombre de px */
    }
</style>
@section('content')
    <iframe src="{{ Storage::url($book->pdf_path) }}" frametoolbar="0" style="height: calc(100vh); width: 98vw;"
        frameborder="0"></iframe>
@endsection
