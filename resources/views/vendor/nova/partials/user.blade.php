<dropdown-trigger class="h-9 flex items-center px-3">
    <img src="{{ $user->hasMedia('avatar') ? $user->getFirstMediaUrl('avatar') : asset('images/user/no-avatar.png')  }}" alt="{{ __('Avataras') }}" class="rounded-full h-8 w-8 mr-2">
    <span class="text-90">
        {{ $user->name ?? $user->email ?? __('Darbuotojas') }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</dropdown-menu>
