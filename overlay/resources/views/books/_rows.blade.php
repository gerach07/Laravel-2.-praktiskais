@forelse ($books as $book)
    <tr class="border-t">
        <td class="px-4 py-3 font-medium text-gray-900">{{ $book->title }}</td>
        <td class="px-4 py-3">{{ $book->author }}</td>
        <td class="px-4 py-3">{{ $book->genre->name }}</td>
        <td class="px-4 py-3">
            <button type="button" data-url="{{ route('books.toggle', $book) }}"
                class="toggle-btn px-3 py-1 rounded text-sm {{ $book->is_read ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                {{ $book->is_read ? 'Izlasīta' : 'Neizlasīta' }}
            </button>
        </td>
        <td class="px-4 py-3 text-right whitespace-nowrap">
            <a href="{{ route('books.show', $book) }}" class="text-indigo-600 hover:underline">Skatīt</a>
            <a href="{{ route('books.edit', $book) }}" class="text-yellow-600 hover:underline ml-3">Labot</a>
            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline"
                onsubmit="return confirm('Vai tiešām dzēst šo grāmatu?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline ml-3">Dzēst</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="px-4 py-6 text-center text-gray-500">Nekas nav atrasts.</td>
    </tr>
@endforelse
