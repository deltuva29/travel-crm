<div class="fixed bottom-0 md:top-4 md:right-2 w-full md:w-auto z-30 @if($hideOnClick) cursor-pointer @endif"
     x-data="{show: false, timeout: null, duration: null}"
     @if($message)
         x-init="() => { duration = @this.duration; clearTimeout(timeout); show = true;
                if( duration > 0 ) {timeout = setTimeout(() => { show = false }, duration); }}"
     @endif
     @new-toast.window="duration = @this.duration; clearTimeout(timeout); show = true;
                if( duration > 0 ) { timeout = setTimeout(() => { show = false }, duration); }"
     @click="if(@this.hideOnClick) { show = false; }"
     x-show="show"

     @if($transition)
         x-transition:enter="transition ease-in-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in-out duration-500"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
    @endif
>
    @if($message)
        <div class="flex items-center justify-center md:justify-start bg-{{$bgColorCss}}-500 hover:bg-opacity-100 w-full md:w-64 bg-opacity-75 py-3 md:py-1 px-3 shadow-lg z-depth-1">
            <!-- icons -->
            @if($showIcon)
                <div class="text-white mr-3">
                    @include('livewire-toast::icons.' . $type)
                </div>
            @endif
            <!-- message -->
            <div class="text-{{$textColorCss}} font-light">
                {!! $message !!}
            </div>
        </div>
    @endif
</div>
