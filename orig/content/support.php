<div class="app-content content chat-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper container-xxl p-0">
            <div class="sidebar-left">
                <div class="sidebar">
                    <!-- Admin user profile area -->
                    <div class="chat-profile-sidebar">
                        <header class="chat-profile-header">
                            <span class="close-icon">
                                <i data-feather="x"></i>
                            </span>
                            <!-- User Information -->
                            <div class="header-profile-sidebar">
                                <div class="avatar box-shadow-1 avatar-xl avatar-border">
                                    <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="user_avatar" />
                                    <span class="avatar-status-online avatar-status-xl"></span>
                                </div>
                                <h4 class="chat-user-name">John Doe</h4>
                                <span class="user-post">Admin</span>
                            </div>
                            <!--/ User Information -->
                        </header>
                        <!-- User Details start -->
                        <div class="profile-sidebar-area">
                            <h6 class="section-label mb-1">About</h6>
                            <div class="about-user">
                                <textarea data-length="120" class="form-control char-textarea" id="textarea-counter" rows="5" placeholder="About User">
Dessert chocolate cake lemon drops jujubes. Biscuit cupcake ice cream bear claw brownie brownie marshmallow.</textarea>
                                <small class="counter-value float-right"><span class="char-count">108</span> / 120 </small>
                            </div>
                            <!-- To set user status -->
                            <h6 class="section-label mb-1 mt-3">Status</h6>
                            <ul class="list-unstyled user-status">
                                <li class="pb-1">
                                    <div class="custom-control custom-control-success custom-radio">
                                        <input type="radio" id="activeStatusRadio" name="userStatus" class="custom-control-input" value="online" checked />
                                        <label class="custom-control-label ml-25" for="activeStatusRadio">Active</label>
                                    </div>
                                </li>
                                <li class="pb-1">
                                    <div class="custom-control custom-control-danger custom-radio">
                                        <input type="radio" id="dndStatusRadio" name="userStatus" class="custom-control-input" value="busy" />
                                        <label class="custom-control-label ml-25" for="dndStatusRadio">Do Not Disturb</label>
                                    </div>
                                </li>
                                <li class="pb-1">
                                    <div class="custom-control custom-control-warning custom-radio">
                                        <input type="radio" id="awayStatusRadio" name="userStatus" class="custom-control-input" value="away" />
                                        <label class="custom-control-label ml-25" for="awayStatusRadio">Away</label>
                                    </div>
                                </li>
                                <li class="pb-1">
                                    <div class="custom-control custom-control-secondary custom-radio">
                                        <input type="radio" id="offlineStatusRadio" name="userStatus" class="custom-control-input" value="offline" />
                                        <label class="custom-control-label ml-25" for="offlineStatusRadio">Offline</label>
                                    </div>
                                </li>
                            </ul>
                            <!--/ To set user status -->

                            <!-- User settings -->
                            <h6 class="section-label mb-1 mt-2">Settings</h6>
                            <ul class="list-unstyled">
                                <li class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="check-square" class="mr-75 font-medium-3"></i>
                                        <span class="align-middle">Two-step Verification</span>
                                    </div>
                                    <div class="custom-control custom-switch mr-0">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1" checked />
                                        <label class="custom-control-label" for="customSwitch1"></label>
                                    </div>
                                </li>
                                <li class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="bell" class="mr-75 font-medium-3"></i>
                                        <span class="align-middle">Notification</span>
                                    </div>
                                    <div class="custom-control custom-switch mr-0">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch2" />
                                        <label class="custom-control-label" for="customSwitch2"></label>
                                    </div>
                                </li>
                                <li class="mb-1 d-flex align-items-center cursor-pointer">
                                    <i data-feather="user" class="mr-75 font-medium-3"></i>
                                    <span class="align-middle">Invite Friends</span>
                                </li>
                                <li class="d-flex align-items-center cursor-pointer">
                                    <i data-feather="trash" class="mr-75 font-medium-3"></i>
                                    <span class="align-middle">Delete Account</span>
                                </li>
                            </ul>
                            <!--/ User settings -->

                            <!-- Logout Button -->
                            <div class="mt-3">
                                <button class="btn btn-primary">
                                    <span>Logout</span>
                                </button>
                            </div>
                            <!--/ Logout Button -->
                        </div>
                        <!-- User Details end -->
                    </div>
                    <!--/ Admin user profile area -->

                    <!-- Chat Sidebar area -->
                    <div class="sidebar-content">
                        <span class="sidebar-close-icon">
                            <i data-feather="x"></i>
                        </span>
                        <!-- Sidebar header start -->
                        <div class="chat-fixed-search">
                            <div class="d-flex align-items-center w-100">
                                            <button type="button" class="btn btn-primary btn-block waves-effect waves-float waves-light" data-toggle="modal" data-target="#inlineForm">
                                                <i data-feather='plus'></i>
                                                <span>Create new ticket</span>
                                            </button>
                            </div>
                        </div>
                        <!-- Sidebar header end -->

                        <!-- Sidebar Users start -->
                        <div id="users-list" class="chat-user-list-wrapper list-group">
                            <h4 class="chat-list-title">Tickets</h4>
                            <ul class="chat-users-list chat-list media-list">
                            <?php 


                            foreach($tickets->ticket as $ticket){
                                $chat_title = strlen($ticket->title) > 20 ? substr($ticket->title,0,20)."..." : $ticket->title;
                                echo '<li class="test" data-id="'.$ticket->id.'" data-status="'.$ticket->status.'"">
                                    <div class="chat-info flex-grow-1">
                                        <h5 class="mb-0">[#'.$ticket->id.'] '.$chat_title.' <small><span class="badge badge-danger badge-pill">3</span></small></h5>
                                        <p class="card-text text-truncate">
                                            Topic
                                        </p>
                                    </div>
                                    <div class="chat-meta text-nowrap">';

                                    switch($ticket->status){
                                        case 0: //In Progress
                                            echo '<small class="float-right mb-25"><span class="badge badge-info">In-progress</span></small>';
                                            break;

                                        case 1: //Waiting for reply
                                             echo '<small class="float-right mb-25"><span class="badge badge-warning">Waiting for reply</span></small>';
                                            break;

                                        case 2: //Solved
                                            echo '<small class="float-right mb-25"><span class="badge badge-success">Solved</span></small>';
                                            break;

                                        case 3: //Lock
                                            echo '<small class="float-right mb-25"><span class="badge badge-danger">Solved</span></small>';
                                            break;
                                    }
                                        
                                     echo '
                                    </div>
                                </li>';
                            }

                            ?>
                                
                                <li class="no-results">
                                    <h6 class="mb-0">No Chats Found</h6>
                                </li>
                            </ul>
                        </div>
                        <!-- Sidebar Users end -->
                    </div>
                    <!--/ Chat Sidebar area -->

                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper container-xxl p-0">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="body-content-overlay"></div>
                        <!-- Main chat area -->
                        <section class="chat-app-window">
                            <!-- To load Conversation -->
                            <div class="start-chat-area">
                                <div class="mb-1 start-chat-icon">
                                    <i data-feather="message-square"></i>
                                </div>
                                <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
                            </div>
                            <!--/ To load Conversation -->

                            <!-- Active Chat -->
                            <div class="active-chat">
                                <!-- Chat Header -->
                                <div class="chat-navbar">
                                    <header class="chat-header">

                                        <?php
                                        if($_SESSION['user_type'] == 5 || $_SESSION['user_type'] == 6){
                                            echo '<div class="d-flex align-items-center">
                                                <div class="sidebar-toggle d-block d-lg-none mr-1">
                                                    <i data-feather="menu" class="font-medium-5"></i>
                                                </div>
                                                <div class="avatar avatar-border user-profile-toggle m-0 mr-1">
                                                    <img class="support-avatar" src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="36" width="36" />
                                                    <span class="avatar-status-busy"></span>
                                                </div>
                                                <h6 class="support-title mb-0 user-profile-toggle">{username} | {title}</h6>
                                            </div>'; 

                                            echo ' <div class="d-flex align-items-center">
                                                    <div class="dropdown">
                                                        <button class="btn-icon btn btn-transparent hide-arrow btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i data-feather="more-vertical" id="chat-header-actions" class="font-medium-2"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="chat-header-actions">
                                                            <a class="dropdown-item" href="javascript:void(0);"><i data-feather=\'check\'></i> <span>Solved</span></a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i data-feather=\'lock\'></i> <span>Lock</span></a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i data-feather=\'delete\'></i> <span>Report</span></a>
                                                        </div>
                                                    </div>
                                                </div>';
                                        } else {
                                             echo '<div class="d-flex align-items-center">
                                                <div class="sidebar-toggle d-block d-lg-none mr-1">
                                                    <i data-feather="menu" class="font-medium-5"></i>
                                                </div>
                                                <h6 class="support-title mb-0">{title}</h6>
                                            </div>'; 

                                            echo ' <div class="support-status d-flex align-items-center">
                                                    <span class="badge badge-warning">Waiting for reply</span>
                                                </div>';
                                        }
                                        ?>

                                    </header>
                                </div>
                                <!--/ Chat Header -->

                                <!-- User Chat messages -->
                                <div class="user-chats">
                                    <div id="chats" class="chats">
                                        
                                    </div>
                                </div>
                                <!-- User Chat messages -->

                                <!-- Submit Chat form -->
                                <form class="chat-app-form" action="javascript:void(0);" onsubmit="enterChat();">
                                    <div class="input-group input-group-merge mr-1 form-send-message">
                                        <div class="input-group-prepend">
                                            <span class="speech-to-text input-group-text"><i data-feather="mic" class="cursor-pointer"></i></span>
                                        </div>
                                        <input id="chat_box" type="text" class="form-control message" placeholder="You are unable to chat" disabled/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <label for="attach-doc" class="attachment-icon mb-0">
                                                    <i data-feather="image" class="cursor-pointer lighten-2 text-secondary"></i>
                                                    <input type="file" id="attach-doc" hidden /> </label></span>
                                        </div>
                                    </div>
                                    <input type="hidden" class="ticket_id" value = "0" />
                                    <input type="hidden" class="status" value = "0" />
                                    <button id="chat_button" type="button" class="btn btn-primary send" onclick="enterChat();" disabled>
                                        <i data-feather="send" class="d-lg-none"></i>
                                        <span class="d-none d-lg-block">Send</span>
                                    </button>
                                </form>
                                <!--/ Submit Chat form -->
                            </div>
                            <!--/ Active Chat -->
                        </section>
                        <!--/ Main chat area -->

                        <?php 
                        //<!-- User Chat profile right area -->
                         if($_SESSION['user_type'] == 5 || $_SESSION['user_type'] == 6){
                            echo '<div class="user-profile-sidebar">
                            <header class="user-profile-header">
                                <span class="close-icon">
                                    <i data-feather="x"></i>
                                </span>
                                <!-- User Profile image with name -->
                                <div class="header-profile-sidebar">
                                    <div class="avatar box-shadow-1 avatar-border avatar-xl">
                                        <img class="support-user-avatar" src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="user_avatar" height="70" width="70" />
                                        <span class="avatar-status-busy avatar-status-lg"></span>
                                    </div>
                                    <h4 class="support-user-name">{name}</h4>
                                    <span class="support-user-type">{type}</span>
                                </div>
                                <!--/ User Profile image with name -->
                            </header>
                            <div class=" user-profile-sidebar-area">
                                <!-- About User -->
                                <h6 class="section-label mb-1">About</h6>
                                <p class="support-user-about">{about}</p>
                                <!-- About User -->
                                <!-- User\'s personal information -->
                                <div class="personal-info">
                                    <h6 class="section-label mb-1 mt-3">Personal Information</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-1">
                                            <i data-feather="mail" class="font-medium-2 mr-50"></i>
                                            <span class="support-user-email align-middle">{email}</span>
                                        </li>
                                        <li class="mb-1">
                                            <i data-feather="phone-call" class="font-medium-2 mr-50"></i>
                                            <span class="support-user-phone align-middle">{phone}</span>
                                        </li>
                                        <li>
                                            <i class="font-medium-2 mr-50">'.stripslashes($_config['general']['currency_symbol']).'</i>
                                            <span class="support-user-points align-middle"> {points}</span>
                                        </li>
                                    </ul>
                                </div>
                                <!--/ User\'s personal information -->

                                <!-- User\'s Links -->
                                <div class="more-options">
                                    <h6 class="section-label mb-1 mt-3">Options</h6>
                                    <ul class="list-unstyled">
                                        <li class="cursor-pointer mb-1">
                                            <i data-feather="tag" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Edit User</span>
                                        </li>
                                        <li class="cursor-pointer mb-1">
                                            <i data-feather="star" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Important Contact</span>
                                        </li>
                                        <li class="cursor-pointer mb-1">
                                            <i data-feather="image" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Shared Media</span>
                                        </li>
                                        <li class="cursor-pointer mb-1">
                                            <i data-feather="trash" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Delete Contact</span>
                                        </li>
                                        <li class="cursor-pointer">
                                            <i data-feather="slash" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Block Contact</span>
                                        </li>
                                    </ul>
                                </div>
                                <!--/ User\'s Links -->
                            </div>
                        </div>';
                         }
                        
                        //<!--/ User Chat profile right area -->
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>