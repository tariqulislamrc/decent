<aside class="app-sidebar">
    <div class="app-sidebar__user">
        {{-- User Photo --}}
        <img class="app-sidebar__user-avatar" src="{{auth()->user()->image? asset('storage/user/photo/'.auth()->user()->image):'https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg'}}" alt="User Image">
        <div>
            {{-- User Name --}}
            <p class="app-sidebar__user-name">{{auth()->user()->name?auth()->user()->name:'John Doe'}}</p>
            {{-- User Admin/User --}}
            <p class="app-sidebar__user-designation">{{getUserRoleName(auth()->user()->id)?getUserRoleName(auth()->user()->id):'Admin'}}</p>
        </div>
    </div>
    <ul class="app-menu">
        @include('_partials.member.sidebar.main_sidebar')
    </ul>
</aside>
