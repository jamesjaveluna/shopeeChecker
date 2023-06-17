<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section id="basic-datatable">
                    <div class="row">
                      <div class="col-lg-3 col-md-6 col-12">
                            <div class="card">
                                <div class="card-body text-center">
                                        <div class="profile-image">
                                            <div class="avatar avatar-xl">
                                                <img src="../../../app-assets/images/portrait/small/<?php echo $avatar; ?>" alt="Profile Picture">
                                            </div>
                                        </div>
                                    <div class="card-body">
                                        <h3><?php echo $fullname; ?></h3>
                                        <h6 class="text-muted">User ID: <span class="text-primary"><?php echo $userID; ?></span></h6>
                                        <div onclick="window.location.href='../profile/<?php echo $userID; ?>';" class="badge badge-light-primary profile-badge mt-2 btn-profile">View Profile</div>
                                    </div>
                                </div>

                                <div class="list-group">
                                            <button type="button" class="list-group-item list-group-item-action btn-transaction <?php if($view == 'transaction') echo 'active'; ?>">
                                                <i data-feather="activity" class="mr-25"></i>
                                                <span>Transaction</span>
                                            </button>
                                            <button type="button" class="list-group-item list-group-item-action btn-withdrawal <?php if($view == 'withdrawal') echo 'active'; ?>">
                                                <i data-feather="shopping-cart" class="mr-25"></i>
                                                <span>Withdrawal</span>
                                            </button>
                                            <button type="button" class="list-group-item list-group-item-action btn-offer <?php if($view == 'offer') echo 'active'; ?>">
                                                <i data-feather="trending-up" class="mr-25"></i>
                                                <span>Offer</span>
                                            </button>
                                            <button type="button" class="list-group-item list-group-item-action disabled btn-referral <?php if($view == 'referral') echo 'active'; ?>">
                                                <i data-feather="users" class="mr-25"></i>
                                                <span>Referrals</span>
                                            </button>
                                </div>

                            </div>
                      </div>

                       <div class="col-md-9 col-sm-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <table class="datatables-basic table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Name</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </div>
                       </div>
                    </div>


                </section>

               

            </div>
        </div>
    </div>