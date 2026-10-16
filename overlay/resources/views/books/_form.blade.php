@csrf

<div>
    <x-input-label for="title" value="Nosaukums" />
    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $book->title)" />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="author" value="Autors" />
    <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author', $book->author)" />
    <x-input-error :messages="$errors->get('author')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="genre_id" value="Žanrs" />
    <select id="genre_id" name="genre_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">-- izvēlies žanru --</option>
        @foreach ($genres as $genre)
            <option value="{{ $genre->id }}" @selected(old('genre_id', $book->genre_id) == $genre->id)>{{ $genre->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('genre_id')" class="mt-2" />
</div>

<div class="mt-4 grid grid-cols-2 gap-4">
    <div>
        <x-input-label for="pages" value="Lappuses" />
        <x-text-input id="pages" name="pages" type="number" class="mt-1 block w-full" :value="old('pages', $book->pages)" />
        <x-input-error :messages="$errors->get('pages')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="year" value="Izdošanas gads" />
        <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" :value="old('year', $book->year)" />
        <x-input-error :messages="$errors->get('year')" class="mt-2" />
    </div>
</div>

<div class="mt-4">
    <x-input-label for="description" value="Apraksts" />
    <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $book->description) }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<div class="mt-6 flex items-center gap-4">
    <x-primary-button>Saglabāt</x-primary-button>
    <a href="{{ route('books.index') }}" class="text-gray-600 hover:underline">Atcelt</a>
</div>
