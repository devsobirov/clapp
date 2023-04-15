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

            <li class="menu-title">Admin</li>
            <li>
                <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-info-circle"></i> <span class="nav-text">Apps</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="app-profile.html">Profile</a></li>
                    <li><a href="post-details.html">Post Details</a></li>
                    <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Email</a>
                        <ul aria-expanded="false">
                            <li><a href="email-compose.html">Compose</a></li>
                            <li><a href="email-inbox.html">Inbox</a></li>
                            <li><a href="email-read.html">Read</a></li>
                        </ul>
                    </li>
                    <li><a href="app-calender.html">Calendar</a></li>
                    <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Shop</a>
                        <ul aria-expanded="false">
                            <li><a href="ecom-product-grid.html">Product Grid</a></li>
                            <li><a href="ecom-product-list.html">Product List</a></li>
                            <li><a href="ecom-product-detail.html">Product Details</a></li>
                            <li><a href="ecom-product-order.html">Order</a></li>
                            <li><a href="ecom-checkout.html">Checkout</a></li>
                            <li><a href="ecom-invoice.html">Invoice</a></li>
                            <li><a href="ecom-customers.html">Customers</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
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
                    <li @if (request()->routeIs('admin.categories.show', $g_parent->id)) class="mm-active" @endif>
                        <a @if (request()->routeIs('admin.categories.show', $g_parent->id)) class="mm-active" @endif
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
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
