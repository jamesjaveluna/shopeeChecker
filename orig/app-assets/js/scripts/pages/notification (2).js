
var localNotification = { "notifications": [] };
var isRtl = $('html').attr('data-textdirection') === 'rtl';
//var data = localStorage.getItem('notifications');
//var notifications = localStorage.getItem("notifications");
//var data = localStorage.getItem('notifications');

var getJSON = function (url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'json';
    xhr.onload = function () {
        var status = xhr.status;
        if (status === 200) {
            callback(null, xhr.response);
        } else {
            callback(status, xhr.response);
        }
    };
    xhr.send();
};


//stringify = json to string
//parse = string to json

function startNotification() {
    if (!localStorage.getItem('notifications')) {
        localStorage.setItem('notifications', JSON.stringify(localNotification));
        //console.log("Started Local Storage for Notification");
    } else {
        //console.log("Local Storage already started.");
    }
}

function addNotification(id, value) {
    startNotification();
    //console.log("Read: " + localStorage.notifications);

    var obj = JSON.parse(localStorage.notifications);
    obj['notifications'].push({ "id": id, "value": value });
    //console.log("ADDED: " + id + ", " + value);

    localStorage.setItem('notifications', JSON.stringify(obj));
    //console.log("Check [obj]: " + JSON.stringify(obj));

    //console.log("Check: " + localStorage.notifications);

    setTimeout(function () {
        //sendNotification();
    }, 2000);
   
};

function sendNotification() {
       // startNotification();
    var data = JSON.parse(localStorage.getItem('notifications'));

    fetch('../app-assets/system/en/toast.json')
        .then(response => response.json())
        .then(json => 
            json.notifications.forEach(test => {
                //console.log("FETCH (test): " + JSON.stringify(test));
                //console.log("testing: " + JSON.stringify(data));
                for (var key in data.notifications) {
                    //console.log(test.id + "(Fetch) == " + data.notifications[key].id+" (User)")
                    if (test.id == data.notifications[key].id) {
                        //console.log("Toast loaded");
                        toastr[test.type](
                            test.desc.replace(/{(.*?)}/, data.notifications[key].value[1]),
                            test.title.replace(/{(.*?)}/, (data.notifications[key].value[0]).toLocaleString('en')),
                            {
                                timeOut: 5000 + (2000 * key + 1),
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            }
                        )
                    }
                }

            })
    );

    setTimeout(function () {
        emptyNotification();
        //console.log("Clearing Check: " + JSON.stringify(localStorage.getItem('notifications')));
    }, 5000);
}


function emptyNotification() {
    localStorage.setItem('notifications', JSON.stringify(localNotification));
    //console.log("Empty notifications already.");
}