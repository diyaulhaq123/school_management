@extends('layouts.master')
@section('title')
Term
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Page @endslot
@slot('title') Edit/View Term  @endslot
@endcomponent

<div class="card p-4">
    <div class="card-body">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <form action="{{ route('terms.update', $term->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="row justify-content-between align-items-end">
                    <input type="hidden" name="id" id="id" value="{{ $term->id }}">

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $term->name }}" placeholder="Name">
                        </div>
                        @error('name')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="button" id="save">Save</button>
                        <a href="{{ route('terms.index') }}" class="btn btn-danger" >Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        document.getElementById('status-switch').addEventListener('change', function () {
            const statusInput = document.getElementById('status');
            statusInput.value = this.checked ? '1' : '0';
        });
    </script>

@endsection
