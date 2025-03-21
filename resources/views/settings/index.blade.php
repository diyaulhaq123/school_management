@extends('layouts.master')
@section('title')
Settings
@endsection

@section('css')
<style>
    .circle-img {
        width: 180px; /* Adjust size as needed */
        height: 150px; /* Keep width & height equal */
        border-radius: 50%; /* Makes it circular */
        object-fit: cover; /* Ensures image fills the space */
    }
</style>
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Page @endslot
@slot('title') Settings  @endslot
@endcomponent

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
        <div class="card p-2">
            <div class="row justify-content-center ">
                <img src="{{ asset('images/'.$settings->logo) }}?v={{ time() }}" class="circle-img" alt="Logo" width="100">
            </div>
            <form action="{{ route('upload.logo') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-12 my-2">
                        <div class="form-group">
                            <label for="">Logo</label>
                            <input type="file" class="form-control" name="logo" id="logo">
                        </div>
                    </div>
                    <div class="col-12  mb-2">
                        <button type="submit" class="btn btn-primary">Upload <i class="ti ti-file-upload"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 mt-2">
        <div class="card p-5">
            <form action="{{ route('settings.update', $settings->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                        <label for="">Name/Title Of Institute</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $settings->name }}" placeholder="Name">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                        <label for="">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ $settings->phone_number }}" placeholder="Phone number">
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ $settings->email }}" placeholder="Email">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                        <label for="">Short/Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="{{ $settings->slug }}" placeholder="Slug">
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                        <label for="">Description</label>
                        <textarea cols="30" rows="5" class="form-control" name="description" id="description" >{{ $settings->description }}</textarea>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                        <label for="">Address</label>
                        <textarea cols="30" rows="5" class="form-control" name="address" id="address" >{{ $settings->address }}</textarea>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2 ">
                        <button type="submit" class="btn btn-primary">Save</button>
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
