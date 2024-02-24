let apiBaseUrl;
let Dashboard = function (base_url) {
    apiBaseUrl = base_url;
    // binding events as soon as the object is instantiated
    this.bindEvents();

};
Dashboard.prototype = {

    bindEvents: function () {
        //CSRF token set for Ajax call on post-method
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        this.init();
    },

    init: function () {
        this.lastCompletedTasks();
        this.nextDueTasks();
        // this.taskOverViewChart();
        this.projectTaskStatusChart();
        this.projectTaskhourStatusChart();
    },
    lastCompletedTasks: function (url = 0){
        let apiUrl = url ? url :  `${apiBaseUrl}/last-completed-tasks?`;
        common.ajaxCallGetRequest(apiUrl, (response) => {
            $('#lastCompletedTasksHolder').html(response.data);
        })
    },
    nextDueTasks: function (url = 0){
        let apiUrl = url ? url :  `${apiBaseUrl}/next-due-tasks?`;
        common.ajaxCallGetRequest(apiUrl, (response) => {
            $('#nextDueTasksHolder').html(response.data);
        })
    },
    taskOverViewChart: function(url = 0, month = new Date().toJSON().slice(0, 7)) {
        let apiUrl = url ? url :  `${apiBaseUrl}/task-overview-chart?month=${month}`;
        common.ajaxCallGetRequest(apiUrl, (response) => {
            $('#columnChartHolder').html('<div id="column_chart"></div>');
            var options = {
                series: [{
                    name: 'COMPLETED',
                    data: Object.values(response.completed)
                }, {
                    name: 'DUE DATE',
                    data: Object.values(response.inCompleted)
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    toolbar: { show: false }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }],
                xaxis: {
                    categories: Object.values(response.range),
                },
                fill: {
                    opacity: 1
                },
                legend: {
                    position: 'bottom',
                    offsetX: 0,
                    offsetY: 0
                },
            };
            let chart = new ApexCharts(document.querySelector("#column_chart"), options);
            chart.render();
        })
    },
    projectTaskStatusChart: function(url = 0){
        let apiUrl = url ? url :  `${apiBaseUrl}/project-task-status-chart`;
        common.ajaxCallGetRequest(apiUrl, (response) => {
            $('#simple_pie_chartHolder').html('<div id="simple_pie_chart"></div>');
            var options = {
                series: [response.completed, response.inCompleted],
                chart: { height: 300, type: "pie" },
                labels: ["Completed", "Incomplete"],
                legend: { position: "bottom" },
                colors: [
                    '#2c9edc',
                    '#ff9696'
                ],
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + ' %';
                    },
                },
                title: {
                    text: `Total Tasks: ${response.total}`,
                }
            };
            new ApexCharts(document.querySelector("#simple_pie_chart"), options).render();
        });
    },
    projectTaskhourStatusChart: function(url = 0){
        let apiUrl = url ? url :  `${apiBaseUrl}/project-task-hour-status`;
        common.ajaxCallGetRequest(apiUrl, (response) => {
            $('#project_task_hour_status_holder').html('<div id="project_task_hour_status"></div>');
            var options = {
                series: [response.completed, response.inCompleted],
                chart: { height: 300, type: "pie" },
                labels: ["Completed", "Incomplete"],
                legend: { position: "bottom" },
                colors: [
                    '#2c9edc',
                    '#ff9696'
                ],
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + ' %';
                    },
                },
                title: {
                    text: `Total Warking Hour: ${response.total}`,
                }
            };
            new ApexCharts(document.querySelector("#project_task_hour_status"), options).render();
        });
    }
}
