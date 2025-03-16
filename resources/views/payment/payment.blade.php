@extends('layouts.master')
@section('title')
Payment
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Page @endslot
@slot('title') Make Payment  @endslot
@endcomponent

<div class="card p-4">
    <div class="card-body">
    </div>
</div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
