@extends('layouts.master')
@section('title')
Profile
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Page @endslot
@slot('title') Profile  @endslot
@endcomponent

<div class="row justify-content-between">
    <div class="col-lg-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="fw-bold">
                    Profile Information
                </h5>
            </div>
            <div class="card-body">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
                <form method="post" action="{{ route('profile.update') }}" class="">
                    @csrf
                    @method('patch')

                    <div class="form-group mb-2">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}"  autofocus autocomplete="name">
                        @error('name')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="">Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"  autofocus >
                        @error('phone')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <div class="form-group mb-2">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}"  autofocus >
                            @error('email')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-secondary">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification" class="btn btn-primary">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-success">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="fw-bold">Update Password</h5>
                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="update_password_current_password" >Current Password</label>
                                <input type="password" class="form-control mt-1" id="update_password_current_password" name="current_password" autocomplete="current-password">
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="update_password_password" >New Password</label>
                                <input type="password" class="form-control mt-1" id="update_password_password" name="password" autocomplete="new-password">
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="update_password_password_confirmation" >Confirm Password</label>
                                <input type="password" class="form-control mt-1" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-12 mt-2">
                            <button class="btn btn-primary" type="submit" >Save</button>
                        </div>
                    </div>
                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600"
                        >{{ __('Saved.') }}</p>
                    @endif
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

@endsection
