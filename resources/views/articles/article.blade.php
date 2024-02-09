<x-app-layout>
    <video autoplay muted loop style="position: fixed; z-index: -1; bottom: 2; left: 0; width: 120%; height: 100%;">
        <source src="https://video.wixstatic.com/video/d47472_58cce06729c54ccb935886c4b3647274/1080p/mp4/file.mp4" type="video/mp4">
    </video>
    <div class="z-1 pt-20">
        <h2 class="font-semibold font-mono text-4xl  leading-tight text-yellow-400 w-full flex justify-center  ">
            {{ $article->title }}
        </h2>

    </div>
    <p class="font-semibold font-mono text-xl  mt-20 leading-tight text-white  ml-16 "> {{ $article->text}}</p>

    <div class="flex">

        <div class="w-1/2 p-10">

            <!-- ************************* -->
            <!-- ************************* -->
            <!-- ************************* -->
            <!-- ************************* -->
            <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 ">
                <form method="POST" action="{{ route('chirps.store', $article) }}">
                    @csrf
                    <textarea name="message" placeholder="{{ __('What\'s on your mind?') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message') }}</textarea>
                    <textarea name="article_id" class="hidden">{{ $article->id }}</textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    <x-primary-button class="mt-4 bg-sky-400">fuck</x-primary-button>
                </form>
                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    @foreach ($article->chirp as $chirp)
                    <div class="p-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $chirp->user->name }}</span>

                                </div>
                                @if ($chirp->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-slot name="trigger">
                                            <x-dropdown-link>
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                        <x-bladewind.dropmenu-item>
                                            <div class="max-w-2xl mx-auto w-96 p-4 sm:p-6 lg:p-8">
                                                <form method="POST" action="{{ route('chirps.update', $chirp) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <textarea name="message" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" onclick="event.stopPropagation()">{{ old('message', $chirp->message) }}</textarea>
                                                    <textarea name="article_id" class="hidden">{{ $article->id }}</textarea>

                                                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                                    <div class="mt-4 space-x-2">
                                                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                                                        <a href="{{ route('chirps.index') }}">{{ __('Cancel') }}</a>
                                                    </div>
                                                </form>

                                            </div>
                                        </x-bladewind.dropmenu-item>
                                        <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                            @csrf
                                            @method('delete')
                                            <textarea name="article_id" class="hidden">{{ $article->id }}</textarea>

                                            <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                                @endif
                            </div>
                            <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-1/2  ">
            <img src="{{ $article->bigImage }}" alt="Search" class="w-2/6 fixed mx-auto bottom-0 right-10">
        </div>

        <!-- ************************* -->
        <!-- ************************* -->
        <!-- ************************* -->

        <!-- ************************* -->
    </div>

</x-app-layout>
