<header class="app-header">
    
    {{-- SideBar User Profile Logo Start --}}

    <a class="app-header__logo" href="{{ route('home') }}">
    
        @if(get_option('logo'))
    
            <img class="w-50" style="margin-top: 10px;" src="{{asset('storage/logo')}}/{{get_option('logo')}}" alt="">
        
        @else 
    
            <img src="{{asset('logo.png')}}" alt="Company Logo">
        
        @endif
    
    </a>

    {{-- SideBar User Profile Logo End --}}
    
    <a class="app-sidebar__toggle pt-2" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    
    <ul class="app-nav">

        {{-- Ecommerce Navber --}}
        <li class="dropdown"><a class="mt-1 app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-shopping-cart fa-lg"></i></a>
        
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
        
                <li><a class="dropdown-item" href="{{ route('admin.eCommerce.feature-product.index')}}"><i class="fa fa-free-code-camp fa-lg"></i> Feature Product</a></li>
        
                <li><a class="dropdown-item" href="{{ route('admin.eCommerce.hotsale-product.index') }}"><i class="fa fa-fire fa-lg"></i> Hot Sale Product</a></li>

                <li><a class="dropdown-item" href="{{ route('admin.eCommerce.eCommerce-offer.index') }}"><i class="fa fa-bullseye fa-lg"></i> eCommerce Offer</a></li>

                <li><a class="dropdown-item" href="{{ route('admin.eCommerce.order.index') }}"><i class="fa fa-first-order fa-lg"></i> Order</a></li>

                <li><a class="dropdown-item" href="{{ route('admin.client.index') }}"><i class="fa fa-user fa-lg"></i> Client</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.eCommerce.production-to-ecommerce.index') }}"><i class="fa fa-stop fa-lg"></i> Ecommerce Stock</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.eCommerce.curier-print') }}"><i class="fa fa-stop fa-lg"></i> Curier Print</a></li>
        
            </ul>
        
        </li>
    
        <li class="app-search">

            {{-- <h5  data-toggle="tooltip" data-placement="bottom" title="Software Current Active Timezone: {{date_default_timezone_get()}}" class="text-light pt-2 mr-2">{{date_default_timezone_get()}}</h5> &nbsp; --}}
            
            {{-- <h5  data-toggle="tooltip" data-placement="bottom" title="System Current Date {{carbonDate(date('d-m-Y'))}}." class="text-light pt-2">{{carbonDate(date('d-m-Y'))}}</h5> &nbsp; - &nbsp; --}}

            
            
            {{-- Current Time --}}
            <div id="jqclock" class="jqclock text-white" data-time="{{carbonDate(date('d-m-Y'))    }}"></div> 


            {{-- <h5  data-toggle="tooltip" data-placement="bottom" title="System Current Time {{carbonTime(date('h:i:s A'))}}." class="text-light pt-2">{{carbonTime(date('h:i:s A'))}}</h5> --}}
        
        </li>
      
        <!-- User Menu-->
        <li class="dropdown"><a class="mt-1 app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
        
                <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
        
                <li><a class="dropdown-item" href="" id="logout" data-url='{{ route('admin.logout') }}'><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
        
            </ul>
        
        </li>
    
    </ul>

</header>