<?php

namespace App\Http\Controllers;

use App\Models\BookLoan;
use App\Models\Penalty;
use App\Traits\ResourceValidator;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenaltyRequest;

class PenaltyController extends Controller
{
    use HttpResponses, ResourceValidator;
    /**
     * Display a listing of the resource.
     */
    public function index(string $book_id, string $loan_id)
    {
        $this->validateBookLoan($loan_id, $book_id);
        $penalties = Penalty::with('book_loan')->get();
        return $this->success($penalties, "Retrieved Penalties successfully");
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
    public function store(StorePenaltyRequest $request, string $book, string $loan)
    {
        $request->validated();
        $this->validateBookLoan($loan, $book);

        // Check if loan already paid
        $book_loan = BookLoan::find($loan);
        if ($book_loan->status == BookLoan::PAID){
            abort(422, "Book loan already paid");
        }

        $penalties = new Penalty();
        $penalties->fill($request->all());
        $penalties->book_loan_id = $loan;

        return $this->success($penalties, "successfully posted penalty");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $book_id, $loan_id, $penalty_id)
    {
        $this->validatePenalty($penalty_id, $loan_id, $book_id);
        return $book_id.$loan_id.$penalty_id;
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
