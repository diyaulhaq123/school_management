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

                    <form class="needs-validation" novalidate method="POST" action="{{ route('accounts.update', [$type, $account->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="{{ $account->id }}" name="id" id="id">
                        <div class="mb-3">
                            <label for="useremail" class="form-label">Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $account->email }}" id="useremail"
                                placeholder="Enter email address" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="invalid-feedback">
                                Please enter email
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $account->name }}" id="name"
                                placeholder="Enter Name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="invalid-feedback">
                                Please enter name
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="userpassword" class="form-label">Phone number <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ $account->phone }}" placeholder="Enter Phone Number" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="userpassword" class="form-label">Account Type <span
                                    class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-select">
                                    <option value="">Select Account Type</option>
                                    @foreach ($types as $row)
                                        <option value="{{ $row->title }}" {{ $row->title == $account->type ? 'selected' : '' }} >{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-success w-100" type="submit">Update</button>
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

