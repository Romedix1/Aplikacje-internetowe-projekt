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
}