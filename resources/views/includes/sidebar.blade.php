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

            <li @if (request()->routeIs('docs.*')) class="mm-active" @endif>
                <a href="{{route('docs.index')}}" class="" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#96A0AF" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                        <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                    </svg>
                    <span class="nav-text">Documents</span>
                </a>
            </li>

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
