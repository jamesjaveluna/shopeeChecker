
var localNotification = { "notifications": [] };
var isRtl = $('html').attr('data-textdirection') === 'rtl';
var count = 0;

function sendNotification() {

    fetch('http://'+window.location.host+'/api/notification.php?op=get_notifications')
        .then(response => response.json())
        .then(json =>
            json.notification.forEach(test => {
                count++;
                if (test.id == 10003 || test.id == 100017) {
                    reload_points();
                }

                if (test.id != 0) {
                    toastr[test.type](
                        test.desc,
                        test.title,
                        {
                            timeOut: 5000 * count,
                            closeButton: true,
                            tapToDismiss: false,
                            progressBar: true,
                            rtl: isRtl
                        }
                    )
                }
                
            })
        );


    setTimeout(function () {
        toast_all();
    }, 5000);
    
}
