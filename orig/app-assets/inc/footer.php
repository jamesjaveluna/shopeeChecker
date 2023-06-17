 <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">Creating Ticket</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="javascript:void(0);" onsubmit="create_ticket();">
                                                            <div class="modal-body">
                                                                <label>Subject: </label>
                                                                <div class="form-group">
                                                                    <input name="title" type="text" placeholder="" class="form-control" />
                                                                </div>

                                                                <label>Message: </label>
                                                                <div class="form-group">
                                                                    <textarea name="content" class="form-control" rows="3" placeholder="" spellcheck="false"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="create_ticket();">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
 
<footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2023 |  All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    
 <script>
	<?php
		if(isset($_SESSION['loggedIn'])) {
			echo 'let user_points = '.$_SESSION['user_points'].';';
			echo 'let user_id = '.$_SESSION['user_id'].';';
		}

	?>

 document.addEventListener('click', (e) =>
  {
    let elementId = e.target.id;


	//console.log("Detected: "+elementId);

    if(elementId === 'logout'){
		$.ajax({
				url:'../../api/account/login.php?op=logout',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					addNotification(10005, [null, null]);
				},
				success:function(resp){
					const obj = JSON.parse(resp);
					addNotification(obj.code, [obj.value[0], obj.value[1]]);
				}
		})

		setTimeout(function () {
             sendNotification();
			  location.href = '../../login.php';
        }, 1000);
    }
  }
);

	<?php
		if(isset($_SESSION['loggedIn'])) {

		}

	?>

	document.querySelector('#reload').addEventListener('click', function(){ 
				reload_points();
	});

	function read_all(){
				$.ajax({
						url:'../../api/notification.php?op=mark_read_all',
						method:'POST',
						data: {
							user_id: user_id
						},
						error:err=>{
							console.log(err)
							addNotification(10005, [null, null]);
						},
						success:function(resp){
							document.getElementById("notification_count").remove();
							document.getElementById("notification_new_count").remove();
						}
				})
	}


	function toast_all(){
				$.ajax({
						url:'../../api/notification.php?op=mark_toasted_all',
						method:'POST',
						data: {
							user_id: user_id
						},
						error:err=>{
							console.log(err)
							addNotification(10005, [null, null]);
						},
						success:function(resp){
							//Empty all toast
						}
				})
	}

	//Get notification count
	function get_notification(){
				$.ajax({
						url:'../../api/notification.php?op=get_count',
						method:'POST',
						data: {
							user_id: user_id
						},
						beforeSend:function(){
							if(document.getElementById('notification_count') != null){
								document.getElementById("notification_count").remove();
							}
						},
						error:err=>{
							console.log(err)
							addNotification(10005, [null, null]);
						},
						success:function(resp){
							if(resp != 0){
								$('#notification').append(' <span id="notification_count" class="badge badge-pill badge-danger badge-up">'+resp+'</span>');
								update_notification();
								sendNotification();
							}
						}
				})
	}

	//Update notification in the bell
	function update_notification(){
				$.ajax({
						url:'../../api/notification.php?op=get_notifications_bell',
						method:'POST',
						data: {
							user_id: user_id
						},
						beforeSend:function(){
							const element = document.getElementById("notification_tab");
 								while (element.firstChild) {
 									element.removeChild(element.lastChild);
  							}
						},
						error:err=>{
							console.log(err)
							addNotification(10005, [null, null]);
						},
						success:function(resp){
							//var menu = pmgroot.getElementById("notification)tab")[0];
							//var aEl  = document.createElement(resp);
							//menu.appendChild(aEl);
							$('#notification_tab').append(resp);
								$('.scrollable-container').each(function () {
									var scrollable_container = new PerfectScrollbar($(this)[0], {
									  wheelPropagation: false
								});
    });
						}
				})
	}

	function create_ticket(){
				$.ajax({
						url:'../../api/support.php?op=create_ticket',
						method:'POST',
						data: {
							title: $("input[name='title']").val(),
							message: $("textarea[name='content']").val()
						},
						beforeSend:function(){
							
						},
						error:err=>{
							console.log(err)
							addNotification(10005, [null, null]);
						},
						success:function(resp){
							toastr[resp.type](resp.desc, resp.title, {
							    closeButton: true,
							    tapToDismiss: false,
							    rtl: isRtl
							});
						}
				})

		setTimeout(function () {
			  //location.reload();
			  location.href = '../../support.php';
        }, 1000);
	}

	function reload_points(){
				$.ajax({
						url:'../../api/account/user.php?op=get_points',
						method:'POST',
						data: {
							user_id: user_id
						},
						beforeSend:function(){
							if(document.getElementById('points_spinner') == null){
								$('#reload').append('  <span id="points_spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
							}
						},
						error:err=>{
							console.log(err)
							addNotification(10005, [null, null]);
						},
						success:function(resp){
							const obj = JSON.parse(resp);
							console.log("RESPONSE: "+resp);
							console.log('LOG: '+parseFloat(obj.value[0].replace(/\,/g,''))+' > '+parseFloat(user_points));
							console.log(parseFloat(obj.value[0].replace(/\,/g,'')) > parseFloat(user_points));

								if(parseFloat(obj.value[0].replace(/\,/g,'')) > parseFloat(user_points)){
									const audio = new Audio('../../app-assets/system/sound/ui_moneydrop1.wav');
										audio.loop = false;
										audio.play(); 
										console.log("LOG: Earn music played");
								}

								if(parseFloat(obj.value[0].replace(/\,/g,'')) < parseFloat(user_points)){
									const audio = new Audio('../../app-assets/system/sound/ui_pay001.wav');
										audio.loop = false;
										audio.play(); 
										console.log("LOG: Pay music played");
								}
							
							document.getElementById("reload").innerHTML = "<?php echo $_config['general']['currency_symbol']; ?> "+obj.value[0];
							user_points = obj.value[0].replace(/\,/g,'');

							if(document.getElementById('points_spinner') != null){
								document.getElementById("points_spinner").remove();
							}
						}
				})
	}

	/*function notification(){
		setTimeout(function () {
                sendNotification();
				notification();
            }, 15000);
	}*/

	 setTimeout(function () {
			get_notification();
     }, 2000);

	inverval_timer = setInterval(function() { 
		get_notification();
	}, 60000);
	//}, 20000);


</script>	
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
