<?php

namespace App\Http\Controllers;

use App\Filters\BookLoanFilter;
use App\Models\Book;
use App\Models\User;
use App\Models\BookLoan;
use App\Traits\Tables;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Traits\ResourceValidator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLoanRequest;

class LoanController extends Controller
{
    use HttpResponses, ResourceValidator, Tables;
   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, BookLoanFilter $filter, 
                            string $book_id)
    {
    
        $this->validateBook($book_id);
        $filterate = ['user_id' => $request->user()->id, 
                        'book_id' => $book_id];
        $loan = BookLoan::with('user')->filter($filter, $filterate)->get();
        return $this->success($loan, 'Request successful');
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request, string $book_id)
    {
        $this->validateBook($book_id);
        $loan = new BookLoan();
        $loan->fill($request->all());
        $loan->book_id = $request->book_id;
        $loan->user_id = $request->user_id;
        $loan->loan_status = $request->loan_status ?? BookLoan::UNPAID;
        $loan->loan_date = $request->loan_date ?? now()->format('Y-m-d');
        $loan->due_date = $request->due_date;
        $loan->added_by = User::find($request->added_by);
        $loan->save();
        return $this->success($loan, 'Loan created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $book, string $loan)
    {
        $this->validateBookLoan($loan, $book);
        $loan = BookLoan::with('user', 'book', 'added_by', 'book.category')->find($loan);
        $loan->user->makeHidden(['password']);
        return $this->success($loan, 'Loan retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLoanRequest $request, string $id)
    {
        $this->validateBookLoan($id);
        $loan = BookLoan::find( $id );
        $loan->fill($request->all());
        $loan->user_id = $request->user_id;
        $loan->update();
        return $loan;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $book, string $loan)
    {
        $this->validateBook($book);
        $this->validateBookLoan($loan, $book);
        $loan = BookLoan::find( $loan );
        $loan->delete();
        return $this->success($loan, "Loan Deleted successfully");
    }
}
