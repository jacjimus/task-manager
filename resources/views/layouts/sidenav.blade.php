<nav >
                    <ul class="nav nav-pills nav-stacked">
                        <li class="{{ (Request::is('dashboard') ? 'open active' : '') }}">
                            <a href="{{url('/dashboard')}}" title="Dashboards">
                                <i class="fa fa-lg fa-fw fa-home"></i> Dashboards
                            </a>
                            
                        </li>
                        <li class="nav-dropdown {{ (Request::is('employees') ? 'active open' : '') }}">
                            <a href="#" title="Users">
                                <i class="fa fa-lg fa-fw fa-user"></i> Access Control Manager
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="{{url('/departments')}}" title="Departments">
                                        <i class="fa fa-fw fa-caret-right"></i>Manage Departments 
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('/roles')}}" title="Roles">
                                        <i class="fa fa-fw fa-caret-right"></i>Manage Roles 
                                    </a>
                                </li>
                                <li class="{{ (Request::is('employees') ? 'active open' : '') }}">
                                    <a href="{{url('/employees')}}" title="Profile">
                                        <i class="fa fa-fw fa-caret-right"></i> Manage Employees
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-dropdown {{ (Request::is('tasks') || (Request::is('task-categories')) ? 'active open' : '') }}">
                            <a href="#" title="Users">
                                <i class="fa fa-lg fa-fw fa-tasks"></i> Tasks Manager
                                                            </a>
                            <ul class="nav-sub">
                                <li class="{{ (Request::is('task') ? 'active open' : '') }}">
                                    <a href="{{url('/tasks')}}" title="Create task">
                                        <i class="fa fa-fw fa-caret-right"></i> All Tasks
                                    </a>
                                </li>
                                <li class="{{ (Request::is('task-categories') ? 'active open' : '') }}">
                                    <a href="{{url('/task-categories')}}" title="Task categories">
                                        <i class="fa fa-fw fa-caret-right"></i>Task categories
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                       
                        
                        <li class="nav-dropdown {{ (Request::is('daily-reports') || (Request::is('weekly-reports')) ? 'active open' : '') }}" >
                            <a href="#" title="Task reports">
                                <i class="fa fa-lg fa-fw fa-suitcase"></i> Tasks Reports
                            </a>
                            <ul class="nav-sub">
                                <li class="{{ (Request::is('daily-reports') ? 'active open' : '') }}">
                                    <a href="{{url('/daily-reports')}}" title="Daily task reports">
                                        <i class="fa fa-fw fa-caret-right"></i> Daily reports
                                    </a>
                                </li>
                                <li class="{{ (Request::is('weekly-reports') ? 'active open' : '') }}">
                                    <a href="{{url('/weekly-reports')}}" title="Weekly task reports">
                                        <i class="fa fa-fw fa-caret-right"></i> Weekly Reports
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                    </ul>
                    
                </nav>
