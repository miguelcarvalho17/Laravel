<section class="text-gray-600 body-font overflow-hidden">
    <div class="container px-5 py-12 mx-auto">
        <div class="mb-12 flex items-center">
            <h2 class="text-2xl font-medium text-gray-900 title-font px-4">
                Your Jobs ({{ $jobs->count()}})
            </h2>
        </div>
        <div class="-my-6">
            @foreach($jobs as $job)
                <a
                    href="{{ route('showJob', $job->title) }}"
                    class="py-6 px-4 flex flex-wrap md:flex-nowrap border-b border-gray-100 {{ $job->is_active ? 'bg-yellow-100 hover:bg-yellow-200' : 'bg-white hover:bg-gray-100' }}"
                >
                    <div class="md:w-16 md:mb-0 mb-6 mr-4 flex-shrink-0 flex flex-col">
                        <img src="/storage/{{ $job->logo }}" class="w-16 h-16 rounded-full object-cover">
                    </div>
                    <div class="justify-center">
                        <h2 class="text-xl font-bold text-gray-900 title-font mb-1">{{ $job->title }}</h2>
                        <p class="leading-relaxed text-gray-900">{{ $job->company }} &mdash; <span class="text-gray-600">{{ $job->location }}</span></p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
