 <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Account Settings</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../../index.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="../../profile/<?php echo $_SESSION['user_id']; ?>">Profile</a>
                                    </li>
                                    <li class="breadcrumb-item active"> Account Settings
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- account setting page -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column nav-left">
                                <!-- general -->
                                <li class="nav-item">
                                    <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i data-feather="user" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">General</span>
                                    </a>
                                </li>
                                <!-- change password -->
                                <li class="nav-item">
                                    <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                        <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">Change Password</span>
                                    </a>
                                </li>
                                <!-- information -->
                                <li class="nav-item">
                                    <a class="nav-link" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                        <i data-feather="info" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">Information</span>
                                    </a>
                                </li>
                                <!-- social -->
                                <li class="nav-item">
                                    <a class="nav-link" id="account-pill-social" data-toggle="pill" href="#account-vertical-social" aria-expanded="false">
                                        <i data-feather="link" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">Social</span>
                                    </a>
                                </li>
                                <!-- notification -->
                                <li class="nav-item">
                                    <a class="nav-link" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                                        <i data-feather="bell" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">Notifications</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--/ left menu section -->

                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- general tab -->
                                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                            <!-- header media -->
                                            <div class="media">
                                                <a href="javascript:void(0);" class="mr-25">
                                                    <img src="../../../app-assets/images/portrait/small/<?php echo $details->avatar; ?>" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                                                </a>
                                                <!-- upload and reset button -->
                                                <div class="media-body mt-75 ml-1">
                                                    <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                    <input type="file" id="account-upload" hidden accept="image/*" />
                                                    <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                                    <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                                </div>
                                                <!--/ upload and reset button -->
                                            </div>
                                            <!--/ header media -->
                                                            
                                            <!-- form -->
                                            <form id="general" class="validate-form mt-2">
                                                <input type="hidden" name="tab" value="general" />
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-username">Full Name</label>
                                                            <input type="text" class="form-control" id="account-fullname" name="fullname" placeholder="Username" value="<?php echo $details->fullname; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-name">Email</label>
                                                            <input type="email" class="form-control" id="account-email" name="email" placeholder="Name" value="<?php echo $details->email; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                         <div class="form-group">
                                                             <label for="basicSelect">Gender</label>
                                                             <select class="form-control" name="gender" id="account-gender">
                                                                 <option value="0" <?php if($details->gender == 0) echo 'selected'; ?>>Undefined</option>
                                                                 <option value="1" <?php if($details->gender == 1) echo 'selected'; ?>>Male</option>
                                                                 <option value="2" <?php if($details->gender == 2) echo 'selected'; ?>>Female</option>
                                                             </select>
                                                         </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                       <div class="form-group">
                                                            <label for="account-birthdate">Birthdate</label>
                                                            <input type="text" id="account-birthdate" name="birthdate" class="form-control flatpickr-human-friendly" placeholder="October 14, 2020" value="<?php echo $details->birthdate; ?>" />
                                                         </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ general tab -->

                                        <!-- change password -->
                                        <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                            <!-- form -->
                                            <form id="changepass" class="validate-form">
                                                <input type="hidden" name="tab" value="changepass" />
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-old-password">Old Password</label>
                                                            <div class="input-group form-password-toggle input-group-merge">
                                                                <input type="password" class="form-control" id="account-old-password" name="password" placeholder="Old Password" required/>
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text cursor-pointer">
                                                                        <i data-feather="eye"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-new-password">New Password</label>
                                                            <input type="password" id="account-new-password" name="new_password" class="form-control" placeholder="New Password" required/>
                                                                
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-retype-new-password">Retype New Password</label>
                                                            <input type="password" class="form-control" id="account-retype-new-password" name="confirm_new_password" placeholder="New Password" required/>
                                                            <div class="invalid-feedback">Password didn't match.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mr-1 mt-1">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ change password -->

                                        <!-- information -->
                                        <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                            <!-- form -->
                                            <form id="info" class="validate-form">
                                                <input type="hidden" name="tab" value="info" />
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="accountTextarea">Bio</label>
                                                            <textarea class="form-control" id="accountTextarea" rows="4" placeholder="Your Bio data here..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-birth-date">Birth date</label>
                                                            <input type="text" class="form-control flatpickr" placeholder="Birth date" id="account-birth-date" name="dob" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="accountSelect">Country</label>
                                                            <select class="form-control" id="accountSelect">
                                                                <option>USA</option>
                                                                <option>India</option>
                                                                <option>Canada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-website">Website</label>
                                                            <input type="text" class="form-control" name="website" id="account-website" placeholder="Website address" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-phone">Phone</label>
                                                            <input type="text" class="form-control" id="account-phone" placeholder="Phone number" value="(+656) 254 2568" name="phone" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mt-1 mr-1">Save changes</button>
                                                        <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ information -->

                                        <!-- social -->
                                        <div class="tab-pane fade" id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                                            <!-- form -->
                                            <form id="social" class="validate-form">
                                                <input type="hidden" name="tab" value="social" />
                                                <div class="row">
                                                    <!-- social header -->
                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i data-feather="link" class="font-medium-3"></i>
                                                            <h4 class="mb-0 ml-75">Social Links</h4>
                                                        </div>
                                                    </div>
                                                    <!-- twitter link input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-twitter">Twitter</label>
                                                            <input type="text" id="account-twitter" class="form-control" placeholder="Add link" value="https://www.twitter.com" />
                                                        </div>
                                                    </div>
                                                    <!-- facebook link input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-facebook">Facebook</label>
                                                            <input type="text" id="account-facebook" class="form-control" placeholder="Add link" />
                                                        </div>
                                                    </div>
                                                    <!-- google plus input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-google">Google+</label>
                                                            <input type="text" id="account-google" class="form-control" placeholder="Add link" />
                                                        </div>
                                                    </div>
                                                    <!-- linkedin link input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-linkedin">LinkedIn</label>
                                                            <input type="text" id="account-linkedin" class="form-control" placeholder="Add link" value="https://www.linkedin.com" />
                                                        </div>
                                                    </div>
                                                    <!-- instagram link input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-instagram">Instagram</label>
                                                            <input type="text" id="account-instagram" class="form-control" placeholder="Add link" />
                                                        </div>
                                                    </div>
                                                    <!-- Quora link input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-quora">Quora</label>
                                                            <input type="text" id="account-quora" class="form-control" placeholder="Add link" />
                                                        </div>
                                                    </div>

                                                    <!-- divider -->
                                                    <div class="col-12">
                                                        <hr class="my-2" />
                                                    </div>

                                                    <div class="col-12 mt-1">
                                                        <!-- profile connection header -->
                                                        <div class="d-flex align-items-center mb-3">
                                                            <i data-feather="user" class="font-medium-3"></i>
                                                            <h4 class="mb-0 ml-75">Profile Connections</h4>
                                                        </div>

                                                        <div class="row">
                                                            <!-- twitter user -->
                                                            <div class="col-6 col-md-3 text-center mb-1">
                                                                <p class="font-weight-bold">Your Twitter</p>
                                                                <div class="avatar mb-1">
                                                                    <span class="avatar-content">
                                                                        <img src="../../../app-assets/images/avatars/11-small.png" alt="avatar img" width="40" height="40" />
                                                                    </span>
                                                                </div>
                                                                <p class="mb-0">@johndoe</p>
                                                                <a href="javascript:void(0)">Disconnect</a>
                                                            </div>
                                                            <!-- facebook button -->
                                                            <div class="col-6 col-md-3 text-center mb-1">
                                                                <p class="font-weight-bold mb-2">Your Facebook</p>
                                                                <button class="btn btn-outline-primary">Connect</button>
                                                            </div>
                                                            <!-- google user -->
                                                            <div class="col-6 col-md-3 text-center mb-1">
                                                                <p class="font-weight-bold">Your Google</p>
                                                                <div class="avatar mb-1">
                                                                    <span class="avatar-content">
                                                                        <img src="../../../app-assets/images/avatars/3-small.png" alt="avatar img" width="40" height="40" />
                                                                    </span>
                                                                </div>
                                                                <p class="mb-0">@luraweber</p>
                                                                <a href="javascript:void(0)">Disconnect</a>
                                                            </div>
                                                            <!-- github button -->
                                                            <div class="col-6 col-md-3 text-center mb-2">
                                                                <p class="font-weight-bold mb-1">Your GitHub</p>
                                                                <button class="btn btn-outline-primary">Connect</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <!-- submit and cancel button -->
                                                        <button type="submit" class="btn btn-primary mr-1 mt-1">Save changes</button>
                                                        <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ social -->

                                        <!-- notifications -->
                                        <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                            <div class="row">
                                                <h6 class="section-label mx-1 mb-2">Activity</h6>
                                                <div class="col-12 mb-2">
                                                    <div class="custom-control custom-switch">

                                                        <input type="checkbox" class="custom-control-input" <?php if($details->notification_offer == 1) echo 'checked'; ?> id="accountSwitch1" />
                                                        <label class="custom-control-label" for="accountSwitch1">
                                                            Email me when I completed an offer
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" <?php if($details->notification_withdrawal == 1) echo 'checked'; ?> id="accountSwitch2" />
                                                        <label class="custom-control-label" for="accountSwitch2">
                                                            Email me about my withdrawal status
                                                        </label>
                                                    </div>
                                                </div>
                                                <h6 class="section-label mx-1 mt-2">Application</h6>
                                                <div class="col-12 mt-1 mb-2">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" <?php if($details->notification_news == 1) echo 'checked'; ?> id="accountSwitch4" />
                                                        <label class="custom-control-label" for="accountSwitch4">News and announcements</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" <?php if($details->notification_shop == 1) echo 'checked'; ?> id="accountSwitch6" />
                                                        <label class="custom-control-label" for="accountSwitch6">Shop Updates</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                                    <button type="reset" class="btn btn-outline-secondary mt-2">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ notifications -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ right content section -->
                    </div>
                </section>
                <!-- / account setting page -->

            </div>
        </div>
    </div>