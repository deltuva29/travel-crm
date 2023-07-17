<div class="hidden lg:flex items-center justify-center bg-yellow-400 flex-1 h-screen relative">
    <div id="indicators-carousel" class="relative w-full h-screen" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="relative h-full overflow-hidden rounded-none">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out h-full" data-carousel-item="active">
                <img src="{{ asset('images/home-hero-bg-2.jpg') }}" class="absolute block w-full h-full object-cover translate-x-0 translate-y-0 top-0 left-0" alt="...">
                <div class="absolute bg-yellow-400 h-full w-full opacity-10"></div>
                <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                    <div>
                        <h2 class="text-[3em] text-yellow-400 text-center font-extrabold" id="title">
                            {{ __('Poilsinių kelionių - CRM') }}
                        </h2>
                        <p class="text-[2em] text-white text-center font-extralight" id="subtitle">
                            {{ __('Kelionių valdymo sistema') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
                <img src="{{ asset('images/home-hero-bg.jpg') }}" class="absolute block w-full h-full object-cover translate-x-0 translate-y-0 top-0 left-0" alt="...">
                <div class="absolute bg-yellow-400 h-full w-full opacity-10"></div>
                <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                    <div>
                        <h2 class="text-[3em] text-yellow-400 text-center font-extrabold" id="title">
                            {{ __('Autobusų nuoma') }}
                        </h2>
                        <p class="text-[2em] text-white text-center font-extralight" id="subtitle">
                            {{ __('Čia galite pigiai išsinuomotį autobusą savo kelionėms') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
                <img src="{{ asset('images/home-hero-bg.jpg') }}" class="absolute block w-full h-full object-cover translate-x-0 translate-y-0 top-0 left-0" alt="...">
                <div class="absolute bg-yellow-400 h-full w-full opacity-10"></div>
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            <button type="button" class="!bg-yellow-400 w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="!bg-yellow-400 w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="!bg-yellow-400 w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        </div>
    </div>
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

                        carouselItem.classList.remove('animate__animated', 'animate__zoomIn');
                    });

                    let clickedItem = document.querySelectorAll('[data-carousel-item]')[i];
                    clickedItem.classList.remove("hidden");
                    clickedItem.dataset.carouselItem = "active";

                    currentIndex = i;
                });

                title.classList.add('animate__animated', 'animate__zoomIn');
                subtitle.classList.add('animate__animated', 'animate__zoomIn');
            });

            setInterval(() => {
                items[currentIndex].click();
                currentIndex = (currentIndex + 1) % totalItems;
            }, 10000);
        };
    </script>
@endpush
