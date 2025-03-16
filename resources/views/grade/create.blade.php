@extends('layouts.master')
@section('title')
Record grade
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Add Grade @endslot
@slot('title') Add Grades  @endslot
@endcomponent

<div class="card p-4">
    @if (auth()->user()->hasRole(['teacher','eo']))
    <div class="card-header">
        {{ $class->name ?? ''}} {{ $wing ?? ''}}  | {{ $session->name ?? '' }}
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            {{-- @if ($activation) --}}

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Student Name</th>
                            <th>Wing</th>
                            <th>CA 1</th>
                            <th>CA 2</th>
                            <th>CA 3</th>
                            <th>Exams</th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grades as $index => $row)
                        <tr>
                            <input type="hidden" name="id[]" id="id" class="id" value="{{ $row->id }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $row->student->last_name.' '.$row->student->first_name.' '.$row->student->other_name }} ({{ $row->id }})</td>
                            <td>{{ $row->student->wing }}</td>
                            <td>
                                <input type="text" size="1" class="form-control ca1 cabox" value="{{ $row->ca1 }}" data-id="{{ $row->id }}" name="ca1" id="ca1" onkeypress="return isNumber(event)" >
                            </td>
                            <td>
                                <input type="text" size="1" class="form-control ca2 cabox" value="{{ $row->ca2 }}" data-id="{{ $row->id }}" name="ca2" id="ca2" onkeypress="return isNumber(event)" >
                            </td>
                            <td>
                                <input type="text" size="1" class="form-control ca3 cabox" value="{{ $row->ca3 }}" data-id="{{ $row->id }}" name="ca3" id="ca3" onkeypress="return isNumber(event)" >
                            </td>
                            <td>
                                <input type="text" size="1" class="form-control exam cabox" value="{{ $row->exam }}" data-id="{{ $row->id }}" name="exam" id="exam" onkeypress="return isNumber(event)" >
                            </td>
                            {{-- <td>
                                <button class="btn btn-primary btn-sm open" id="open" data-bs-toggle="modal" data-bs-target="#flipModal" data-id="{{ $row->id }}" ><i class="ri ri-eye-fill"></i></button>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- @else
            <div class="alert alert-danger text-center">
                Upload for this current session and term is not active...
            </div>
            @endif --}}
        </div>
    </div>
    @else
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="alert-alert-danger text-center">You cannot access these resources</div>
        </div>
    </div>
    @endif

</div>


<!-- Modal flip -->
<div id="flipModal" class="modal  modal-lg fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flipModalLabel">Record student grades</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class="view_div" id="view_div"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        document.getElementById('status-switch').addEventListener('change', function () {
            const statusInput = document.getElementById('status');
            statusInput.value = this.checked ? '1' : '0';
        });
    </script>

    <script>
        $(document).ready(function(){
            // $('#class_category_id').change(function(){
            //     var category = $('#class_category_id').val();
            //     if(category == 4){
            //         $('#category').show();
            //     }
            // });

            // $('.open').click(function(){
            //     var id = $(this).data('id');
            //     var token = '{{ csrf_token() }}'
            //     $.post('/get-grades', { id: id, _token:token }, function (response) {
            //         $('.view_div').html(response);
            //     }).fail(function (xhr, status, error) {
            //         toastr.error('An error occurred: ' + xhr.responseText, 'Error');
            //     });
            // })


            $(".ca1").blur(function(e) {
                var ca = $(this).val();
                var id = $(this).data("id");
                var type = '1';
                var cabox = $(this);
                var token = '{{ csrf_token() }}';
                $.post("/save_ca_result", {id:id, ca:ca, type:type, _token:token}, function(data){
                if(data.message == 'Success') {
                        toastr.success(data.message, 'Success');
                        cabox.css("border","solid 2px green");
                }
                if(data.message == 'Error'){
                    toastr.error(data.message, 'Error');
                    cabox.css("border","solid 2px red");
                }
                });
                e.preventDefault();
            });

            $(".ca2").blur(function(e) {
                var ca = $(this).val();
                var id = $(this).data("id");
                var type = '2';
                var cabox = $(this);
                var token = '{{ csrf_token() }}';
                $.post("/save_ca_result", {id:id, ca:ca, type:type, _token:token}, function(data){
                    if(data.message == 'Success') {
                        toastr.success(data.message, 'Success');
                        cabox.css("border","solid 2px green");
                }
                if(data.message == 'Error'){
                    toastr.error(data.message, 'Error');
                    cabox.css("border","solid 2px red");
                }
                });
                e.preventDefault();
            });

            $(".ca3").blur(function(e) {
                var ca = $(this).val();
                var id = $(this).data("id");
                var type = '3';
                var cabox = $(this);
                var token = '{{ csrf_token() }}';
                $.post("/save_ca_result", {id:id, ca:ca, type:type, _token:token}, function(data){
                if(data.message == 'Success') {
                        toastr.success(data.message, 'Success');
                        cabox.css("border","solid 2px green");
                }
                if(data.message == 'Error'){
                    toastr.error(data.message, 'Error');
                    cabox.css("border","solid 2px red");
                }
                });
                e.preventDefault();
            });

            $(".exam").blur(function(e) {
                var exam = $(this).val();
                var id = $(this).data("id");
                var exambox = $(this);
                var type = '4';
                var token = '{{ csrf_token() }}';
                $.post("/save_ca_result", {id:id, exam:exam, type:type, _token:token}, function(data){
                if(data.message == 'Success') {
                        toastr.success(data.message, 'Success');
                        cabox.css("border","solid 2px green");
                }
                if(data.message == 'Error'){
                    toastr.error(data.message, 'Error');
                    cabox.css("border","solid 2px red");
                }
                });
                e.preventDefault();
            });


            $('.cabox').keyup(function(){
                if ($(this).val() > 100){
                    Swal.fire({
                        title: 'Warning',
                        text: "Your total CA cannot be above"+ $(this).val(),
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it!'
                    })
                }
            });


        });



        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

    </script>

@endsection
