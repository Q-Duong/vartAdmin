<aside>
    <div id="sidebar" class="nav-collapse">
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                        href="{{ Route('dashboard.index') }}">
                        <i class="far fa-chart-bar"></i>
                        <span>Statistical</span>
                    </a>
                </li>
                @can('isAdmin')
                    <li>
                        <a class="{{ request()->routeIs('homePage.index') ? 'active' : '' }}" href="{{ Route('homePage.index') }}">
                            <i class="fa-solid fa-house"></i>
                            <span>Home Page</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->routeIs('contact.edit') ? 'active' : '' }}" href="{{ Route('contact.edit') }}">
                            <i class="fa-solid fa-address-card"></i>
                            <span>Contact</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('vart.index') || request()->routeIs('vart.create') || request()->routeIs('vart.edit') ? 'active' : '' }}"
                            href="javascript:;">
                            <i class="fa-solid fa-building-ngo"></i>
                            <span>VART</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a class="{{ request()->routeIs('vart.create') ? 'active' : '' }}"
                                    href="{{ Route('vart.create') }}">
                                    <i class="far fa-plus-square"></i> Create
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('vart.index') ? 'active' : '' }}"
                                    href="{{ Route('vart.index') }}">
                                    <i class="far fa-list-alt"></i> List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('hart.index') || request()->routeIs('hart.create') || request()->routeIs('hart.edit') ? 'active' : '' }}"
                            href="javascript:;">
                            <i class="fa-solid fa-building-ngo"></i>
                            <span>HART</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a class="{{ request()->routeIs('hart.create') ? 'active' : '' }}"
                                    href="{{ Route('hart.create') }}">
                                    <i class="far fa-plus-square"></i> Create
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('hart.index') ? 'active' : '' }}" href="{{ Route('hart.index') }}">
                                    <i class="far fa-list-alt"></i> List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('conference_category.index') || request()->routeIs('conference_category.create') || request()->routeIs('conference_category.edit') ? 'active' : '' }}"
                            href="javascript:;">
                            <i class="fa-solid fa-list"></i>
                            <span>Conference Category</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a class="{{ request()->routeIs('conference_category.create') ? 'active' : '' }}"
                                    href="{{ Route('conference_category.create') }}">
                                    <i class="far fa-plus-square"></i> Create
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('conference_category.index') ? 'active' : '' }}"
                                    href="{{ Route('conference_category.index') }}">
                                    <i class="far fa-list-alt"></i> List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('conference.index') || request()->routeIs('conference.create') || request()->routeIs('conference.edit') ? 'active' : '' }}"
                            href="javascript:;">
                            <i class="fa-solid fa-building-columns"></i>
                            <span>Conference</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a class="{{ request()->routeIs('conference.create') ? 'active' : '' }}"
                                    href="{{ Route('conference.create') }}">
                                    <i class="far fa-plus-square"></i> Create
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('conference.index') ? 'active' : '' }}"
                                    href="{{ Route('conference.index') }}">
                                    <i class="far fa-list-alt"></i> List
                                </a>
                            </li>
                        </ul>
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
                @can('isAdmin')
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('blog_category.index') || request()->routeIs('blog_category.create') || request()->routeIs('blog_category.edit') ? 'active' : '' }}"
                            href="javascript:;">
                            <i class="fa-solid fa-list"></i>
                            <span>Categogies Blog</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a class="{{ request()->routeIs('blog_category.create') ? 'active' : '' }}"
                                    href="{{ Route('blog_category.create') }}">
                                    <i class="far fa-plus-square"></i> Create
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('blog_category.index') ? 'active' : '' }}"
                                    href="{{ route('blog_category.index') }}">
                                    <i class="far fa-list-alt"></i> List</a>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a class="{{ request()->routeIs('blog.index') || request()->routeIs('blog.create') || request()->routeIs('blog.edit') ? 'active' : '' }}"
                            href="javascript:;">
                            <i class="fa-solid fa-blog"></i>
                            <span>Blog</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a class="{{ request()->routeIs('blog.create') ? 'active' : '' }}"
                                    href="{{ Route('blog.create') }}">
                                    <i class="far fa-plus-square"></i> Create
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('blog.index') ? 'active' : '' }}"
                                    href="{{ route('blog.index') }}">
                                    <i class="far fa-list-alt"></i> List
                                </a>
                            </li>
                        </ul>
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
