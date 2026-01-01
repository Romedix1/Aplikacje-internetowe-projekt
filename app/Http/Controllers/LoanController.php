<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCopy;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['book_copy_id' => 'required|exists:book_copies,id',]);

        $copy = BookCopy::findOrFail($request->book_copy_id);

        if ($copy->status !== 'available') {
            return back()->withErrors(['msg' => 'Ten egzemplarz jest już wypożyczony']);
        }

        $copy->update(['status' => 'loaned']);

        Loan::create([
            'user_id' => Auth::id(),
            'book_copy_id' => $copy->id,
            'loaned_at' => now(),
            'due_at' => now()->addDays(30),
        ]);

        return back()->with('success', 'Książka została wypożyczona');
    }

    public function index()
    {
        $loans = Loan::where('user_id', Auth::id())->whereNull('returned_at')->with('bookCopy.book')->orderBy('due_at', 'asc')->get();

        return view('loans.index', compact('loans'));
    }

    public function staffIndex()
    {
        $activeLoans = Loan::whereNull('returned_at')->with(['user', 'bookCopy.book'])->orderBy('due_at', 'asc')->get();

        return view('staff.loans', compact('activeLoans'));
    }

    public function returnBook(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $loan->update(['returned_at' => now()]);

        $loan->bookCopy->update(['status' => 'available']);

        return back()->with('success', 'Książka została zwrócona');
    }
}