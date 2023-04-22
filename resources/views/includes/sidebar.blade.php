<!--**********************************
    Sidebar start
***********************************-->

@php
$g_parents = $g_categories->whereNull('parent_id');
@endphp
<div class="dlabnav border-right">
    <div class="dlabnav-scroll">
        <p class="menu-title style-1"> Main Menu</p>
        <ul class="metismenu" id="menu">
            <li @if (request()->routeIs('homepage')) class="mm-active" @endif>
                <a href="{{route('homepage')}}" class="" aria-expanded="false">
                    <i class="bi bi-house"></i><span class="nav-text">Home</span>
                </a>
            </li>
            @foreach ($g_parents as $g_parent)
            @php $url = route('menu.category', ['category' => $g_parent->id]); @endphp
            <li @if(request()->url() == $url) class="mm-active" @endif>
                <a class="has-arrow @if(request()->is($url)) mm-active @endif" href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-grid"></i><span class="nav-text">{{$g_parent->title}}</span>
                </a>
                <ul aria-expanded="false">
                    @foreach ($g_categories->where('parent_id', $g_parent->id) as $g_cat)
                    <li><a href="{{route('menu.menu', $g_cat->id)}}">{{$g_cat->title}}</a></li>
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
                    @foreach ($g_parents as $g_parent)
                    <li @if (request()->is(route('admin.categories.show', ['category' => $g_parent->id]))) class="mm-active" @endif>
                        <a @if (request()->is(route('admin.categories.show', ['category' => $g_parent->id]))) class="mm-active" @endif
                            href="{{route('admin.categories.show', $g_parent->id)}}">
                            {{$g_parent->title}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>

            <li @if (request()->routeIs('admin.food.*')) class="mm-active" @endif>
                <a class="has-arrow " href="javascript:void(0);"
                    aria-expanded="{{request()->routeIs('admin.categories.*') ? 'true' : 'false'}}">
                    <i class="bi bi-list"></i><span class="nav-text">Menu Items</span>
                </a>
                <ul aria-expanded="{{request()->routeIs('admin.food.*') ? 'true' : 'false'}}">
                    <li @if (request()->routeIs('admin.food.index')) class="mm-active" @endif>
                        <a @if (request()->routeIs('admin.food.index')) class="mm-active" @endif href="{{route('admin.food.index')}}">All Food Items</a>
                    </li>
                    @foreach ($g_parents as $g_parent)
                    <li>
                        <a class="has-arrow" href="javascript:void(0);" aria-expanded="true">{{$g_parent->title}}</a>
                        <ul aria-expanded="false" class="left" style="">
                            @foreach ($g_categories->where('parent_id', $g_parent->id) as $cat)
                            @php $url = route('admin.food.category', ['category' => $cat->id]); @endphp
                            <li @if (request()->is($url)) class="mm-active" @endif>
                                <a @if(request()->is($url)) class="mm-active" @endif href="{{$url}}">{{$cat->title}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </li>

            <li @if (request()->routeIs('admin.fields.*')) class="mm-active" @endif>
                <a href="{{route('admin.fields.index')}}" class="" aria-expanded="false">
                    <i class="bi bi-file-earmark-plus"></i><span class="nav-text">Extra Fileds</span>
                </a>
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
