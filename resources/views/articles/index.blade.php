<x-app-layout>
    <div class="w-full pl-64 bg-gradient-to-b from-slate-600 to-black pt-24">
        <x-bladewind.dropmenu>

            <x-slot name="trigger">
                <button type="secondary" size="tiny" class="bg-gray-300 px-2 py-1 font-bold border rounded-xl ml-10">
                    Nouvel article
                </button>
            </x-slot>

            <x-bladewind.dropmenu-item>
                <div class="max-w-2xl mx-auto w-96 p-4 sm:p-6 lg:p-8">
                    <form method="POST" action="{{ route('articles.store') }}">
                        @csrf
                        <textarea name="title" placeholder="{{ __('Title') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('title') }}</textarea>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        <textarea name="description" placeholder="{{ __('Description') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        <textarea name="text" placeholder="{{ __('Text') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('text') }}</textarea>
                        <x-input-error :messages="$errors->get('text')" class="mt-2" />
                        <input name="imageUrl" placeholder="{{ __('Image URL') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('imageUrl') }}</input>
                        <x-input-error :messages="$errors->get('imageUrl')" class="mt-2" />
                        <input name="bigImage" placeholder="{{ __('Big Image') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('imageUrl') }}</input>
                        <x-input-error :messages="$errors->get('bigImage')" class="mt-2" />

                        <!-- *************************************************** -->
                        <!-- *************************************************** -->
                        <!-- *************************************************** -->

                        <div class="mt-4">
                            <label for="tags">Tags:</label>
                            <select name="tags[]" id="tags">
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>

                            <label for="categories">Categories:</label>
                            <select name="categories[]" id="categories">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- *************************************************** -->
                        <!-- *************************************************** -->
                        <!-- *************************************************** -->

                        <div class="mt-4 space-x-2">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <a href="{{ route('articles.index') }}">{{ __('Cancel') }}</a>
                        </div>

                    </form>
                </div>
            </x-bladewind.dropmenu-item>

        </x-bladewind.dropmenu>
    </div>
    <div>
    </div>

    <div class="bg-gradient-to-b from-black to-slate-600 grid grid-cols-4 gap-6 px-40 pt-20">
        @foreach($articles as $article)


        <div class="flex flex-col justify-between max-w-sm   w-full bg-white hover:bg-cyan-100 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 transition duration-300 hover:scale-105">



        <a href="{{route('articles.show', $article)}}" >
                <img class="rounded-t-lg h-80 object-cover w-full" src="{{ $article->imageUrl }}" alt="" />
            </a>




            <div class="p-5 h-80 flex flex-col justify-between">
                <div>
                    <a href="">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $article->title }}</h5>
                    </a>
                    <p class="mb-3 font-bold  text-gray-500 dark:text-gray-400">Ce personnage à dit: "{{ $article->description }}"</p>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-900">Auteur: {{ $article->user->name }} </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 max-w-72 ">{{ $article->text }}</p>
                    @if ($article->articleTag->isNotEmpty() && $tag = $article->articleTag->first())



                </div>
                <div class="flex flex-row justify-between">
                    <div class="gap-7">
                        @php
                        $tagColorClass = '';

                        switch($tag->name) {
                        case 'Gentils':
                        $tagColorClass = 'bg-green-500';
                        break;
                        case 'Méchants':
                        $tagColorClass = 'bg-red-500';
                        break;
                        case 'Coquins':
                        $tagColorClass = 'bg-yellow-500';
                        break;
                        default:
                        $tagColorClass = 'bg-blue-700'; // ou toute autre classe par défaut
                        }
                        @endphp

                        <a href="#" class="inline-flex font-bold items-center px-3 py-2 text-sm w-fit  text-center text-white {{ $tagColorClass }} rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ $tag->name }}
                        </a>

                        @endif
                        @if ($article->articleCategory->isNotEmpty() && $category = $article->articleCategory->first())

                        @php
                        $tagColorClass = '';

                        switch($category->name) {
                        case 'Nains':
                        $tagColorClass = 'bg-red-800';
                        break;
                        case 'Elfes':
                        $tagColorClass = 'bg-blue-800';
                        break;
                        case 'Orcs':
                        $tagColorClass = 'bg-green-700';
                        break;
                        default:
                        $tagColorClass = 'bg-blue-700'; // ou toute autre classe par défaut
                        }
                        @endphp

                        <a href="#" class="inline-flex items-center px-3 py-2 text-sm w-fit font-medium text-center text-white {{ $tagColorClass }} rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Race:  {{ $category->name}}
                        </a>
                        @endif
                    </div>
                    @if ($article->user->is(auth()->user()))
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('articles.edit', $article)">
                                {{ __('Edit') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('articles.destroy', $article) }}">
                                @csrf
                                @method('delete')
                                <x-dropdown-link :href="route('articles.destroy', $article)" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Delete') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
