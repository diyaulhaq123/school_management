@extends('layouts.master')
@section('title')
Edit Result Activation
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Edit Result  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header"></div>
        <div class="card-body">
            <div class="card-title fw-bold">Edit Result Activation</div>
            <form action="{{ route('result.update', $result->id) }}" method="post">
                @csrf
                @method('put')
                <input type="hidden" value="{{ $result->id }}" name="id" id="id">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="">Classes</label>
                        <select name="class_id" id="class_id" class="form-select">
                            <option value="">Select class</option>
                            @foreach ($classes as $row)
                            <option value="{{ $row->id }}" {{ $result->class_id == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('class_id')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="">Sessions</label>
                        <select name="session_id" id="session_id" class="form-select">
                            <option value="">Select session</option>
                            @foreach ($sessions as $row)
                            <option value="{{ $row->id }}" {{ $result->session_id == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('session_id')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="">Terms</label>
                        <select name="term_id" id="term_id" class="form-select">
                            <option value="">Select term</option>
                            @foreach ($terms as $row)
                            <option value="{{ $row->id }}" {{ $result->term_id == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('term_id')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <button class="btn btn-primary mt-2" type="submit">Save</button>
                        <a href="{{ route('result.index') }}" class="btn btn-danger mt-2" >Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
