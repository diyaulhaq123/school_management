@extends('layouts.master')
@section('title')
Portal Settings
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Portal Settings  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <a class="btn btn-primary float-end" href="{{ route('portal_settings.create') }}" > <i class="ri-add-circle-line"></i> Add settings</a>
        </div>
        <div class="card-body">
            <div class="card-title fw-bold">Settings</div>
           <div class="row justify-content-center">
            <div class="col-10">
                <div class="table table-responsive">
                    <table class="table">
                        <thead>
                            @foreach ($settings as $row)
                            <tr>
                                <input type="hidden" value="{{ $row->id }}" name="id" id="id">
                                <th style="font-size:15px">
                                        <a class="text-dark" href="{{ route('portal_settings.edit', $row->id) }}" >
                                        {{ $row->name }}
                                    </a>
                                </th>
                                <th class="float-end">
                                    <div class="form-check form-switch mb-2" bis_skin_checked="1">
                                        <input class="form-check-input" type="checkbox" {{ $row->status == 1 ? 'checked' : '' }} role="switch" id="status-switch">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
                                        <input type="hidden" name="status" id="status" value="0">
                                    </div>
                                </th>
                            </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
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
            $('.form-check-input').change(function () {
                // Find the closest row
                const row = $(this).closest('tr');
                // Get the ID and current status
                const id = row.find('input[name="id"]').val();
                let token = '{{ csrf_token() }}';
                let status = $(this).is(':checked') ? 1 : 0;
                // Send the AJAX request
                const url = `/portal_settings/${id}`;
                $.ajax({
                    url: url, // Replace with your route
                    method: 'PUT',
                    data: {
                        _token: token,
                        id: id,
                        status: status,
                    },
                    success: function (response) {
                        // Handle success
                        if (response.message === 'success') {
                            toastr.success('Settings updated!', 'Success');
                        }
                    },
                    error: function (xhr) {
                        // Handle error
                        toastr.error('An error occurred!', 'Error');
                    }
                });
            });
        });


    </script>
@endsection
