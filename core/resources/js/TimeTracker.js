let timeTrackerProjectId = 0;
let timeTrackerTaskId = 0;

//Timer related
let timeStartTime = null; // Set the specific start time new Date('2023-12-03 15:00:00')
let timeCounterElement; // Get the element to display the time
let timeTimerInterval = null; // Variable to store the timer interval
let timeTaskInfo = null;
let timeElapsedTime = 0;

let TimeTracker = function () {
    this.bindEvents();
};


TimeTracker.prototype = {
    bindEvents: function () {
        //CSRF token set for Ajax call on post-method
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        TimeTracker.prototype.checkTimeTracker();
        this.init();
    },
    init: function () {

    },
    checkTimeTracker: function(){
        const url = $('#hdnCheckTimeTracker').val();
        common.ajaxCallGetRequest(url, (response) => {
            timeTrackerProjectId = response.task_info.project_id;
            timeTrackerTaskId = response.task_info.task_id;

            timeStartTime = new Date(response.tracker);
            timeTaskInfo = response.task_info;
            TimeTracker.prototype.startTimer();
        });
    },
    getTasksByProject: function(projId, url){
        if (!projId) {
            $('#task_id').html('<option>--Select--<option>');
            return 0;
        }
        timeTrackerProjectId = projId;
        timeTrackerTaskId = 0;
        $('#task_id').html('<option>Loading...<option>');
        common.ajaxCallGetRequest(url.replace('PROJECT_ID', timeTrackerProjectId), ({data}) => {
            $('#task_id').html(data);
        });
    },
    changeTask: function(tskId){
        timeTrackerTaskId = tskId;
    },
    startTimerHandler: () => {
        if (TimeTracker.prototype.requirmentCheck()){
            const url = $('#hdnStartTimerUrl').val().replace('PROJECT_ID', timeTrackerProjectId).replace('TASK_ID', timeTrackerTaskId);
            common.ajaxCallPostRequest(url, {}, (res) => {
                TimeTracker.prototype.checkTimeTracker();
                timeStartTime = new Date(res.data);
                TimeTracker.prototype.startTimer();
            });
        }
    },
    stopTimerConfirmHandler: () => {
        $('#modal-stop-timer-note').modal('show');
    },
    stopTimerHandler: () => {
        const url = $('#hdnStopTimerUrl').val().replace('PROJECT_ID', timeTrackerProjectId).replace('TASK_ID', timeTrackerTaskId);
        $('#timerSection').hide();
        const note = $('#tracker_note').val();
        if(note === '')
        {
            common.showAlert('Note field is required', 'error');
            return;
        }
        common.ajaxCallPostRequest(url, {
            'note': note
        }, (res) => {
            timeStartTime = null;
            clearInterval(timeTimerInterval)
            timeCounterElement.textContent = '00:00:00';
            $('#trackerCoontroller').html(`
                 <button type="button" class="w-100 fs-16 btn btn-danger waves-effect waves-light" onclick="timeTracker.startTimerHandler()"><i  class="mdi mdi-play"></i> Start</button>
            `);
            TimeTracker.prototype.pageReload();
        });
    },
    requirmentCheck: function(){
        if(timeTrackerProjectId === 0){
            common.showAlert('Select a project', 'error');
            return false;
        }
        if(timeTrackerTaskId === 0){
            common.showAlert('Select a Task', 'error');
            return false;
        }
        return true;
    },

    /**
     * Reload current page
     *
     */
    pageReload: () => {
        window.location.reload();
    },

    startTimer: () => {
        timeCounterElement = document.getElementById('timer');
        if (timeStartTime) {
            $('#trackerCoontroller').html(`
                 <button type="button" class="w-100 fs-16 btn btn-danger waves-effect waves-light" onclick="timeTracker.stopTimerConfirmHandler()"><i class="mdi mdi-stop"></i> Stop</button>
            `);
            $('#taskName').text(timeTaskInfo.task_name);
            TimeTracker.prototype.randerOptions();
            timeTimerInterval = setInterval(() => {
                TimeTracker.prototype.updateTimer();
            }, 10);
            $('#timerSection').show();
        }
    },
    updateTimer: () => {
        const currentTime = new Date();
        const elapsedMilliseconds = currentTime.getTime() - timeStartTime.getTime();
        const seconds = elapsedMilliseconds / 1000;
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        timeCounterElement.textContent = `${hours}:${Math.floor(minutes % 60)}:${Math.floor(seconds % 60)}`;

    },
    randerOptions: () =>{
        $('#project_id').append(`
            <option value="${timeTaskInfo.project_id}" selected>${timeTaskInfo.project_name}</option>
        `).attr('disabled', true);
        $('#task_id').append(`
            <option value="${timeTaskInfo.task_id}" selected>${timeTaskInfo.task_name}</option>
        `).attr('disabled', true);
    }
}
