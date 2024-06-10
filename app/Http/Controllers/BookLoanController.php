<?php

namespace App\Http\Controllers;

use App\Traits\Tables;
use App\Models\BookLoan;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Filters\BookLoanFilter;
use App\Traits\AuthorizationNames;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreLoanRequest;

class BookLoanController extends Controller
{
    use HttpResponses, Tables, AuthorizationNames;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req, BookLoanFilter $filter)
    {
        Gate::authorize($this->permNames['get-loans']);
        $loans = BookLoan::query()->where($this->loanUser, Auth::user()->id)->filter($filter)->get();
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
        // Gate::authorize($this->permNames['post-loan'], BookLoan::class);
        $this->authorize('create', BookLoan::class);
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
        $this->authorize('view', $loan);
        // Gate::authorize($this->permNames['get-loan'], $loan);
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
    public function update(StoreLoanRequest $req, string $id)
    {
        $loan = BookLoan::findOrFail($id);
        Gate::authorize($this->permNames['put-loan'], $loan);
        $loan->fill($req->validated());
        $loan->save();
        return $this->success($loan, "Loan updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $req)
    {
        $loan = BookLoan::findOrFail($id);
        Gate::authorize($this->permNames['remove-loan'], $loan);
        $loan->delete();

        return $this->success($loan,"Loan deleted successfully.");
    }
}
