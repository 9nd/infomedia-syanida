var extensionId = 0;
var currentAgentStatus = '';
var currStatusTimestamp = new Date();
var currState;
var stop_flag = false;
var auxState = 0;
var aux_pending_flag = false;
var aux_flag = false;
var tid;
var loopFlag = true;
var holdKey = 'key';
var auxKey = 'key';
var reasonTranslation;
var pbxCampaignId = null;
var loginTime = null;
var base_url = window.location.origin + "/dashboard/app";
var aux_flag = false;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
});

window.getLoginTime = function () {
    return loginTime;
}

window.checkState = function () {
    return currState;
}

window.sendEvent = function (event) {
    currState = event;
    document.getElementById('status_highlight').innerHTML = event;
    if (typeof catchStateEvent === "function") {
        catchStateEvent(event);
    }
}

webphone_api.parameters['autostart'] = 0;

webphone_api.onAppStateChange(function (appState) {
    if (appState === 'loaded') {
        sendEvent('App Loaded');
    }
    else if (appState === 'started') {
        updateAgentStatus('Ready', '');
        sendEvent('App Started');
    }
    else if (appState === 'stopped') {
        loginTime = null;
        loopFlag = false;

        sendEvent('App Stopped');
    }
});
window.updateAgentStatus = function (agent_status = null, connected_number = null, aux_id = 0) {  //Update agent status untuk CMS
    console.log("update agent status");
    let nowDateTime = new Date();
    let formData = {
        agent_status: ""
    };
    if (agent_status != null) {
        formData.agent_status = agent_status;
        if (currentAgentStatus != agent_status) {
            currentAgentStatus = agent_status;
            currStatusTimestamp = new Date();
        }
    } else {
        formData.agent_status = currentAgentStatus;
    }
    formData.status_duration = Math.floor((nowDateTime.getTime() - currStatusTimestamp.getTime()) / 1000);
    if (connected_number != null) {
        formData.connected_number = connected_number;
    }
    if (aux_flag == true) {
        formData.aux_id = auxState;
    }

    document.getElementById('duration_status').innerHTML = GetDuration(Math.floor((nowDateTime.getTime() - currStatusTimestamp.getTime()) / 1000));
    // if (pbxCampaignId != null) {
    $.ajax({
        type: 'POST',
        url: base_url + '/Mizu/Mizu/updstat',
        data: formData,
        dataType: 'json',
        success: function () {

        },
        error: function (data) {
            console.log('ERR UpdStat');
            console.log(data);
        }
    });
    // }
    if (loopFlag) {
        tid = setTimeout(updateAgentStatus, 5000);
    } else {
        clearTimeout(tid);
    }
}
webphone_api.onRegStateChange(function (regState) {
    console.log(regState);
    if (regState === 'registered') {
        updateAgentStatus('Ready', '');
        sendEvent('Ext Registered');
        console.log('Ext Registered');
    }
    else if (regState === 'unregistered') {
        switch (parseInt(auxState)) {
            case 1:
                updateAgentStatus('Aux Konsultasi', '', auxState);
                break;
            case 2:
                updateAgentStatus('Aux Supporting', '', auxState);
                break;
            case 3:
                updateAgentStatus('Aux CatHSTR', '', auxState);
                break;
            case 4:
                updateAgentStatus('Aux Toilet', '', auxState);
                break;
            case 5:
                updateAgentStatus('Aux Air Minum', '', auxState);
                break;
            case 6:
                updateAgentStatus('Aux Sholat', '', auxState);
                break;
            case 7:
                updateAgentStatus('Aux Lunch', '', auxState);
                break;
            case 8:
                updateAgentStatus('Aux Briefing', '', auxState);
                break;
            case 9:
                updateAgentStatus('Aux Update System', '', auxState);
                break;
        }
        sendEvent('Ext UnRegistered');
    }
    else if (regState === 'failed') {
        updateAgentStatus('Ext Register failed', '');
        sendEvent('Ext Register failed');
    }
});



