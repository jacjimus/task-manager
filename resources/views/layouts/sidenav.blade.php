<nav >
                    <h5 class="sidebar-header">Navigation</h5>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="nav-dropdown {{{ (Request::is('dashboard') ? 'class=active' : '') }}}">
                            <a href="#" title="Dashboards">
                                <i class="fa fa-lg fa-fw fa-home"></i> Dashboards
                            </a>
                            <ul class="nav-sub">
                                <li class="{{{ (Request::is('dashboard') ? 'class=active open' : '') }}}">
                                    <a href="{{url('/dashboard')}}" title="Dashboard">
                                        <i class="fa fa-fw fa-caret-right"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="analytics-overview.html" title="Analytics Overview">
                                        <i class="fa fa-fw fa-caret-right"></i> Analytics Overview
                                        <span class="label label-danger pull-right">New</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-dropdown {{{ (Request::is('employees') ? 'class=active open' : '') }}}">
                            <a href="#" title="Users">
                                <i class="fa fa-lg fa-fw fa-user"></i> Access Control Manager
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="pages-members.html" title="Members">
                                        <i class="fa fa-fw fa-caret-right"></i>Manage Departments 
                                    </a>
                                </li>
                                <li class="{{{ (Request::is('employees') ? 'class=active open' : '') }}}">
                                    <a href="{{url('/employees')}}" title="Profile">
                                        <i class="fa fa-fw fa-caret-right"></i> Manage Employees
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-dropdown">
                            <a href="#" title="Users">
                                <i class="fa fa-lg fa-fw fa-tasks"></i> Tasks Manager
                                <span class="label label-danger pull-right">New</span>
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="email-inbox.html" title="Create task">
                                        <i class="fa fa-fw fa-file"></i> Create Task
                                    </a>
                                </li>
                                <li>
                                    <a href="email-message.html" title="Message">
                                        <i class="fa fa-fw fa-caret-right"></i> Message
                                    </a>
                                </li>
                                <li>
                                    <a href="email-compose.html" title="Compose">
                                        <i class="fa fa-fw fa-caret-right"></i> Compose
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-dropdown">
                            <a href="#" title="UI Elements">
                                <i class="fa fa-lg fa-fw fa-suitcase"></i> Tasks Reports
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="ui-typography.html" title="Typography">
                                        <i class="fa fa-fw fa-caret-right"></i> Typography
                                    </a>
                                </li>
                                <li>
                                    <a href="ui-buttons.html" title="Buttons">
                                        <i class="fa fa-fw fa-caret-right"></i> Buttons
                                    </a>
                                </li>
                                <li>
                                    <a href="ui-panels.html" title="Panels">
                                        <i class="fa fa-fw fa-caret-right"></i> Panels
                                    </a>
                                </li>
                                <li>
                                    <a href="ui-tabs-accordions.html" title="Tabs & Accordions">
                                        <i class="fa fa-fw fa-caret-right"></i> Tabs & Accordions
                                    </a>
                                </li>
                                <li>
                                    <a href="ui-tooltips-popovers.html" title="Tooltips & Popovers">
                                        <i class="fa fa-fw fa-caret-right"></i> Tooltips & Popovers
                                    </a>
                                </li>
                                <li>
                                    <a href="ui-alerts.html" title="Alerts">
                                        <i class="fa fa-fw fa-caret-right"></i> Alerts
                                    </a>
                                </li>
                                <li>
                                    <a href="ui-components.html" title="Components">
                                        <i class="fa fa-fw fa-caret-right"></i> Components
                                    </a>
                                </li>
                                <li>
                                    <a href="ui-icons.html" title="Icons">
                                        <i class="fa fa-fw fa-caret-right"></i> Icons
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                    
                </nav>
