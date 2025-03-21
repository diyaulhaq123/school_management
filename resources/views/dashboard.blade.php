@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Dashboard  @endslot
@endcomponent


<div class="container-fluid py-4">

    <div class="row" bis_skin_checked="1">

        <div class="col-xl-3 col-md-6" bis_skin_checked="1">
            <!-- card -->
            <div class="card card-animate" bis_skin_checked="1">
                <div class="card-body" bis_skin_checked="1">
                    <div class="d-flex align-items-center" bis_skin_checked="1">
                        <div class="flex-grow-1" bis_skin_checked="1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Total Students</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4" bis_skin_checked="1">
                        <div bis_skin_checked="1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span >{{ $total_students }}</span></h4>
                            <a href="{{ route('student.index') }}" class="text-decoration-underline">View all</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0" bis_skin_checked="1">
                            <span class="avatar-title bg-success-subtle rounded fs-3 material-shadow">
                                <i class="bx bx-user-circle text-success"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6" bis_skin_checked="1">
            <!-- card -->
            <div class="card card-animate" bis_skin_checked="1">
                <div class="card-body" bis_skin_checked="1">
                    <div class="d-flex align-items-center" bis_skin_checked="1">
                        <div class="flex-grow-1" bis_skin_checked="1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Total Parents</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4" bis_skin_checked="1">
                        <div bis_skin_checked="1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span >{{ $total_guardians }}</span></h4>
                            <a href="{{ route('accounts.index','guardian') }}" class="text-decoration-underline">View all</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0" bis_skin_checked="1">
                            <span class="avatar-title bg-light-subtle rounded fs-3 material-shadow">
                                <i class="bx bx-user-circle text-dark"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6" bis_skin_checked="1">
            <!-- card -->
            <div class="card card-animate" bis_skin_checked="1">
                <div class="card-body" bis_skin_checked="1">
                    <div class="d-flex align-items-center" bis_skin_checked="1">
                        <div class="flex-grow-1" bis_skin_checked="1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Total Staffs</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4" bis_skin_checked="1">
                        <div bis_skin_checked="1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span >{{ $total_staffs }}</span></h4>
                            <a href="{{ route('accounts.index','teacher') }}" class="text-decoration-underline">View all</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0" bis_skin_checked="1">
                            <span class="avatar-title bg-warning-subtle rounded fs-3 material-shadow">
                                <i class="bx bx-user-circle text-warning"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6" bis_skin_checked="1">
            <!-- card -->
            <div class="card card-animate" bis_skin_checked="1">
                <div class="card-body" bis_skin_checked="1">
                    <div class="d-flex align-items-center" bis_skin_checked="1">
                        <div class="flex-grow-1" bis_skin_checked="1">
                            <p class="text-uppercase fw-medium text-muted mb-0">New Admissions</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4" bis_skin_checked="1">
                        <div bis_skin_checked="1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span >0</span></h4>
                            <a href="" class="text-decoration-underline">View</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0" bis_skin_checked="1">
                            <span class="avatar-title bg-primary-subtle rounded fs-3 material-shadow">
                                <i class="bx bx-wallet text-primary"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->


        <div class="col-xl-3 col-md-6" bis_skin_checked="1">
            <!-- card -->
            <div class="card card-animate" bis_skin_checked="1">
                <div class="card-body" bis_skin_checked="1">
                    <div class="d-flex align-items-center" bis_skin_checked="1">
                        <div class="flex-grow-1" bis_skin_checked="1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Total Payments</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4" bis_skin_checked="1">
                        <div bis_skin_checked="1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span > ₦ {{ number_format($payments, 2) }}</span></h4>
                            <a href="{{ route('payments.index') }}" class="text-decoration-underline">View all</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0" bis_skin_checked="1">
                            <span class="avatar-title bg-light-subtle rounded fs-3 material-shadow">
                                <i class="bx bx-dollar-circle text-dark"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->


        <div class="col-xl-3 col-md-6" bis_skin_checked="1">
            <!-- card -->
            <div class="card card-animate" bis_skin_checked="1">
                <div class="card-body" bis_skin_checked="1">
                    <div class="d-flex align-items-center" bis_skin_checked="1">
                        <div class="flex-grow-1" bis_skin_checked="1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Successful Payments</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4" bis_skin_checked="1">
                        <div bis_skin_checked="1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span > ₦ {{ number_format($successful_payments, 2) }}</span></h4>
                            <a href="{{ route('payments.index') }}" class="text-decoration-underline">View all</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0" bis_skin_checked="1">
                            <span class="avatar-title bg-success-subtle rounded fs-3 material-shadow">
                                <i class="bx bx-dollar-circle text-success"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->


        <div class="col-xl-3 col-md-6" bis_skin_checked="1">
            <!-- card -->
            <div class="card card-animate" bis_skin_checked="1">
                <div class="card-body" bis_skin_checked="1">
                    <div class="d-flex align-items-center" bis_skin_checked="1">
                        <div class="flex-grow-1" bis_skin_checked="1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Pending Payments</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4" bis_skin_checked="1">
                        <div bis_skin_checked="1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span >₦ {{ number_format($pending_payments, 2) }}</span></h4>
                            <a href="{{ route('payments.index') }}" class="text-decoration-underline">View all</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0" bis_skin_checked="1">
                            <span class="avatar-title bg-warning-subtle rounded fs-3 material-shadow">
                                <i class="bx bx-dollar-circle text-danger"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6" bis_skin_checked="1">
            <!-- card -->
            <div class="card card-animate" bis_skin_checked="1">
                <div class="card-body" bis_skin_checked="1">
                    <div class="d-flex align-items-center" bis_skin_checked="1">
                        <div class="flex-grow-1" bis_skin_checked="1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Total Expenses</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4" bis_skin_checked="1">
                        <div bis_skin_checked="1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span >0</span></h4>
                            <a href="" class="text-decoration-underline">View all</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0" bis_skin_checked="1">
                            <span class="avatar-title bg-success-subtle rounded fs-3 material-shadow">
                                <i class="bx bx-dollar-circle text-success"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

    </div>

    <div class="row mb-4">
        <div class="col-lg-8 col-sm-12 mb-4">
            <div class="card card-custom">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-dark">Students Enrollment Chart</h5>
                </div>
                <div class="card-body">
                    <canvas id="enrollmentChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-4 col-sm-12 mb-4" bis_skin_checked="1">
            <div class="card card-height-100" bis_skin_checked="1">
                <div class="card-header border-bottom-dashed align-items-center d-flex" bis_skin_checked="1">
                    <h4 class="card-title mb-0 flex-grow-1">Student Ratio</h4>
                </div><!-- end cardheader -->
                <div class="card-body" bis_skin_checked="1">
                    <div class="" id="chart"></div>

                    <ul class="list-group list-group-flush border-dashed mb-0">
                        <li class="list-group-item px-0">
                            <div class="d-flex" bis_skin_checked="1">
                                <div class="flex-shrink-0 avatar-xs" bis_skin_checked="1">
                                    <span class="avatar-title bg-light p-1 rounded-circle material-shadow">
                                        <img src="" class="img-fluid" alt="">
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2" bis_skin_checked="1">
                                    <h6 class="mb-1">Male</h6>
                                </div>
                                <div class="flex-shrink-0 text-end" bis_skin_checked="1">
                                    <h6 class="mb-1">{{ $male }}</h6>
                                </div>
                            </div>
                        </li><!-- end -->
                        <li class="list-group-item px-0">
                            <div class="d-flex" bis_skin_checked="1">
                                <div class="flex-shrink-0 avatar-xs" bis_skin_checked="1">
                                    <span class="avatar-title bg-light p-1 rounded-circle material-shadow">
                                        <img src="" class="img-fluid" alt="">
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2" bis_skin_checked="1">
                                    <h6 class="mb-1">Female</h6>
                                </div>
                                <div class="flex-shrink-0 text-end" bis_skin_checked="1">
                                    <h6 class="mb-1">{{ $female }}</h6>
                                </div>
                            </div>
                        </li><!-- end -->
                    </ul><!-- end -->
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header bg-dark">
                    <h5 class="mb-0 text-white">Fee Payments</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- $latest_payments --}}
                                @forelse ($latest_payments as $index => $row)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $row->student->last_name.' '.$row->student->first_name.' '.$row->student->other_name }}</td>
                                    <td>{{ $row->class->name }}</td>
                                    <td>{{ number_format($row->amount, 2) }}</td>
                                    <td>
                                        @if ($row->status == 'success')
                                        <span class="badge bg-success">Paid</span></td>
                                        @else
                                        <span class="badge bg-danger">Unpaid</span></td>
                                        @endif
                                    <td>{{ $row->created_at }}</td>
                                    @empty
                                    <td colspan="6" class="text-center text-danger">No Payment found...</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- piecharts init -->
    <script src="{{ URL::asset('build/js/pages/apexcharts-pie.init.js') }}"></script>


    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
         var chartData = @json($data);
        var options = {
        series: chartData.series,
          chart: {
          width: 300,
          type: 'pie',
        },
        labels: ['Male', 'Female'],
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

        const ctx = document.getElementById('enrollmentChart').getContext('2d');
        const enrollmentChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Enrollments',
                    data: [50, 60, 80, 45, 70, 90],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
@endsection
