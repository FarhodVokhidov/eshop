@extends('layouts.app')
@section('title')
    {{$product->title}}
@endsection
@section('meta_keyword')
    {{$product->meta_keyword}}
@endsection
@section('meta_description')
    {{$product->meta_description}}
@endsection
@section('content')
    <div>
        <livewire:frontend.prodcut.view :product="$product" :category="$category"/>
    </div>
@endsection
@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>

        window.addEventListener('message', event => {
            alertify.set('notifier', 'position', 'top-right');
            alertify.notify(event.detail.text, event.detail.type);
        })


    </script>
@endsection
