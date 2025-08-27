<!DOCTYPE html>
<html>
<head>
    @include("layouts.Dashboard._meta")
    @include("layouts.Dashboard._style")
</head>
<body>
@include("layouts.Dashboard._header")
@include("layouts.Dashboard._sidebar")
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total <span>| Cow</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fas fa-cow"></i>

                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$totalCow}}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total <span>| Farms</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-house"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$totalFarms}}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Users <span>| Count</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$userCount}}</h6>
{{--                                        <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>--}}

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Animals <span>/Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        // Fetching cumulative data from Blade template
                                        const cumulativeCowData = @json($cumulativeCowData);
                                        const cumulativeGoatData = @json($cumulativeGoatData);

                                        // Extracting dates and totals for both cows and goats
                                        const chartDates = cumulativeCowData.map(item => item.date); // Use cow dates as the base timeline
                                        const cowTotals = cumulativeCowData.map(item => item.total);
                                        const goatTotals = cumulativeGoatData.map(item => item.total);

                                        // Initialize the chart
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [
                                                {
                                                    name: 'Cumulative Cows',
                                                    data: cowTotals
                                                },
                                                {
                                                    name: 'Cumulative Goats',
                                                    data: goatTotals
                                                }
                                            ],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#ff6b6b'], // Blue for cows, red for goats
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: chartDates
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'yyyy-MM-dd'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>


                            </div>

                        </div>
                    </div><!-- End Reports -->
                    <div class="col-12">
                        <div class="card">


                            <div class="card-body pb-0">
                                <h5 class="card-title">Farms <span>| This Month</span></h5>

                                <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        const farmCountByDistrict = @json($farmCountByDistrict) || [];

                                        if (farmCountByDistrict.length === 0) {
                                            console.warn("No data available for the chart.");
                                            return;
                                        }

                                        const districts = farmCountByDistrict.map(item => item.district);
                                        const farmCounts = farmCountByDistrict.map(item => item.farm_count);

                                        var myChart = echarts.init(document.querySelector("#budgetChart"));

                                        var option = {
                                            tooltip: { trigger: 'axis' },
                                            xAxis: { type: 'category', data: districts },
                                            yAxis: { type: 'value' },
                                            series: [{
                                                name: 'Farm Count',
                                                type: 'bar',
                                                data: farmCounts,
                                                itemStyle: { color: '#5470C6' }
                                            }]
                                        };

                                        myChart.setOption(option);
                                    });
                                </script>
                            </div>
                        </div><!-- End Budget Report -->
                        <div class="col-12">
                            <!-- Website Traffic -->
                            <div class="card">


                                <div class="card-body pb-0">
                                    <h5 class="card-title">Cow Count <span>| Today</span></h5>

                                    <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            // Prepare the data for the chart from the Blade data
                                            const cowCountByDistrict = @json($cowCountByDistrict);

                                            // Prepare the chart data
                                            const chartData = cowCountByDistrict.map(item => ({
                                                value: item.cow_count,
                                                name: item.district
                                            }));

                                            // Initialize the chart
                                            echarts.init(document.querySelector("#trafficChart")).setOption({
                                                tooltip: {
                                                    trigger: 'item'
                                                },
                                                legend: {
                                                    top: '5%',
                                                    left: 'center'
                                                },
                                                series: [{
                                                    name: 'Cow Count by District',
                                                    type: 'pie',
                                                    radius: ['40%', '70%'],
                                                    avoidLabelOverlap: false,
                                                    label: {
                                                        show: false,
                                                        position: 'center'
                                                    },
                                                    emphasis: {
                                                        label: {
                                                            show: true,
                                                            fontSize: '18',
                                                            fontWeight: 'bold'
                                                        }
                                                    },
                                                    labelLine: {
                                                        show: false
                                                    },
                                                    data: chartData
                                                }]
                                            });
                                        });
                                    </script>

                                </div>
                            </div><!-- End Website Traffic -->
                        </div>


                    </div >




                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">


                <div class="card">


                    <div class="card-body pb-0">
                        <h5 class="card-title">News & Updates <span>| Today</span></h5>

                        <div class="news">
                            @foreach($announcements as $announcement)
                                <div class="post-item clearfix">
                                    <img src="{{ asset('storage/' . $announcement->image) }}"
                                         alt="News Image"
                                         class="rounded-3 border shadow-sm"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                    <h4><a href="#">{{ $announcement->title ?? 'No Title' }}</a></h4>
                                    <p>{{ Str::limit($announcement->description, 100, '...') }}</p>
                                    <small class="text-muted"><i class="bi bi-clock"></i> {{ $announcement->created_at->diffForHumans() }}</small>
                                </div>
                            @endforeach
                        </div><!-- End sidebar recent posts -->
                    </div>




                    </div>
                </div><!-- End News & Updates -->

            </div><!-- End Right side columns -->

    </section>

</main><!-- End #main -->
@include("layouts.Dashboard._footer")
@include("layouts.Dashboard._script")




</body>
</html>
