<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['member', 'book']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('member', function ($memberQuery) use ($search) {
                    $memberQuery
                        ->where('member_id', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                })
                    ->orWhereHas('book', function ($bookQuery) use ($search) {
                        $bookQuery
                            ->where('title', 'like', "%{$search}%")
                            ->orWhere('isbn', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $borrowings = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $members = Member::where('status', 'active')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        $books = Book::orderBy('title')->get();

        return view('pages.borrowings.index', compact(
            'borrowings',
            'members',
            'books'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => [
                'required',
                'exists:members,id',
            ],

            'book_id' => [
                'required',
                'exists:books,id',
            ],

            'borrowed_at' => [
                'required',
                'date',
            ],

            'due_at' => [
                'required',
                'date',
                'after_or_equal:borrowed_at',
            ],

            'status' => [
                'required',
                Rule::in([
                    'borrowed',
                    'returned',
                    'overdue',
                ]),
            ],

            'returned_at' => [
                'nullable',
                'date',
                'after_or_equal:borrowed_at',
            ],

            'fine' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        Borrowing::create($validated);

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Borrowing created successfully.');
    }

    public function show(string $id)
    {
        $borrowing = Borrowing::with(['member', 'book'])
            ->findOrFail($id);

        return view('pages.borrowings.show', compact('borrowing'));
    }

    public function edit(string $id)
    {
        $borrowing = Borrowing::findOrFail($id);

        return response()->json($borrowing);
    }

    public function update(Request $request, string $id)
    {
        $borrowing = Borrowing::findOrFail($id);

        $validated = $request->validate([
            'member_id' => [
                'required',
                'exists:members,id',
            ],

            'book_id' => [
                'required',
                'exists:books,id',
            ],

            'borrowed_at' => [
                'required',
                'date',
            ],

            'due_at' => [
                'required',
                'date',
                'after_or_equal:borrowed_at',
            ],

            'status' => [
                'required',
                Rule::in([
                    'borrowed',
                    'returned',
                    'overdue',
                ]),
            ],

            'returned_at' => [
                'nullable',
                'date',
                'after_or_equal:borrowed_at',
            ],

            'fine' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $borrowing->update($validated);

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Borrowing updated successfully.');
    }

    public function destroy(string $id)
    {
        $borrowing = Borrowing::findOrFail($id);

        $borrowing->delete();

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Borrowing deleted successfully.');
    }
}
