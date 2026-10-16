<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mana grāmatu bibliotēka</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="flex flex-col sm:flex-row gap-4 justify-between mb-4">
                <input type="text" id="search" placeholder="Meklēt pēc nosaukuma vai autora..."
                    class="w-full sm:w-96 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <a href="{{ route('books.create') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md text-center hover:bg-indigo-700">+ Pievienot grāmatu</a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-700">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Nosaukums</th>
                            <th class="px-4 py-3">Autors</th>
                            <th class="px-4 py-3">Žanrs</th>
                            <th class="px-4 py-3">Statuss</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody id="books-body">
                        @include('books._rows')
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const search = document.getElementById('search');
        const body = document.getElementById('books-body');
        let timer;

        // AJAX meklēšana
        search.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(function () {
                fetch('{{ route('books.search') }}?q=' + encodeURIComponent(search.value))
                    .then(function (r) { return r.text(); })
                    .then(function (html) { body.innerHTML = html; });
            }, 300);
        });

        // AJAX izlasīta / neizlasīta
        body.addEventListener('click', function (e) {
            const btn = e.target.closest('.toggle-btn');
            if (!btn) return;

            fetch(btn.dataset.url, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    if (data.is_read) {
                        btn.textContent = 'Izlasīta';
                        btn.className = 'toggle-btn px-3 py-1 rounded text-sm bg-green-100 text-green-800';
                    } else {
                        btn.textContent = 'Neizlasīta';
                        btn.className = 'toggle-btn px-3 py-1 rounded text-sm bg-gray-100 text-gray-700';
                    }
                });
        });
    </script>
</x-app-layout>
