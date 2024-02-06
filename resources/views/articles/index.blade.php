<x-app-layout>

    <div class="bg-slate-300 h-screen flex justify-center items-center gap-6">
        @foreach($articles as $article)

        <div class="flex flex-col justify-between max-w-sm  h-100 w-full bg-white hover:bg-cyan-100 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg max-h-80 object-cover w-full" src="{{ $article->imageUrl }}" alt="" />
            </a>
            <div class="p-5 h-72 flex flex-col justify-between">
                <div>
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $article->title }}</h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-900">Auteur: {{ $article->user->name }} </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $article->text }}</p>
                </div>
                <a href="#" class="inline-flex items-center px-3 py-2 text-sm w-fit font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
