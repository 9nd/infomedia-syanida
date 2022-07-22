var extensionId = 0;
var currentAgentStatus = '';
var currStatusTimestamp = new Date();
var currState;
var stop_flag = false;
var auxState = 0;
var aux_pending_flag = false;
var tid;
var loopFlag = true;
var holdKey = 'key';
var auxKey = 'key';
var reasonTranslation;
var pbxCampaignId = null;
var loginTime = null;
var base_url = window.location.origin + "/smartcollection";
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
});

window.initCustomWebphone = function () //Bikin komponen Aux dan floating dialer
{
    // let content = document.getElementsByClassName('mizu_custom_control');
    // let newDivItem = document.createElement('div');
    // newDivItem.setAttribute('id', 'divMizuvoipControl');
    // newDivItem.setAttribute('style', 'display:none;');
    // newDivItem.innerHTML = '<div id="divMizuvoipControlBody" style="background-color: rgba(0, 0, 0, 0);"><div class="row py-1"><div class="input-group w-100"><input type="text" class="form-control" placeholder="Destination number" id="destnumber" autocapitalize="off"><div class="input-group-append" id="dial_group"><button class="btn btn-success" type="button" id="btn_call" onclick="Call();"><i class="fas fa-phone"></i></button></div></div></div><div class="row py-1" id="incoming_call_layout"><div class="btn-group w-100" role="group"><button type="button" class="btn btn-success" id="btn_accept" onclick="Accept();">Accept</button><button type="button" class="btn btn-danger" id="btn_reject" onclick="Reject();">Reject</button></div></div><iframe allow="microphone; camera" style="display:none" height="0" width="0" id="loader"></iframe><div id="video_container" style="display: none;"></div></div>';

    // // newDivItem.innerHTML += '<div class="card-footer" id="divMizuvoipControlFooter"><button type="button" class="btn btn-primary" id="btn_start" onclick="Start();">Start</button><div id="events" style="width: 13em;">App Loaded</div></div>';
    // content[0].appendChild(newDivItem);
    // // dragElement(document.getElementById("divMizuvoipControl"));
    // let newDivControl = document.createElement('div');
    // newDivControl.setAttribute('id', 'divMizuvoipSideControl');
    // newDivControl.innerHTML = '<div class="mt-3"><div class="row py-1"><div class="btn-group w-100" role="group"><button type="button" class="btn btn-primary" id="btn_hold" onclick="Hold(true);">Hold</button></div></div><div class="row py-1"><div class="form-group row mb-0 ml-1"><label for="drp_aux" class="col-sm-3 col-form-label">AUX</label><div class="col-sm-9"><select class="form-control select2 w-100" id="drp_aux" onchange="Aux()"><option value="0" selected="">Ready</option><option value="1" id="drp_aux_1">1 Konsultasi</option><option value="2" id="drp_aux_2">2 Supporting</option><option value="3" id="drp_aux_3">3 CatHSTR</option><option value="4" id="drp_aux_4">4 Toilet</option><option value="5" id="drp_aux_5">5 Air Minum</option><option value="6" id="drp_aux_6">6 Sholat</option><option value="7" id="drp_aux_7">7 Lunch</option><option value="8" id="drp_aux_8">8 Briefing</option><option value="9" id="drp_aux_9">9 Update System</option></select></div></div></div></div>';
    // let sideControl = document.getElementById('mizuSideControl');
    // sideControl.appendChild(newDivControl);

    // document.getElementById('incoming_call_layout').style.display = 'none';

    // document.getElementById('pendingDateTimeRow').style.display = 'none';
}

window.hideElement = function () {
    if (document.getElementById('divMizuvoipControl')) {
        document.getElementById('divMizuvoipControl').style.display = 'none';
    }
}

window.showElement = function (mode = null) {
    // let elmnt = document.getElementById('divMizuvoipControl');
    // elmnt.style.display = 'block';
    // if (mode == 'inbound') {
    //     document.getElementById('btn_call').style.display = 'none';
    //     document.getElementById('destnumber').disabled = true;
    // } else {
    //     document.getElementById('btn_call').style.display = 'block';
    //     document.getElementById('incoming_call_layout').style.display = 'none';
    //     document.getElementById('destnumber').disabled = false;
    // }
}

window.canSwitchServer = function ()  //TODO dipakai ?
{
    $.ajax({
        type: 'POST',
        url: base_url + '/mizuvoip/getLoginDuration',
        success: function (data) {
            return data == 1;
        },
        error: function (data) {
            console.log('ERR RelExt');
            console.log(data);
        }
    });
}

window.setCampaignId = function (campaignId) //Set pbx campaign id yg mau dipakai
{
    if (pbxCampaignId == null && campaignId != null) {
        pbxCampaignId = campaignId;
        return campaignId;
    } else if (campaignId == pbxCampaignId) {
        return null;
    } else {
        stop();
        return campaignId;
    }
}

window.getCampaignId = function () {
    return pbxCampaignId;
}

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

