<?php

namespace App\Http\Controllers;

use App\Traits\Tables;
use App\Models\Penalty;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Filters\PenaltyFilter;
use App\Traits\AuthorizationNames;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePenaltyRequest;

class PenaltyShortController extends Controller
{
    use HttpResponses, Tables, AuthorizationNames;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req, PenaltyFilter $filter)
    {
        Gate::authorize($this->permNames['get-penalties'], Penalty::class);
        $pen = Penalty::query();
        $filter_data = [$this->penaltiesUser() => $req->user()->id,];
        $pen->filter($filter, $filter_data)->get();
        return $this->success($pen, "Penalties retrieved successfully");
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
    public function store(StorePenaltyRequest $req)
    {
        $pen = new Penalty();
        $pen->fill($req->validated());
        $loan_col = $this->penaltiesLoan;
        $pen->{$loan_col} = $req->{$loan_col};
        Gate::authorize($this->permNames['post-penalty'], $pen);
        $pen->save();

        return $this->success($pen, "successfully posted penalty");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pen = Penalty::findOrFail($id);
        Gate::authorize($this->permNames['get-penalty'], $pen);
        return $this->success($pen, "successfully retrieved penalty");
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
    public function update(StorePenaltyRequest $req, string $id)
    {
        $pen = Penalty::findOrFail($id);
        $pen->fill($req->validated());
        $loan_col = $this->penaltiesLoan;
        $pen->{$loan_col} = $req->{$loan_col};
        Gate::authorize($this->permNames['put-penalty'], $pen);
        $pen->update();
        return $this->success($pen, "Penalty updated");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pen = Penalty::findOrFail($id);
        Gate::authorize($this->permNames['remove-penalty'], $pen);
        $pen->delete();
        return $this->success($pen, "Penalty deleted");
    }
}
