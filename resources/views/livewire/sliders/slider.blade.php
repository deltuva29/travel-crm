<div class="hidden lg:flex items-center justify-center bg-yellow-400 flex-1 h-screen relative">
    @if (count($carousels) > 0)
        <div id="indicators-carousel" class="relative w-full h-screen" data-carousel="static">
            <!-- Home Slider -->
            <div class="relative h-full overflow-hidden rounded-none">
                @foreach($carousels as $carouselSlide)
                    <div class="{{ $loop->first ? '' : 'hidden' }} duration-700 ease-in-out h-full"
                         @if (count($carousels) > 1)
                             data-carousel-item="{{ $loop->first ? 'active' : 'inactive' }}"
                         @endif wire:ignore>
                        @if ($carouselSlide->hasMedia('background_image'))
                            <img src="{{ asset($carouselSlide->getFirstMediaUrl('background_image')) }}" class="absolute block w-full h-full object-cover translate-x-0 translate-y-0 top-0 left-0" alt="...">
                        @endif
                        <div class="absolute bg-yellow-400 h-full w-full opacity-10"></div>
                        <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                            <div>
                                @if (!empty($carouselSlide->title))
                                    <h2 class="text-[3em] text-yellow-400 text-center font-extrabold" id="title">
                                        {{ $carouselSlide->title }}
                                    </h2>
                                @endif
                                @if (!empty($carouselSlide->description))
                                    <p class="text-[2em] text-white text-center font-extralight" id="subtitle">
                                        {!! $carouselSlide->description !!}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (count($carousels) > 1)
                <!-- Home Slider indicators -->
                <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                    @foreach($carousels as $carouselSlideIndex => $carouselSlide)
                        <button
                            type="button"
                            class="!bg-yellow-400 w-3 h-3 rounded-full"
                            aria-label="Slide {{ $carouselSlideIndex + 1 }}"
                            data-carousel-slide-to="{{ $carouselSlideIndex }}"
                        >
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>

@push('scripts')
    <script>
        window.onload = function () {
            const items = document.querySelectorAll('[data-carousel-slide-to]');
            const totalItems = items.length;
            let currentIndex = 0;

            const title = document.querySelector('#title');
            const subtitle = document.querySelector('#subtitle');

            if (!title || !subtitle) {
                console.error('Title or subtitle not found');
                return;
            }

            items.forEach((item, i) => {
                item.addEventListener('click', () => {

                    document.querySelectorAll('[data-carousel-item]').forEach((carouselItem) => {
                        carouselItem.classList.add("hidden");
                        carouselItem.dataset.carouselItem = "";
                    });

                    let clickedItem = document.querySelectorAll('[data-carousel-item]')[i];
                    clickedItem.classList.remove("hidden");
                    clickedItem.dataset.carouselItem = "active";

                    title.classList.add('animate__animated', 'animate__fadeIn');
                    subtitle.classList.add('animate__animated', 'animate__fadeIn');

                    currentIndex = i;
                });
            });

            setInterval(() => {
                if (items[currentIndex]) {
                    items[currentIndex].click();
                }
                currentIndex = (currentIndex + 1) % totalItems;
            }, 10000);
        };
    </script>
@endpush
