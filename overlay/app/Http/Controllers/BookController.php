<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // validācijas noteikumi
    private function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'pages' => 'nullable|integer|min:1|max:10000',
            'year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'description' => 'nullable|string|max:1000',
        ];
    }

    private function messages()
    {
        return [
            'required' => 'Lauks ":attribute" ir obligāts.',
            'max' => 'Lauka ":attribute" vērtība ir par lielu vai garu.',
            'min' => 'Lauka ":attribute" vērtība ir par mazu.',
            'integer' => 'Laukam ":attribute" jābūt skaitlim.',
            'exists' => 'Izvēlēts nederīgs žanrs.',
        ];
    }

    private function attributes()
    {
        return [
            'title' => 'nosaukums',
            'author' => 'autors',
            'genre_id' => 'žanrs',
            'pages' => 'lappuses',
            'year' => 'izdošanas gads',
            'description' => 'apraksts',
        ];
    }

    // grāmatas, kas pieder ielogotajam lietotājam
    private function myBooks()
    {
        return Book::with('genre')->where('user_id', auth()->id());
    }

    private function checkOwner(Book $book)
    {
        if ($book->user_id !== auth()->id()) {
            abort(403);
        }
    }

    public function index()
    {
        $books = $this->myBooks()->latest()->get();
        return view('books.index', compact('books'));
    }

    // AJAX meklēšana - atgriež tabulas rindas
    public function search(Request $request)
    {
        $q = $request->input('q', '');

        $books = $this->myBooks()
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%$q%")
                      ->orWhere('author', 'like', "%$q%");
            })
            ->latest()
            ->get();

        return view('books._rows', compact('books'));
    }

    public function create()
    {
        $genres = Genre::orderBy('name')->get();
        return view('books.create', ['book' => new Book(), 'genres' => $genres]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages(), $this->attributes());
        $data['user_id'] = auth()->id();

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Grāmata pievienota!');
    }

    public function show(Book $book)
    {
        $this->checkOwner($book);
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $this->checkOwner($book);
        $genres = Genre::orderBy('name')->get();
        return view('books.edit', compact('book', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $this->checkOwner($book);
        $data = $request->validate($this->rules(), $this->messages(), $this->attributes());

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Grāmata atjaunota!');
    }

    public function destroy(Book $book)
    {
        $this->checkOwner($book);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Grāmata dzēsta!');
    }

    // AJAX - izlasīta / neizlasīta
    public function toggleRead(Book $book)
    {
        $this->checkOwner($book);
        $book->is_read = !$book->is_read;
        $book->save();

        return response()->json(['is_read' => $book->is_read]);
    }
}
