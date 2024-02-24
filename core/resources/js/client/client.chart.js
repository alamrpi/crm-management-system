/******
* collumn chart hare
 *******/

var chartPieBasicColors = getChartColorsArray("ranking_keyword_chart"),
    chartDonutBasicColors =
        (chartPieBasicColors &&
            ((options = {
                series: [70, 30],
                chart: { height: 300, type: "pie" },
                labels: ["Ranking Keywords", "Total Keywords"],
                legend: { position: "top" },
                colors: [
                    '#25A0E2',
                    '#f3f6f9'
                ],
                dataLabels: {
                    enabled: false,
                    formatter: function (val) {
                        console.log();
                    },
                }
            }), (chart = new ApexCharts(document.querySelector("#ranking_keyword_chart"), options)).render()));

let lineChart
var islinechart = document.getElementById("keywordRankingPositionChart"),
    isbarchart =
        ((lineChartColor = getChartColorsArray("keywordRankingPositionChart")) &&
        (islinechart.setAttribute("width", islinechart.parentElement.offsetWidth),
            (lineChart = new Chart(islinechart, {
                type: "line",
                data: {
                    labels: [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                    ],
                    datasets: [
                        {
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
                            data: [65, 59, 80, 81, 56, 55, 40, 55, 30, 80],
                        }
                    ],
                },
                options: {
                    x: { ticks: { font: { family: "Poppins" } } },
                    y: { ticks: { font: { family: "Poppins" } } },
                    plugins: { legend: { labels: { font: { family: "Poppins" } } } },
                },
            }))),
            document.getElementById("keywordRankingPositionChart"));
lineChart.render();
