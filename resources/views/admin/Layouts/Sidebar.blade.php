<div class="main-sidemenu">
    <div class="app-sidebar__user clearfix">
        <div class="dropdown user-pro-body">
       
        </div>
    </div>

    <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>

    <ul class="side-menu">
        <li class="side-item side-item-category">لوحة التحكم</li>

        <!-- Homepage Link -->
        <li class="slide">
            <a class="side-menu__item" href="{{url('/home')}}">

                <svg class="svg-icon side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                    <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"></path>
                    <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"></path>
                </svg>


                <span class="side-menu__label">الصفحة الرئيسية</span>
            </a>
        </li>

        <!-- Dashboard Link -->
        <li class="slide">
            <a class="side-menu__item"  href="{{route('dashboard.home')}}">

                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" >
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/>
                    <path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/>
                </svg>

                <span class="side-menu__label">لوحة التحكم</span>

            </a>
        </li>

        <!-- Users -->
        <li class="side-item side-item-category">التطبيق</li>

        <!---- Students -->
        <li class="slide" >
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                <svg class="svg-icon side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M12 16c-2.69 0-5.77 1.28-6 2h12c-.2-.71-3.3-2-6-2z" opacity=".3"></path><circle cx="12" cy="8" opacity=".3" r="2"></circle><path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm-6 4c.22-.72 3.31-2 6-2 2.7 0 5.8 1.29 6 2H6zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"></path></svg>
                <span class="side-menu__label">المستخدمين</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
{{--users and admins--}}
            <ul class="slide-menu">
                <li><a class="slide-item " href="{{route('dashboard.users.index')}}"> المستخدمين </a></li>
                <li><a class="slide-item " href="{{route('dashboard.admins.index')}}"> المديرين </a></li>

            </ul>

{{--categories--}}
            <a class="side-menu__item" data-bs-toggle="slide" href="{{route('dashboard.categories.index')}}">
                <svg class="svg-icon side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                    <path d="M19 3H5c-1.1 0-1.99.9-1.99 2L3 19c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 14H5V5h14v12z"></path>
                  </svg>                
                <span class="side-menu__label">الاصناف</span>
            </a>

            {{--products--}}           
            <a class="side-menu__item" data-bs-toggle="slide"  href="{{route('dashboard.products.index')}}">

                <svg class="svg-icon side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                    <path d="M20 8h-1V4c0-1.1-.9-2-2-2H6C4.9 2 4 2.9 4 4v4H3c-.6 0-1 .4-1 1v10c0 .6.4 1 1 1h18c.6 0 1-.4 1-1V9c0-.6-.4-1-1-1zM8 5h8v3H8V5zm11 13H5V10h14v8zm-4-4l-2-2-2 2-2-2-2 2 2 2 2-2 2 2z"></path>
                </svg>
                <span class="side-menu__label">المنتجات</span>
            </a>

            {{--orders--}}
            <a class="side-menu__item" data-bs-toggle="slide" href="{{route('dashboard.orders.index')}}">
                <svg class="svg-icon side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M12 16c-2.69 0-5.77 1.28-6 2h12c-.2-.71-3.3-2-6-2z" opacity=".3"></path><circle cx="12" cy="8" opacity=".3" r="2"></circle><path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm-6 4c.22-.72 3.31-2 6-2 2.7 0 5.8 1.29 6 2H6zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"></path></svg>
                <span class="side-menu__label">الطلبات</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
           

            
            {{-- <a class="side-menu__item" data-bs-toggle="slide" href="{{route('dashboard.orders.index')}}">
                <svg class="svg-icon side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M12 16c-2.69 0-5.77 1.28-6 2h12c-.2-.71-3.3-2-6-2z" opacity=".3"></path><circle cx="12" cy="8" opacity=".3" r="2"></circle><path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm-6 4c.22-.72 3.31-2 6-2 2.7 0 5.8 1.29 6 2H6zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"></path></svg>
                <span class="side-menu__label">الاصناف</span>
                <i class="angle fe fe-chevron-down"></i>
            </a> --}}
        </li>

    
    </ul>

    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
</div>
