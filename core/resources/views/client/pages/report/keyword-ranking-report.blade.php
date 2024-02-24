@extends('client.layout')

@section('title') KeywordRanking Report @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('clientarea/project/dashboard', ['slug'=>$current_project['slug']]) }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Reports</li>
                    <li class="breadcrumb-item active">Keyword Ranking Report</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            @include('client.shared._message')

            <div class="row">
                <div class="col-md-12">
                   <form action="{{ route('clientarea/project/report/keywordRankingReport', ['slug' => App\Utility\Helpers::getParamValue('slug')]) }}" method="GET">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="website" id="website" class="form-control" required>
                                            @foreach ($keywrod_websites as $i => $website)
                                                <option value="{{ $website->id }}" {{ $i == 0 ? 'selected' : '' }}>{{ $website->website }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                   <div class="form-group">
                                        <input type="date" id="reporting_date" name="reporting_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                   </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Get Report</button>
                                   </div>
                                </div>
                                <div class="col-md-3">

                                </div>
                            </div>
                        </div>
                    </div>
                   </form>
                </div>
                @if($is_any_report)
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Keyword Overview</h4>
                                    <canvas id="ranking_keyword_chart" data-colors='["--vz-primary", "--vz-primary-rgb, 0.85", "--vz-primary-rgb, 0.70", "--vz-primary-rgb, 0.55", "--vz-primary-rgb, 0.40"]' class="apex-charts" dir="ltr"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    <h6 class="card-title">Top Keywords</h6>
                                    <table class="table table-sm fs-14">
                                        <thead>
                                        <tr class="table-light">
                                            <th>Keyword</th>
                                            <th class="text-center">Position</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($report->top_keywords ?? [] as $keyword)
                                            <tr>
                                                <td>{{ $keyword->keyword_name }}</td>
                                                <td class="text-center">{{ $keyword->position > 0 ? $keyword->position : '' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">All Keywords</h6>
                                    <table class="table table-sm fs-14">
                                        <thead>
                                        <tr class="table-light">
                                            <th>Keyword</th>
                                            <th class="text-center">Position</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($report->keywords ?? [] as $keyword)
                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0)" onclick="loadRankingDetails({{ $report->intregration_keyword_id }}, {{ $keyword->id }}, '{{ $keyword->keyword_name }}')">{{ $keyword->keyword_name }}</a>
                                                </td>
                                                <td class="text-center">
                                                    @if($keyword->position > 0)
                                                     {{ $keyword->position }}
                                                        @if($keyword->position > $keyword->prev_position && $keyword->prev_position > 0)
                                                            <span class="text-danger"><i class="bx bx-down-arrow-alt"></i></span>
                                                        @else
                                                            <span class="text-success"><i class="bx bx-up-arrow-alt"></i></span>
                                                        @endif
                                                    @endif

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Top Competitors</h6>
                                    <table class="table table-sm fs-14">
                                        <thead>
                                        <tr class="table-light">
                                            <th>Competitor Websites</th>
                                            <th  class="text-center">Common Keywords</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($report->competitors ?? [] as $competitor)
                                            <tr>
                                                <td>{{ $competitor->competitor_name }}</td>
                                                <td class="text-center">{{ $competitor->common_keyword }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Related Keywords</h6>
                                    <table class="table table-sm fs-14">
                                        <thead>
                                        <tr class="table-light">
                                            <th>Keyword</th>
                                            <th class="text-center">Position</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($report->related_keywords ?? [] as $keyword)
                                            <tr>
                                                <td>{{ $keyword->keyword_name }}</td>
                                                <td class="text-center">-</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
    @include('client.pages.report.modals.keyword-ranking-details')

    <input type="hidden" id="hdnKeywordDetailsModal" value="{{ route('clientarea/project/report/keywordRankingReport/keywordDetails', ['slug' => App\Utility\Helpers::getParamValue('slug')]) }}">
@endsection


@section('script')
    <script src="{{ asset('assets/libs/chart.js/chart.umd.js') }}"></script>
    <script>
        const ctx = document.getElementById('ranking_keyword_chart');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Ranking Keywords', 'Remain Keywords'],
                datasets: [
                    {
                        data: [{{ $report ? $report->ranking_percent ?? 0 : 0 }},{{ 100 - $report ? $report->ranking_percent ?? 0 : 0 }}],
                        backgroundColor: [
                            '#41cbed',
                            '#bbbbbc'
                        ]
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        align: 'start'
                    },
                    title: {
                        display: true,
                    }
                }
            }
        });

        let lineChart = null;

        function loadRankingDetails(intregration_keyword_id , id, keyword_name)
        {
            $('#kewordTitle').text(keyword_name);
            $url = $('#hdnKeywordDetailsModal').val() + '?k_id='+id+'&ig='+intregration_keyword_id;

            common.ajaxCallGetRequest($url, ({dates, positions, related_keywords}) => {
                keywordRankingPositionChart(dates, positions);
                $('#related-keyword-placeholder').empty();
                related_keywords.forEach(({keyword_name, position}) => {
                    $('#related-keyword-placeholder').append(`
                        <tr>
                            <td>${keyword_name}</td>
                            <td class="text-center">-</td>
                        </tr>
                    `)
                });


                $('#keywordDetailsModal').modal('show');
            });

        }

        function closeRankingDetailsModal(){
            if(lineChart !== null)
                lineChart.destroy();
            $('#keywordDetailsModal').modal('hide');
        }

       function keywordRankingPositionChart(labels, data){

        var islinechart = document.getElementById("keywordRankingPositionChart"),
            isbarchart =
                ((lineChartColor = getChartColorsArray("keywordRankingPositionChart")) &&
                (islinechart.setAttribute("width", islinechart.parentElement.offsetWidth),
                    (lineChart = new Chart(islinechart, {
                        type: "line",
                        data: {
                            labels:labels,
                            datasets: [
                                {
                                    order: 2,
                                    label: "Keyword Position",
                                    fill: !0,
                                    lineTension: 0.5,
                                    backgroundColor: lineChartColor[0],
                                    borderColor: lineChartColor[1],
                                    borderCapStyle: "butt",
                                    borderDash: [],
                                    borderDashOffset: 0,
                                    borderJoinStyle: "miter",
                                    pointBorderColor: lineChartColor[1],
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: lineChartColor[1],
                                    pointHoverBorderColor: "#fff",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 1,
                                    pointHitRadius: 10,
                                    data: data,
                                }
                            ],
                        },
                        options: {
                            x: { ticks: { font: { family: "Poppins" }}},
                            y: { ticks: { font: { family: "Poppins" }}},
                            plugins: { legend: { labels: { font: { family: "Poppins"}}}},
                        }
                    }))),
                    document.getElementById("keywordRankingPositionChart"));
       }
    </script>
@endsection
