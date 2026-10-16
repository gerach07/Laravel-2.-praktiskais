<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $book->title }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6 text-gray-700 space-y-2">
                <p><strong>Autors:</strong> {{ $book->author }}</p>
                <p><strong>Žanrs:</strong> {{ $book->genre->name }}</p>
                <p><strong>Lappuses:</strong> {{ $book->pages ?? '-' }}</p>
                <p><strong>Gads:</strong> {{ $book->year ?? '-' }}</p>
                <p><strong>Statuss:</strong> {{ $book->is_read ? 'Izlasīta' : 'Neizlasīta' }}</p>
                <p><strong>Apraksts:</strong> {{ $book->description ?? '-' }}</p>

                <div class="pt-4 flex gap-4">
                    <a href="{{ route('books.edit', $book) }}" class="text-yellow-600 hover:underline">Labot</a>
                    <a href="{{ route('books.index') }}" class="text-gray-600 hover:underline">Atpakaļ</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
