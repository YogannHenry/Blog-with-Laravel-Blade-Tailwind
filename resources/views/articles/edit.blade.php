<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('articles.update', $article) }}">
            @csrf
            @method('patch')
            <textarea
                name="title"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('title', $article->title) }}</textarea>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
            <textarea
                name="description"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('description', $article->description) }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
            <textarea
                name="text"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('text', $article->text) }}</textarea>
            <x-input-error :messages="$errors->get('text')" class="mt-2" />
            <input
                name="imageUrl"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('imageUrl', $article->imageUrl) }}</input>
            <x-input-error :messages="$errors->get('imageUrl')" class="mt-2" />

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('articles.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
