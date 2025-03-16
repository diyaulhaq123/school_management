@extends('layouts.master')
@section('title')
Lesson Plan
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Lesson Plans  @endslot
@endcomponent

<div class="row">
    <div class="card p-4">
        <div class="card-header">
            <a class="btn btn-primary float-end" href="{{ route('lesson_plan.create') }}" > <i class="ri-add-circle-line"></i> Add Lesson Plan</a>
        </div>
        <div class="card-body">
            <div class="card-title fw-bold">Lesson Plans </div>
           <div class="row justify-content-center">
            <div class="col-10">
                <div class="table table-responsive">
                    <table class="table display" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Staff Name</th>
                                <th>Email</th>
                                <th>Edit|View|Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lesson_plans as $index => $row)
                            <tr>
                                {{-- <input type="hidden" value="{{ $row->id }}" name="id" id="id"> --}}
                                <td>{{ $index+1 }}</td>
                                <td > {{ $row->subject->name ?? '' }} </td>
                                <td>{{ $row->class->name }}</td>
                                <td>{{ $row->staff->name }}</td>
                                <td>{{ $row->staff->email }}</td>
                                <td>
                                    {{-- <div class="btn-group"> --}}
                                        <a class="btn btn-info btn-sm" href="{{ route('lesson_plan.edit', $row->id) }}" ><i class="ri ri-edit-fill"></i></a>
                                        @if (auth()->user()->hasRole(['admin','principal']) && $row->status == 1)
                                            <button class="btn btn-primary btn-sm" onclick="openSmallWindow('{{ route('lesson_plan.show', $row->id) }}')" ><i class="ri ri-eye-fill"></i></button>
                                        @else
                                            <a class="btn btn-primary btn-sm" href='{{ route('lesson_plan.show', $row->id) }}' target='blank' ><i class="ri ri-eye-fill"></i></a>
                                        @endif

                                        @if ($row->status == 1)
                                        <button class="btn btn-success btn-sm"><i class="ri-checkbox-circle-line"></i></button>
                                        @else
                                        <button class="btn btn-danger btn-sm"><i class="ri ri-close-circle-line"></i></button>
                                        @endif
                                    {{-- </div> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
           </div>
        </div>
    </div>

</div>

@endsection


@section('css')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

@endsection

@section('script')

    <script src="{{ URL::asset('build/js/app.js') }}"></script>

     <!--datatable js-->
     <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

     <script>

         $(document).ready(function(){
            let table = $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print', 'pdf'
                ],
            });

         });

        function openSmallWindow(url) {
            window.open(url, 'Lesson Plan', 'width=700,height=700,left=200,top=100,resizable=yes,scrollbars=yes');
        }

     </script>
@endsection
