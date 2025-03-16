@extends('layouts.master')
@section('title')
Accounts
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') {{ ucfirst($type) ?? 'Account' }}  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <a class="btn btn-primary float-end" href="{{ route('accounts.index', $type) }}" > <i class="ri-add-circle-line"></i> Back </a>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-12">

                    <form class="needs-validation" novalidate method="POST" action="{{ route('accounts.store', $type) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $type }}" name="type" id="type">
                        <div class="mb-3">
                            <label for="useremail" class="form-label">Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" id="useremail"
                                placeholder="Enter email address" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" id="username"
                                placeholder="Enter Name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="userpassword" class="form-label">Phone number <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-success w-100" type="submit">Register</button>
                        </div>

                    </form>

                </div>
           </div>
        </div>
    </div>

</div>

@endsection


@section('script')

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection











