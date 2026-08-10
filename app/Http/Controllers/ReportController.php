<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Fine;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'this_month');

        $now = now();

        switch ($period) {
            case 'last_month':
                $startDate = $now->copy()->subMonth()->startOfMonth();
                $endDate = $now->copy()->subMonth()->endOfMonth();
                break;

            case 'this_year':
                $startDate = $now->copy()->startOfYear();
                $endDate = $now->copy()->endOfYear();
                break;

            case 'this_month':
            default:
                $startDate = $now->copy()->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Base Borrowing Query
        |--------------------------------------------------------------------------
        */

        $borrowings = Borrowing::query()
            ->whereBetween('borrowed_at', [
                $startDate->toDateString(),
                $endDate->toDateString(),
            ]);

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalBorrowings = (clone $borrowings)->count();

        $returnedBooks = (clone $borrowings)
            ->where('status', 'returned')
            ->count();

        $overdueBooks = (clone $borrowings)
            ->where('status', 'overdue')
            ->count();

        $collectedFines = Fine::query()
            ->where('status', 'paid')
            ->whereBetween('paid_at', [
                $startDate,
                $endDate,
            ])
            ->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | Most Borrowed Books
        |--------------------------------------------------------------------------
        */

        $popularBooks = (clone $borrowings)
            ->select('book_id', DB::raw('COUNT(*) as borrow_count'))
            ->with('book:id,title')
            ->groupBy('book_id')
            ->orderByDesc('borrow_count')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Monthly Borrowing Activity
        |--------------------------------------------------------------------------
        */

        $monthlyBorrowings = Borrowing::query()
            ->select(
                DB::raw('MONTH(borrowed_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('borrowed_at', $startDate->year)
            ->groupBy(DB::raw('MONTH(borrowed_at)'))
            ->orderBy('month')
            ->pluck('total', 'month');

        $months = collect(range(1, 12));

        $monthlyData = $months->map(function ($month) use ($monthlyBorrowings) {
            return [
                'month' => Carbon::create()
                    ->month($month)
                    ->format('M'),

                'count' => $monthlyBorrowings->get($month, 0),
            ];
        });

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view('pages.reports.index', compact(
            'period',
            'startDate',
            'endDate',
            'totalBorrowings',
            'returnedBooks',
            'overdueBooks',
            'collectedFines',
            'popularBooks',
            'monthlyData'
        ));
    }
}
