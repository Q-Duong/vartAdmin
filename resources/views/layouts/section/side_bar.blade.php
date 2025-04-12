<aside>
    <div id="sidebar" class="nav-collapse">
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                @canany(['isAdmin', 'isSubAdmin'])
                    <li>
                        <a class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                            href="{{ Route('dashboard.index') }}">
                            <i class="far fa-chart-bar"></i>
                            <span>Statistical</span>
                        </a>
                    </li>
                @endcan
                @can('isAdmin')
                    <li>
                        <a class="{{ request()->routeIs('homePage.index') ? 'active' : '' }}"
                            href="{{ Route('homePage.index') }}">
                            <i class="fa-solid fa-house"></i>
                            <span>Home Page</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->routeIs('contact.edit') ? 'active' : '' }}"
                            href="{{ Route('contact.edit') }}">
                            <i class="fa-solid fa-address-card"></i>
                            <span>Contact</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->routeIs('vart.index') ? 'active' : '' }}" href="{{ Route('vart.index') }}">
                            <i class="fa-solid fa-house"></i>
                            <span>VART</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->routeIs('hart.index') ? 'active' : '' }}" href="{{ Route('hart.index') }}">
                            <i class="fa-solid fa-circle-radiation"></i>
                            <span>HART</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->routeIs('hrtta.index') ? 'active' : '' }}"
                            href="{{ Route('hrtta.index') }}">
                            <i class="fa-solid fa-house-medical"></i>
                            <span>HRTTA</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('conference_category.index') ? 'active' : '' }}"
                            href="{{ Route('conference_category.index') }}">
                            <i class="fa-solid fa-list"></i>
                            <span>Conference Category</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('conference.index') ? 'active' : '' }}"
                            href="{{ Route('conference.index') }}">
                            <i class="fa-solid fa-building-columns"></i>
                            <span>Conference</span>
                        </a>
                    </li>
                @endcan
                @canany(['isAdmin', 'isSubAdmin', 'isStaffReport'])
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('conference_report.index') || request()->routeIs('conference_report.edit') || request()->routeIs('report_management.index') ? 'active' : '' }}"
                            href="{{ route('report_management.index') }}">
                            <i class="far fa-list-alt"></i>
                            <span>@lang('conference.en.report_title')</span>
                        </a>
                    </li>
                @endcan
                @canany(['isAdmin', 'isSubAdmin', 'isStaffReport', 'isStaffInter'])
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('conference_en_report.index') || request()->routeIs('conference_en_report.edit') || request()->routeIs('report_management_en.index') ? 'active' : '' }}"
                            href="{{ Route('report_management_en.index') }}">
                            <i class="far fa-list-alt"></i>
                            <span>@lang('conference.en.en_report_title')</span>
                        </a>
                    </li>
                @endcan
                @canany(['isAdmin', 'isSubAdmin', 'isStaffRegister'])
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('conference_register.index') || request()->routeIs('conference_register.edit') || request()->routeIs('register_management.index') ? 'active' : '' }}"
                            href="{{ Route('register_management.index') }}">
                            <i class="far fa-list-alt"></i>
                            <span>@lang('conference.en.register_title')</span>
                        </a>
                    </li>
                @endcan
                @canany(['isAdmin', 'isSubAdmin', 'isStaffRegister', 'isStaffInter'])
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('conference_en_register.index') || request()->routeIs('conference_en_register.edit') || request()->routeIs('register_management_en.index') ? 'active' : '' }}"
                            href="{{ Route('register_management_en.index') }}">
                            <i class="far fa-list-alt"></i>
                            <span>@lang('conference.en.en_register_title')</span>
                        </a>
                    </li>
                @endcan
                @canany(['isAdmin', 'isSubAdmin', 'isStaffRegister', 'isStaffInter'])
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('conference_vip_register.index') || request()->routeIs('conference_vip_register.edit') || request()->routeIs('register_management_vip.index') ? 'active' : '' }}"
                            href="{{ Route('register_management_vip.index') }}">
                            <i class="far fa-list-alt"></i>
                            <span>@lang('conference.en.vip_register_title')</span>
                        </a>
                    </li>
                @endcan
                @canany(['isAdmin', 'isSubAdmin'])
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('invitation.index') || request()->routeIs('invitation.index_details') ? 'active' : '' }}"
                            href="{{ Route('invitation.index') }}">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <span>@lang('vart_define.en.invitation_history')</span>
                        </a>
                    </li>
                @endcan
                @can('isAdmin')
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('blog_category.index') ? 'active' : '' }}"
                            href="{{ Route('blog_category.index') }}">
                            <i class="fa-solid fa-circle-radiation"></i>
                            <span>Blog Categories</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('blog.index') ? 'active' : '' }}"
                            href="{{ Route('blog.index') }}">
                            <i class="fa-solid fa-circle-radiation"></i>
                            <span>Blog</span>
                        </a>
                    </li>
                @endcan
                @canany(['isAdmin', 'isStaffAlbum'])
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs(['album.index', 'album.create']) ? 'active' : '' }}"
                            href="javascript:;">
                            <i class="fa-solid fa-image"></i>
                            <span>Albums</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a class="{{ request()->routeIs('album.create') ? 'active' : '' }}"
                                    href="{{ route('album.create') }}">
                                    <i class="far fa-plus-square"></i> Create
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('album.index') ? 'active' : '' }}"
                                    href="{{ route('album.index') }}">
                                    <i class="far fa-list-alt"></i> List
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</aside>