webphone_api.onCdr(function (caller, called, connecttime, duration, direction, peerdisplayname, reason, line) {
    let param = new Array();
    param['duration'] = duration;
    param['direction'] = direction;
    param['line'] = line;
    param['connecttime'] = connecttime;


    //TODO module callback system
    if (typeof catchOnCdrTranslatedReason === "function") {
        catchOnCdrTranslatedReason(translateReason(reason, param));
    }
    $.ajax({
        type: 'POST',
        url: base_url + '/mizuvoip/handling',
        data: {
            campaign_id: pbxCampaignId,
            duration: Math.floor((parseInt(duration, 10) + 500) / 1000),
        },
        dataType: 'json',
        error: function (data) {
            console.log('ERR UpdHandling');
            console.log(data);
        }
    });
});

window.callbackStart = function (data) {
    if (data != null) {
        console.log(data['server']);
 	webphone_api.setparameter('serveraddress', data['server']);
        webphone_api.setparameter('username', data['username']);
        webphone_api.setparameter('password', data['password']);
        extensionId = data['id'];
        webphone_api.start();
        loopFlag = true;
        sendEvent('Initializing');
    } else {
        sendEvent('Ext None Available');
    }
}
webphone_api.onCallStateChange(function (event, direction, peername, peerdisplayname, line, callid) {
    sendEvent('Call ' + event);

    if (event === 'setup') {
        document.getElementById("btn_call").onclick = function () { Hangup(); };
        document.getElementById('btn_call').classList.add('btn-danger');
        document.getElementById('btn_call').classList.remove('btn-success');

        if (direction == 1) {
            // means it's outgoing call
        }
        else if (direction == 2) {
            // means it's icoming call

            document.getElementById('incoming_call_layout').style.display = 'block';
        }

        updateAgentStatus('Call Setup');
        sendEvent('Call setup');
    }
    //detecting the end of a call, even if it wasn't successfull
    else if (event === 'disconnected') {
        document.getElementById("btn_call").onclick = function () { Call(); };
        document.getElementById('btn_call').classList.add('btn-success');
        document.getElementById('btn_call').classList.remove('btn-danger');

        if (!(aux_pending_flag && stop_flag)) {
            sendEvent('Call disconnected');
        }
        if (aux_pending_flag) {
            for (let index = 1; index < 10; index++) {
                if (index != parseInt(auxState)) {
                    document.getElementById('drp_aux_' + index).disabled = true;
                }
            }
            webphone_api.unregister();
            aux_pending_flag = false;
        }
        if (stop_flag) {
            webphone_api.stop();
            stop_flag = false;
        }
        updateAgentStatus('Call Disconnected');
        document.getElementById('destnumber').disabled = false;

    }
    else if (event === 'connected') {
        document.getElementById('destnumber').disabled = true;
        updateAgentStatus('Call Connected', document.getElementById('destnumber').value);
    }
});
window.Start = function () //Start webphone
{
    // Minta assignment user -> extension, dan setup koneksi softphone
    $.ajax({
        type: 'POST',
        url: base_url + '/Mizu/Mizu/getext',
        dataType: 'json',
        // async: false,
        success: function (data) {
            callbackStart(data);
        }
    });
}

window.Stop = function () //Stop webphone
{
    if (webphone_api.isincall()) {
        stop_flag = true;
    } else {
        webphone_api.stop();

    }
    loopFlag = false;
    updateAgentStatus('Offline', '');
    sendEvent('App Stopping');
}

window.Call = function (destination = null) //Call Function
{
    if (destination != null) {
        document.getElementById('destnumber').value = destination;
    }
    let destnr = document.getElementById('destnumber').value;
    if (typeof (destnr) === 'undefined' || destnr === null) { destnr = ''; }

    document.getElementById('destnumber').disabled = true;

    webphone_api.setparameter('destination', destnr);
    webphone_api.call(destnr);
}

