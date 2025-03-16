@extends('layouts.master')
@section('title')
Student
@endsection
@section('content')

    @component('components.breadcrumb')
    @slot('li_1') Pages @endslot
    @slot('title') Student Record  @endslot
    @endcomponent



@endsection


@section('script')

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script
      type="text/javascript"
      src="https://sdk.monnify.com/plugin/monnify.js"></script>

    <script>
        $(document).ready(function(){

        });
    </script>

@endsection