window.releaseExtension = function () { //release extension saat logout
    let formData = {
        campaign_id: pbxCampaignId,
    };
    $.ajax({
        type: 'POST',
        url: base_url + '/mizuvoip/relext',
        data: formData,
        dataType: 'json',
        error: function (data) {
            console.log('ERR RelExt');
            console.log(data);
        }
    });
}

window.updateAgentStatus = function (agent_status = null, connected_number = null) {  //Update agent status untuk CMS
    let nowDateTime = new Date();
    let formData = {
        campaign_id: pbxCampaignId,
        extension_id: extensionId,
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
    document.getElementById('duration_status').innerHTML = GetDuration(Math.floor((nowDateTime.getTime() - currStatusTimestamp.getTime()) / 1000));
    // if (pbxCampaignId != null) {
    $.ajax({
        type: 'POST',
        url: base_url + '/Mizu/Mizu/updstat',
        data: formData,
        dataType: 'json',
        success: function () {
            if (agent_status == 'App Stopped') {
                pbxCampaignId = null;
            }
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

webphone_api.parameters['autostart'] = 0;

webphone_api.onAppStateChange(function (appState) {
    if (appState === 'loaded') {
        sendEvent('App Loaded');
    }
    else if (appState === 'started') {
        // updateAgentStatus('Ready', '');
        // updateAuxState();
        sendEvent('App Started');
    }
    else if (appState === 'stopped') {
        // releaseExtension();
        loginTime = null;
        loopFlag = false;
        // updateAgentStatus('App Stopped');
        // pbxCampaignId = null;
        // document.getElementById('divMizuvoipControl').style.display = 'none';
        // hideElement();
        sendEvent('App Stopped');
    }
});

webphone_api.onRegStateChange(function (regState) {

    if (regState === 'registered') {
        updateAgentStatus('Ready', '');
        updateAuxState();
        sendEvent('Ext Registered');
        console.log('Ext Registered');
    }
    else if (regState === 'unregistered') {
        switch (parseInt(auxState)) {
            case 1:
                updateAgentStatus('Aux Konsultasi', '');
                break;
            case 2:
                updateAgentStatus('Aux Supporting', '');
                break;
            case 3:
                updateAgentStatus('Aux CatHSTR', '');
                break;
            case 4:
                updateAgentStatus('Aux Toilet', '');
                break;
            case 5:
                updateAgentStatus('Aux Air Minum', '');
                break;
            case 6:
                updateAgentStatus('Aux Sholat', '');
                break;
            case 7:
                updateAgentStatus('Aux Lunch', '');
                break;
            case 8:
                updateAgentStatus('Aux Briefing', '');
                break;
            case 9:
                updateAgentStatus('Aux Update System', '');
                break;
        }
        updateAuxState();
        sendEvent('Ext UnRegistered');
    }
    else if (regState === 'failed') {
        updateAgentStatus('Ext Register failed', '');
        sendEvent('Ext Register failed');
    }
});

window.translateReason = function (reason, parameter = null) {
    let reasonResult;
    if (reason in reasonTranslation.defined) {
        Object.entries(reasonTranslation.defined[reason]).forEach(([key_result, value_result]) => {
            let tempBool = false;
            Object.values(value_result).forEach(value => {
                switch (value.operator) {
                    case '<':
                        tempBool = parameter[value.field] < value.value;
                        break;
                    case '<=':
                        tempBool = parameter[value.field] <= value.value;
                        break;
                    case '=':
                        tempBool = parameter[value.field] == value.value;
                        break;
                    case '>':
                        tempBool = parameter[value.field] > value.value;
                        break;
                    case '>=':
                        tempBool = parameter[value.field] >= value.value;
                        break;
                    default:
                        break;
                }
            });
            if (!tempBool) { reasonResult = key_result }
        });
    } else if (!(reasonTranslation.undefined.includes(reason))) {
        $.ajax({
            type: 'POST',
            url: base_url + '/mizuvoip/updateReason',
            data: {
                extension_id: extensionId,
                reason: reason,
            },
            dataType: 'json',
            success: function (data) {
                reasonTranslation = data;
            },
            error: function (data) {
                console.log('ERR UpdReason');
                console.log(data);
            }
        });
    }
    return reasonResult;
}

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

    // if (holdState) //TODO sendevent hold and unhold
    // {
    //     document.getElementById('btn_hold').innerText = 'un-Hold';
    //     document.getElementById("btn_hold").onclick = function () { Hold(false); };
    //     updateAgentStatus('Hold'); 
    // } else {
    //     document.getElementById('btn_hold').innerText = 'Hold';
    //     document.getElementById("btn_hold").onclick = function () { Hold(true); };
    //     updateAgentStatus('Call Connected');
    // }
}

window.updateAuxState = function () { //Update AUX untuk CMS
    let formData = {
        aux_val: auxState,
        campaign_id: pbxCampaignId,
        key_val: auxKey,
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
            webphone_api.unregister();
        }
    } else {
        webphone_api.register();
        for (let index = 1; index < 10; index++) {
            document.getElementById('drp_aux_' + index).disabled = false;
        }
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