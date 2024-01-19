<?php

namespace App\Http\Controllers;

use App\Filters\BookLoanFilter;
use App\Http\Requests\StoreLoanRequest;
use App\Models\BookLoan;
use App\Traits\Tables;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;

class BookLoanController extends Controller
{
    use HttpResponses, Tables;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req, BookLoanFilter $filter)
    {
        $filter_data = [$this->userId => $req->user()->id, ...$req->all()];
        $loans = BookLoan::query()->filter($filter, $filter_data)->get();
        return $this->success($loans, "Successfully retrieved loans");
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
    public function store(StoreLoanRequest $request)
    {
        $loan = new BookLoan();
        $loan->fill($request->all());
        $loan->save();
        return $this->success($loan,"Loan Stored Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $req, string $id)
    {
        $loan = BookLoan::query()->where("id", $id)->first();
        if(empty($loan)) abort(404, "Loan not found");
        if($loan->user_id != $req->user()->id) {
            $msg = "Not authorized to access this resource";
            return $this->error(null, $msg, 401);
        }
        return $this->success($loan);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $req)
    {
        $loan = BookLoan::find($id);
        if(empty($loan)) abort(404, "Loan not found");

        if($loan->user_id != $req->user()->id) abort(401, "Not authorized to delete this resource");

        $loan->delete();
        return $this->success($loan,"Loan deleted successfully.");
    }
}
