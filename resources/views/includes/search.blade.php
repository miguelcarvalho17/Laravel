<section class="text-gray-600 body-font border-b border-gray-100">
    <div class="container mx-auto flex flex-col px-5 pt-16 pb-8 justify-center items-center">
        <div class="w-full md:w-2/3 flex flex-col items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Top jobs available right now!</h1>
            <p class="mb-8 leading-relaxed">If you are looking for a new job or just want to check whats available, check our list of jobs.</p>
            <form class="flex w-full justify-center items-end" action="{{ route('welcome') }}" method="get">
                <div class="center-block">
                    <input type="text" class="center-block" id="s" name="s" value="{{ request()->get('s') }}" placeholder='search job'class="w-full bg-gray-100 bg-opacity-50 rounded focus:ring-2 focus:ring-indigo-200 focus:bg-transparent border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    <button style="background-color:cornflowerblue;" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Search</button>
                    <br>
                </div>
                
            </form>
        </div>
    </div>
</section>
