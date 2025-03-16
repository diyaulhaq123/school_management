@extends('layouts.master')
@section('title')
Payment Types
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Payment Type @endslot
@slot('title') Create  @endslot
@endcomponent

<div class="card p-4">
    <div class="card-body">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <form action="{{ route('payment_type.store') }}" method="post">
                @csrf
                <div class="row justify-content-between align-items-end">

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Payment Type Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Name">
                        </div>
                        @error('name')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="form-check form-switch mb-2" bis_skin_checked="1">
                            <input class="form-check-input" type="checkbox" role="switch" id="status-switch">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
                            <input type="hidden" name="status" id="status" value="0">
                        </div>
                        @error('status')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="{{ route('payment_type.index') }}" class="btn btn-danger" >Back</a>
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
