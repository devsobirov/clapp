<!--**********************************
    Sidebar start
***********************************-->
<div class="dlabnav border-right">
    <div class="dlabnav-scroll">
        <p class="menu-title style-1"> Main Menu</p>
        <ul class="metismenu" id="menu">
            <li @if (request()->routeIs('homepage')) class="mm-active" @endif>
                <a href="{{route('homepage')}}" class="" aria-expanded="false">
                    <i class="bi bi-house"></i><span class="nav-text">Home</span>
                </a>
            </li>
            @foreach ($g_categories->whereNull('parent_id') as $g_parent)
            <li>
                <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-grid"></i><span class="nav-text">{{$g_parent->title}}</span>
                </a>
                <ul aria-expanded="false">
                    @foreach ($g_categories->where('parent_id', $g_parent->id) as $g_cat)
                    <li><a href="#">{{$g_cat->title}}</a></li>
                    @endforeach
                </ul>
            </li>
            @endforeach

            @if (auth()->user()->isAdmin())
            <li class="menu-title">Admin</li>

            <li @if (request()->routeIs('admin.categories.*')) class="mm-active" @endif>
                <a class="has-arrow " href="javascript:void(0);"
                    aria-expanded="{{request()->routeIs('admin.categories.*') ? 'true' : 'false'}}">
                    <i class="bi bi-list"></i><span class="nav-text">Menu Categories</span>
                </a>
                <ul aria-expanded="{{request()->routeIs('admin.categories.*') ? 'true' : 'false'}}">
                    <li @if (request()->routeIs('admin.categories.index')) class="mm-active" @endif>
                        <a @if (request()->routeIs('admin.categories.index')) class="mm-active" @endif href="{{route('admin.categories.index')}}">Main Categories</a>
                    </li>
                    @foreach ($g_categories->whereNull('parent_id') as $g_parent)
                    <li @if (request()->is(route('admin.categories.show', ['category' => $g_parent->id]))) class="mm-active" @endif>
                        <a @if (request()->is(route('admin.categories.show', ['category' => $g_parent->id]))) class="mm-active" @endif
                            href="{{route('admin.categories.show', $g_parent->id)}}">
                            {{$g_parent->title}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li @if (request()->routeIs('admin.users.*')) class="mm-active" @endif>
                <a href="{{route('admin.users.index')}}" class="" aria-expanded="false">
                    <i class="bi bi-person"></i><span class="nav-text">Users</span>
                </a>
            </li>

            @endif
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
