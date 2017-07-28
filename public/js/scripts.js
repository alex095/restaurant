function ClearAllIntervals() {
        for (var i = 1; i < 99999; i++)
            window.clearInterval(i);
    }

function getTimeRemaining(endtime){
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = timeFormat(Math.floor( (t/1000) % 60 ));
    var minutes = timeFormat(Math.floor( (t/1000/60) % 60 ));
    var hours = timeFormat(Math.floor( (t/(1000*60*60)) % 24 ));
    return {
        'total': t,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };  
}

function timeFormat(number){
    if(number < 10){
        return '0' + number;
    }
    return number;
}

function initializeClock(id, endtime){
    var clock = document.getElementById(id);
    var timeinterval = setInterval(function(){
    var t = getTimeRemaining(endtime);
    clock.innerHTML = t.hours + ':' + t.minutes + ':' + t.seconds;
    if(t.total<=0){
        clearInterval(timeinterval);
            clock.innerHTML = '00:00:00';
    }
    }, 1000);
}

function changeTimers(){
    $('.timerValue').map(function(el){
        makeTime(new Date(parseInt($(this).text())), $(this).attr('id').substring(7));
    });        
}

function makeTime(timestamp, id){
    if((Date.parse(timestamp) - Date.parse(new Date())) <= 0 || timestamp == '00:00:00'){
        initializeClock('timetd' + id, new Date(new Date(timestamp).getTime() + 60000));
    }else{
        initializeClock('timetd' + id, new Date(timestamp));
    }
}

function setTimer(id, csrfToken){
    var time = new Date().getTime();
    var finishTime = time + (parseInt(document.getElementById('time' + id).value)) * 60000;
    document.getElementById('timetdd' + id).innerHTML = finishTime;
    initializeClock('timetd' + id, new Date(finishTime));
    saveTimerData(id, finishTime, csrfToken);
    //60000ms = 1m
}


function saveTimerData(id, time, csrfToken){
    $.ajax({
        type: "POST",
        url: "saveTime",
        data: {
            "id": id,
            "time": time,
            "_token": csrfToken
        }, success: function(msg){
                console.log(msg);
            }
    });
}

function changeStatus(id, csrfToken){
    $('#statustd' + id).text($('#chngStatus' + id).val());
    var statusesIDs = {
        "ready" : 1,
        "is preparing": 2,
        "kitchen": 4
    };
    saveChangedStatus(id, statusesIDs[$('#chngStatus' + id).val()], csrfToken);
}


function saveChangedStatus(orderId, statusId, csrfToken){
    $.ajax({
        type: "POST",
        url: "saveStatus",
        data: {
            "orderId": orderId,
            "statusId": statusId,
            "_token": csrfToken
        },
        success: function(msg){
            console.log(msg);
        }
    });
}

function sortTable(tdName){
    var data = [];
    $('.tableData > td.' + tdName).map(function(index){
        data.push($(this).text() + index);
    });
    var rows = {};
    $('.tableData').map(function(index){
        rows[data[index]] = $(this).html();
    });

    data.sort(function (a, b) {
        return a.localeCompare(b);
    });
    data = checkIfSorted(data); 

    $('.tableData').map(function(index){
        $(this).html(rows[data[index]]);
    });

    changeTimers();
}


function checkIfSorted(data){
    var ind = $('#sort');
    if(ind.val() === '0'){
        ind.val(1);
        return data;
    }else{
        ind.val(0);
        return data.reverse();
    }
}