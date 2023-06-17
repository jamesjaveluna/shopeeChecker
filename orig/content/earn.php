 <div class="app-content content todo-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper container-xxl p-0">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content todo-sidebar">
                        <div class="todo-app-menu">
                            <div class="add-task">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#new-task-modal">
                                    Report Offer
                                </button>
                            </div>
                            <div class="sidebar-menu-list">
                                <div class="list-group list-group-filters">
                                    <a href="kiwiwall" class="list-group-item list-group-item-action <?php if($partner == "kiwiwall"){ echo 'active'; } ?>">
                                        <i data-feather="mail" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle"> Kiwiwall</span>
                                    </a>
                                    <a href="partner2" class="list-group-item list-group-item-action <?php if($partner == "partner2"){ echo 'active'; } ?>">
                                        <i data-feather="star" class="font-medium-3 mr-50"></i> <span class="align-middle">Partner 2</span>
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper container-xxl p-0">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="body-content-overlay"></div>
                        <div class="todo-app-list">
                            <!-- Todo search starts -->
                            <div class="app-fixed-search d-flex align-items-center">
                                <div class="sidebar-toggle d-block d-lg-none ml-1">
                                    <i data-feather="menu" class="font-medium-5"></i>
                                </div>
                                <div class="d-flex align-content-center justify-content-between w-100">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="todo-search" placeholder="Search task" aria-label="Search..." aria-describedby="todo-search" />
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle hide-arrow mr-1" id="todoActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical" class="font-medium-2 text-body"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="todoActions">
                                        <a class="dropdown-item sort-asc" href="javascript:void(0)">Sort A - Z</a>
                                        <a class="dropdown-item sort-desc" href="javascript:void(0)">Sort Z - A</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Sort Assignee</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Sort Due Date</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Sort Today</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Sort 1 Week</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Sort 1 Month</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Todo search ends -->

                            <!-- Todo List starts -->
                            <div class="todo-task-list-wrapper list-group">
                            <?php

                            switch($partner){
                                case 'kiwiwall':
                                echo '<iframe width="100%"  height="100%" src="https://www.kiwiwall.com/wall/pDlOgu35fzpDnLTDhMPXYbBEnaFywtT8/'. $_SESSION['user_id'].'" frameborder="0" allowfullscreen></iframe>';
                                break;

                                default:
                                break;
                            }

                            ?>
                                <div class="no-results">
                                    <h5>No Items Found</h5>
                                </div>
                            </div>
                            <!-- Todo List ends -->
                        </div>

                        <!-- Right Sidebar starts -->
                        <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
                            <div class="modal-dialog sidebar-lg">
                                <div class="modal-content p-0">
                                    <form id="form-modal-todo" class="todo-modal needs-validation" novalidate onsubmit="return false">
                                        <div class="modal-header align-items-center mb-1">
                                            <h5 class="modal-title">Add Task</h5>
                                            <div class="todo-item-action d-flex align-items-center justify-content-between ml-auto">
                                                <span class="todo-item-favorite cursor-pointer mr-75"><i data-feather="star" class="font-medium-2"></i></span>
                                                <button type="button" class="close font-large-1 font-weight-normal py-0" data-dismiss="modal" aria-label="Close">
                                                    ×
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                            <div class="action-tags">
                                                <div class="form-group">
                                                    <label for="todoTitleAdd" class="form-label">Title</label>
                                                    <input type="text" id="todoTitleAdd" name="todoTitleAdd" class="new-todo-item-title form-control" placeholder="Title" />
                                                </div>
                                                <div class="form-group position-relative">
                                                    <label for="task-assigned" class="form-label d-block">Assignee</label>
                                                    <select class="select2 form-control" id="task-assigned" name="task-assigned">
                                                        <option data-img="../../../app-assets/images/portrait/small/avatar-s-3.jpg" value="Phill Buffer" selected>
                                                            Phill Buffer
                                                        </option>
                                                        <option data-img="../../../app-assets/images/portrait/small/avatar-s-1.jpg" value="Chandler Bing">
                                                            Chandler Bing
                                                        </option>
                                                        <option data-img="../../../app-assets/images/portrait/small/avatar-s-4.jpg" value="Ross Geller">
                                                            Ross Geller
                                                        </option>
                                                        <option data-img="../../../app-assets/images/portrait/small/avatar-s-6.jpg" value="Monica Geller">
                                                            Monica Geller
                                                        </option>
                                                        <option data-img="../../../app-assets/images/portrait/small/avatar-s-2.jpg" value="Joey Tribbiani">
                                                            Joey Tribbiani
                                                        </option>
                                                        <option data-img="../../../app-assets/images/portrait/small/avatar-s-11.jpg" value="Rachel Green">
                                                            Rachel Green
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="task-due-date" class="form-label">Due Date</label>
                                                    <input type="text" class="form-control task-due-date" id="task-due-date" name="task-due-date" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="task-tag" class="form-label d-block">Tag</label>
                                                    <select class="form-control task-tag" id="task-tag" name="task-tag" multiple="multiple">
                                                        <option value="Team">Team</option>
                                                        <option value="Low">Low</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="High">High</option>
                                                        <option value="Update">Update</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Description</label>
                                                    <div id="task-desc" class="border-bottom-0" data-placeholder="Write Your Description"></div>
                                                    <div class="d-flex justify-content-end desc-toolbar border-top-0">
                                                        <span class="ql-formats mr-0">
                                                            <button class="ql-bold"></button>
                                                            <button class="ql-italic"></button>
                                                            <button class="ql-underline"></button>
                                                            <button class="ql-align"></button>
                                                            <button class="ql-link"></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group my-1">
                                                <button type="submit" class="btn btn-primary d-none add-todo-item mr-1">Add</button>
                                                <button type="button" class="btn btn-outline-secondary add-todo-item d-none" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="button" class="btn btn-primary d-none update-btn update-todo-item mr-1">Update</button>
                                                <button type="button" class="btn btn-outline-danger update-btn d-none" data-dismiss="modal">Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Right Sidebar ends -->

                    </div>
                </div>
            </div>
        </div>
    </div>