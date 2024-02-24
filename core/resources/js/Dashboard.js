let userId;
let baseUrl;
let userType;
let Dashboard = function (user_id = 0, userType) {
    userId = user_id;
    userType = userType;
    baseUrl = window.location.href;

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

    },
    loadAdminDashboard: function () {
        this.getProjectCount();
        this.getOverDueTasks();
        this.getNextDueTasks();
    },
    loadManagerDahsboard: function(){
        this.getOverDueTasks();
        this.getNextDueTasks();
    },
    loadExecutiveDashboard:()=>{
        Dashboard.prototype.getTodayDueTasks();
        Dashboard.prototype.getNextDueTasks();
    },
    getProjectCount:(callback = null)=>{
        let url = `${baseUrl}/get-projects?uid=${userId}`
        if (userType === 'client')
            url = `${baseUrl}/get-projects?uid=${userId}`
        common.ajaxCallGetRequest(url, (response)=>{
            $('#projectCounterHolder').html(response.data);
            if(callback) callback();
        });
    },
    getTodayDueTasks:(projectId = 0, callback = null)=>{
        let url = `${baseUrl}/today-due-tasks?uid=${userId}&project_id=${projectId}`
        common.ajaxCallGetRequest(url, (response)=>{
            $('#todayDueTasksHolder').html(response.data);
            $('#todayDueCount').html(response.count);
            if(callback) callback();
        });
    },
    getOverDueTasks:(projectId = 0, callback = null)=>{
        let url = `${baseUrl}/over-due-tasks?uid=${userId}&project_id=${projectId}`
        common.ajaxCallGetRequest(url, (response)=>{
            $('#overDueTaskHolder').html(response.data);
            $('#overDueCount').html(response.count);
            if(callback) callback();
        });
    },
    getNextDueTasks:(projectId = 0, callback = null)=>{
        let url = `${baseUrl}/next-due-tasks?uid=${userId}&project_id=${projectId}`
        common.ajaxCallGetRequest(url, (response)=>{
            $('#nextDueTasksHolder').html(response.data);
            $('#nextDueCount').html(response.count);
            if(callback) callback();
        });
    },
    getNextDayTasks:(projectId = 0, callback = null)=>{
        let url = $('#hdnNextDayTasksPath').val();
        common.ajaxCallGetRequest(url, (response)=>{
            $('#nextDayTasksHolder').html(response.data);
            if(callback) callback();
        });
    },
    randerprojectTasksStatusChart:(projectId = 0, month = new Date().toJSON().slice(0, 7))=>{
        let url = `${baseUrl}/project-tasks-chart?uid=${userId}&project_id=${projectId}&month=${month}`;
        $('#columnChartHolder').html(`<div class="w-100 d-flex justify-content-center align-items-center h-100">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>`);
        common.ajaxCallGetRequest(url, (response)=>{
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
            // chart.updateSeries([{
            //     name: 'COMPLETED',
            //     data: Object.values(response.completed)
            // }, {
            //     name: 'DUE DATE',
            //     data: Object.values(response.inCompleted)
            // }], true)
        });
    },

    openTaskDetailsModal: (task_id, url) => {
        taskId = task_id;
        common.ajaxCallGetRequest(url.replace('task_id', task_id), ({data}) => {
            $('#taskModal').html(data.model_view).modal('show');
            counterElement = document.getElementById('timer');
            if(data.tracker_start)
            {
                startTime = new Date(data.tracker_start);
                Task.prototype.startTimer();
            }

            //load activities
            Task.prototype.loadActivities();

            //load attachments
            Task.prototype.loadAttachments();

            //Load Comments
            Task.prototype.loadComments();
            if(data.type === 1){
                Task.prototype.loadSubtask()
            }
            Task.prototype.loadActionItems();
        });
    },
};




