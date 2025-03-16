@extends('layouts.master')
@section('title')
Payments
@endsection
@section('content')

@section('css')
    <style>
        #myTable_filter{
            float: right;
        }
    </style>
@endsection

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Payment Report  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            {{-- <a class="btn btn-primary float-end" href="#" > <i class="ri-add-circle-line"></i> Make Payment</a> --}}
            <div class="row justify-content-between">
                <div class="col-7">
                    {{-- <div><h5>Collection Report</h5></div> --}}
                    <canvas id="enrollmentChart" style="height: 300px"></canvas>
                </div>
                <div class="col-5 ">
                    <div class="d-flex align-items-center justify-content-center" id="chart"  style="height: 300px"></div>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="card-title fw-bold">
                {{-- Payments --}}
                <div class="row">

                    {{-- <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
                        <div class="form-group">
                            <select name="student_id" id="student_id" class="form-select">
                                <option value="">Select Student</option>
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
                        <div class="form-group">
                            <select name="guardian_id" id="guardian_id" class="form-select">
                                <option value="">Select Guardian</option>
                                @foreach ($guardians as $row)
                                <option value="{{ $row->id }}"> {{ $row->name }} - {{ $row->email }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-lg-3 col-md-4 col-sm-12 mb-3">
                        <div class="form-group">
                            <select name="class_id" id="class_id" class="form-select form-select-sm">
                                <option value="">Select Class</option>
                                @foreach ($classes as $row)
                                <option value="{{ $row->id }}"> {{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 mb-3">
                        <div class="form-group">
                            <select name="session_id" id="session_id" class="form-select  form-select-sm">
                                <option value="">Select Session</option>
                                @foreach ($sessions as $row)
                                <option value="{{ $row->id }}"> {{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 mb-3">
                        <div class="form-group">
                            <select name="term_id" id="term_id" class="form-select  form-select-sm">
                                <option value="">Select Term</option>
                                @foreach ($terms as $row)
                                <option value="{{ $row->id }}"> {{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 mb-3">
                        <div class="form-group">
                            <select name="payment_type" id="payment_type" class="form-select  form-select-sm">
                                <option value="">Select Payment Type</option>
                                @foreach ($payment_types as $row)
                                <option value="{{ $row->id }}"> {{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
           <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="table-responsive">
                    <table class="table" id="myTable" style="">
                        <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Student</th>
                                <th>Admission no</th>
                                <th>Payment type</th>
                                <th>Session</th>
                                <th>Term</th>
                                <th>Class</th>
                                <th>Guardian's Name</th>
                                <th>Status</th>
                                <th>action</th>
                            </tr>
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

      <script src="{{ asset('build/assets/js/pages/datatables.init.js') }}"></script>
      <script>
          // document.addEventListener('DOMContentLoaded', function () {
          //     let table = new DataTable('#myTable',);
          // });

          $(document).ready(function(){

              let table = $('#myTable').DataTable({
                      ajax: {
                          url: '/api/payments',
                          type: 'GET',
                          data: function(d) {
                              d.class_id = $('#class_id').val();
                              d.session_id = $('#session_id').val();
                              d.term_id = $('#term_id').val();
                              d.guardian_id = $('#guardian_id').val();
                              d.payment_type = $('#payment_type').val();
                              d.student_id = $('#student_id').val();
                          }
                      },
                      processing: true,
                      serverSide: true,
                      searching : true,
                      columns: [
                          { data: 'id', name: 'id' },
                          { data: 'student', name: 'student', searching: true  },
                          { data: 'admission_no', name: 'admission_no', searching: true },
                          { data: 'payment_type', name: 'payment_type', searching: true  },
                          { data: 'session', name: 'session', searching: true  },
                          { data: 'term', name: 'term', searching: true },
                          { data: 'class', name: 'class', searching: true },
                          { data: 'guardian', name: 'guardian', searching: true },
                          { data: 'response', name: 'response', searching: true },
                          { data: 'action', name: 'action', orderable: false, searching: false },
                      ],
                    //   rowCallback: function(row, data) {
                    //       $(row).attr('onclick', `window.location='/payments/${data.id}'`);
                    //       $(row).css('cursor', 'pointer');
                    //   }
              });

              $('#class_id, #term_id, #session_id, #payment_type').on('change', function() {
                  table.ajax.reload();
              });
                  // $('#download_report').on('click', function () {
                  //     $("#example").table2excel({
                  //         filename: "collection_reports.xls"
                  //     });
                  // });

                $.ajax({
                    url: "{{ route('api.student') }}",
                    method: "GET",
                    dataType: "json",
                    success: function(students) {
                        let select = $('#student_id');
                        select.empty(); // Removes existing options

                        select.append('<option value="">Select Student</option>');
                        students.forEach(function(student) {
                            let option = `<option value="${student.id}">${student.first_name + ' ' + student.last_name}</option>`;
                            select.append(option);
                        });

                        // Trigger change event after populating the options
                        select.trigger('change');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching students:', error);
                    }
                });


          });

      </script>

          <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- piecharts init -->
    <script src="{{ URL::asset('build/js/pages/apexcharts-pie.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        var chartData = @json($data);
        var options = {
        series: chartData.series,
          chart: {
          width: 300,
          type: 'pie',
        },
        // FF0000
        labels: ['Paid', 'Pending'],
        colors: ['#00FF00', '#ffc107'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var paymentData = @json($payment_by_months);
        const ctx = document.getElementById('enrollmentChart').getContext('2d');
        const enrollmentChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Payments Analysis',
                    // data: [5, 10, 20, 25, 30, 35, 40, 45, 50, 55, 60, 60, 70, 75],
                    data: paymentData,
                    borderColor: '#2a3266',
                    backgroundColor: '#2a3266',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>

@endsection
