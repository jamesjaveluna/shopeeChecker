<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-dark navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <?php 
                // Display User Points
                if($user_isLogged)
                    echo '<button id="reload" type="button" class="btn btn-outline-primary round"><img src="https://djaveluna.online/app-assets/images/ico/coins-16.png" alt="Points" > 4,940.00</button>';
                ?>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <?php

                if($user_isLogged){
                    // User login successfully.
                ?> 
                <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up">5</span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                                <div class="badge rounded-pill badge-light-primary">6 New</div>
                            </div>
                        </li>

                        <!-- BEGIN: Notifications -->
                        <li class="scrollable-container media-list">
                            <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar"><img src="../../../app-assets/images/portrait/small/avatar-s-15.jpg" alt="avatar" width="32" height="32"></div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Read all notifications</a></li>
                        <!-- END: Notifications -->
                    </ul>
                </li>

                <li class="nav-item dropdown dropdown-user">
                	<a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                		<div class="user-nav d-sm-flex d-none">
                			<span class="user-name fw-bolder">John Doe</span>
                            <?php 
                            switch($user_type){
                                case 0:
                                    echo '<span class="user-status badge bg-primary">Primary</span>';
                                break;
                                
                                case 1:
                                    echo '<span class="user-status badge bg-secondary">Secondary</span>';
                                break;
                                
                                case 2:
                                    echo '<span class="user-status badge bg-success">Success</span>';
                                break;
                                
                                case 3:
                                    echo '<span class="user-status badge bg-danger">Danger</span>';
                                break;
                                
                                case 4:
                                    echo '<span class="user-status badge bg-warning">Warning</span>';
                                break;

                                case 5:
                                    echo '<span class="user-status badge bg-info">Info</span>';
                                break;

                                case 6:
                                    echo '<span class="user-status badge bg-dark">Dark</span>';
                                break;
                            }
                            ?>
                			
                		</div>
                		<span class="avatar">
                			<img class="round" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40" />
                			<span class="avatar-status-online"> </span>
                		</span>
                	</a>
                	<div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                		<a class="dropdown-item" href="page-profile.html"><i class="me-50" data-feather="user"></i> Profile</a><a class="dropdown-item" href="app-email.html"><i class="me-50" data-feather="mail"></i> Inbox</a>
                		<a class="dropdown-item" href="app-todo.html"><i class="me-50" data-feather="check-square"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="me-50" data-feather="message-square"></i> Chats</a>
                		<div class="dropdown-divider"></div>
                		<a class="dropdown-item" href="page-account-settings-account.html"><i class="me-50" data-feather="settings"></i> Settings</a>
                		<a class="dropdown-item" href="page-pricing.html"><i class="me-50" data-feather="credit-card"></i> Pricing</a><a class="dropdown-item" href="page-faq.html"><i class="me-50" data-feather="help-circle"></i> FAQ</a>
                		<a class="dropdown-item" href="auth-login-cover.html"><i class="me-50" data-feather="power"></i> Logout</a>
                	</div>
                </li>


                <?php
                } else {
                    echo '<button type="button"  class="btn btn-primary waves-effect waves-float waves-light" onclick="window.location.href=\'../../login.php\'">Login</button>
                          <button type="button" class="btn btn-flat-primary waves-effect">Register</button>';
                }

                ?>
                
            </ul>
        </div>
    </nav>