window.Hangup = function () //Hangup
{
    webphone_api.hangup();
    // sendEvent('Ext Registered.');
}

window.callbackHold = function (data, holdState) {
    if (holdState) {
        holdKey = data.key;
    }
    if (holdState) //TODO sendevent hold and unhold
    {
        document.getElementById('btn_hold').innerText = 'un-Hold';
        document.getElementById("btn_hold").onclick = function () { Hold(false); };
        updateAgentStatus('Hold');
    } else {
        document.getElementById('btn_hold').innerText = 'Hold';
        document.getElementById("btn_hold").onclick = function () { Hold(true); };
        updateAgentStatus('Call Connected');
    }
}

window.Hold = function (holdState) {
    webphone_api.hold(holdState);
    let formData = {
        hold_val: holdState,
        campaign_id: pbxCampaignId,
        key_val: holdKey,
    };
    $.ajax({
        type: 'POST',
        url: base_url + '/mizuvoip/hold',
        data: formData,
        dataType: 'json',
        // async: false,
        success: function (data) {
            // if (holdState) {
            //     holdKey = data.key;
            // }
            callbackHold(data, holdState);
        },
        error: function (data) {
            console.log('ERR Hold');
            console.log(data);
        }
    });

    if (holdState) //TODO sendevent hold and unhold
    {
        document.getElementById('btn_hold').innerText = 'un-Hold';
        document.getElementById("btn_hold").onclick = function () { Hold(false); };
        updateAgentStatus('Hold');
    } else {
        document.getElementById('btn_hold').innerText = 'Hold';
        document.getElementById("btn_hold").onclick = function () { Hold(true); };
        updateAgentStatus('Call Connected');
    }
}


window.Accept = function () {
    document.getElementById('incoming_call_layout').style.display = 'none';
    webphone_api.accept();
}

window.Reject = function () {
    document.getElementById('incoming_call_layout').style.display = 'none';
    webphone_api.reject();
}



window.GetTickCount = function () // returns the current time in milliseconds
{
    let currDate = new Date();
    return currDate.getTime();
}
window.GetDuration = function (secondna) {
    var sec_num = parseInt(secondna); // don't forget the second param
    var hours = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours < 10) { hours = "0" + hours; }
    if (minutes < 10) { minutes = "0" + minutes; }
    if (seconds < 10) { seconds = "0" + seconds; }
    return hours + ':' + minutes + ':' + seconds;
}
window.updateAuxState = function () { //Update AUX untuk CMS
    let formData = {
        aux_val: auxState,
    };
    $.ajax({
        type: 'POST',
        url: base_url + '/Mizu/Mizu/aux',
        data: formData,
        dataType: 'json',
        success: function (data) {
            if (parseInt(auxState) != 0) {
                auxKey = data.key;
            } else {
                auxKey = 'key';
            }
        },
        error: function (data) {
            console.log('ERR Aux');
            console.log(data);
        }
    });
}

window.Aux = function () //TODO standardize aux
{
    auxState = parseInt(document.getElementById("drp_aux").selectedIndex);
    if (parseInt(auxState) != 0) {
        if (webphone_api.isincall()) {
            aux_pending_flag = true;
        } else {
            for (let index = 1; index < 10; index++) {
                if (index != parseInt(auxState)) {
                    document.getElementById('drp_aux_' + index).disabled = true;
                }
            }
            Stop();
            aux_flag = true;
            document.getElementById('mizu_control').style.display = 'none';
        }
    } else {
        // webphone_api.register();
        Start();
        aux_flag = false;
        document.getElementById('mizu_control').style.display = 'block';
        callDelayedNumber();
        for (let index = 1; index < 10; index++) {
            document.getElementById('drp_aux_' + index).disabled = false;
        }
    }
}
