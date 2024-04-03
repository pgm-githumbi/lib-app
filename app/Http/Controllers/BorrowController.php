<?php

namespace App\Http\Controllers;

use App\Filters\BorrowFilter;
use App\Models\Borrow;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBorrowRequest;
use App\Http\Requests\UpdateBorrowRequest;
use App\Models\Book;
use App\Traits\AuthorizationNames;
use App\Traits\HttpResponses;
use App\Traits\Tables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    use HttpResponses, AuthorizationNames, Tables;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, BorrowFilter $filter)
    {
        
        $this->authorize('viewAny', Borrow::class);
        $perPage = $request->query('per_page', 10);
        if ($request->user()->can('viewEvery', Borrow::class)){
            $borrowEvery = Borrow::query()->filter($filter)->paginate($perPage);
            return $this->success($borrowEvery);
        }
        $borrows = Borrow::query()->where('user_id', $request->user()->id)->filter($filter)->paginate($perPage);
        return $this->success($borrows);
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
    public function store(StoreBorrowRequest $request)
    {

        Gate::authorize($this->permNames['post-borrow']);
        //Check if book is available
        $book =  Book::findOrFail($request->get($this->borrowBook));
        if ($book->available < 1)
            return $this->error([], "The book specified is currently unavailable", 422);

        // Check if the borrow request is unique
        if (Borrow::where($this->borrowBook, $request->get($this->borrowBook))
                ->where($this->borrowUser, $request->get($this->borrowUser))
                ->get()->count() > 0)
                return $this->error([], "Duplicate borrow request. Wait for the first one to be approved.", 422);

        $borrow = new Borrow();
        $borrow->user_id = (int)$request->get($this->borrowUser);
        $borrow->book_id = (int)$request->get($this->borrowBook);
        $borrow->save();
        return $this->success(['borrow' => $borrow]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Borrow $borrow,)
    {
        Gate::authorize($this->permNames['get-borrow'], $borrow);
        return $this->success(['borrow' => $borrow]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrow $borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowRequest $request, Borrow $borrow)
    {
        Gate::authorize($this->permNames['put-borrow'], $borrow);
        //Check if the new book is available
        //Check if book is available
        $book =  Book::findOrFail($request->get($this->borrowBook));
        if ($book->available < 1)
            return $this->error([], "The book specified is currently unavailable", 422);

        // Check if the borrow request is unique
        if (Borrow::where($this->borrowBook, $request->get($this->borrowBook))
                ->where($this->borrowUser, $request->get($this->borrowUser))
                ->get()->count() > 1)
                return $this->error([], "Duplicate borrow request. Wait for the first one to be approved.", 422);


        $borrow->book_id = $request->book_id;
        $borrow->update();
        return $this->success($borrow, "Borrow updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        // Gate::authorize($this->permNames['delete-borrow'], $borrow);
        $this->authorize('delete', $borrow);
        $borrow->delete();
        return $this->success(["borrow" => $borrow], "Borrow deleted successfully.");
    }
}
