@extends('layouts.master')
@section('title')
Portal Settings
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Portal Settings @endslot
@slot('title') Edit  @endslot
@endcomponent

<div class="card p-4">
    <div class="card-body">
        <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="row justify-content-between align-items-end">
                    <input type="hidden" name="id" id="id" value="{{ $portalSetting->id }}">

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Settings Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $portalSetting->name }}" placeholder="Settings name">
                        </div>
                        @error('name')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="form-check form-switch mb-2" bis_skin_checked="1">
                            <input class="form-check-input" type="checkbox" {{ $portalSetting->status == 1 ? 'checked' : '' }}  role="switch" id="status-switch">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
                            <input type="hidden" name="status" id="status" value="0">
                        </div>
                        @error('status')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="button" id="save">Save</button>
                        <a href="{{ route('portal_settings.index') }}" class="btn btn-danger" >Back</a>
                    </div>
                </div>
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
        $(document).ready(function(){
            $('#save').click(function(){
                let token = '{{ csrf_token() }}';
                let status = $('#status').val();
                let name = $('#name').val();
                let id = $('#id').val();
                const url = `/portal_settings/${id}`;
                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: {
                        _token: token,
                        id: id,
                        status: status,
                        name: name,
                    },
                    success: function (response) {
                        if (response.message === 'success') {
                            toastr.success('Settings updated!', 'Success');
                        }
                    },
                    error: function (xhr) {
                        toastr.error('An error occurred!', 'Error');
                    }
                });
            });
        });
    </script>

@endsection
