<?php

namespace App\Http\Controllers;

use App\Traits\AuthorizationNames;
use Exception;
use App\Models\Book;
use App\Models\User;
use App\Models\BookLoan;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\PostBookRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BooksController extends Controller{
    use HttpResponses, AuthorizationNames;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Gate::authorize($this->permNames['get-books']);

        $page = $request->query('page', 1);
        $perPage = $request->query('perPage', 10);
        $count = $request->query('count');

        $bookQuery = Book::with('category');
        $options = new QueryOptions($request, $bookQuery);
        $bookQuery = $options->query();

        
        $result = $bookQuery->paginate($perPage, ['*'], 'page', $page);
        
        

        return $this->success($result);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->success($request->body);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(PostBookRequest $request)
    {
        Gate::authorize($this->permNames['post-book']);
        $request->validated($request->all());

        $book = new Book();
        $book->category_id = $request->category_id;
        $book->fill($request->all());
        $book->save();
        return $this->success(Book::find($book->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $req, string $id)
    {
        
        if(!Book::where('id', $id)->exists()){
            return $this->error('Book Not Found', null, 404);
        }
        
        $book = Book::find($id);
        
        //$this->authorize($this->permissionNames['create-book'], $book);
        
        return $this->success($book);
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
    public function update(PostBookRequest $request, string $id)
    {
        $request->validated($request->all());
        if(!Book::where('id', $id)->exists()){
            return $this->error('Book with id ' . $id . ' does not exist',
             null, 404);
        }
        $book = Book::find($id);
        $book->update($request->all());
        if($request->category_id){
            $book->category_id = $request->category_id;
        }
        $book->save();
        return $this->success(Book::find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);
        if(!$book){
            return $this->error('Book not found', null,404);
        }
        $book->delete();
        return $this->success($book);
    }
}

class QueryOptions{
    
    private $query;
    private $request;
    public function __construct(Request $request, $query) {
        $this->query = $query;
        $this->request = $request;
    }

    public function query(){
        $this->category();
        $this->publisher();
        $this->sortBy();
        $this->sortOrder();
        return $this->query;
    }
    public function category(){
        if ($this->request->category_id){
            $this->query->where('category_id', $this->request->get('category_id'));
        }
        return $this;
    }
    public function publisher(){
        if($this->request->publisher){
            $this->query->where('publisher',$this->request->get('publisher'));
        }
        return $this;
    }
    public function sortBy() {
        $sortOptions = $this->request->input('sortBy', false);
        if($sortOptions){
            $this->query->sortBy($sortOptions);
        }
        return $this;
    }

    public function sortOrder(){
        $sortOrder = $this->request->input('sortOrder', false);
        if($sortOrder && in_array($sortOrder, ['asc','desc'])){
            $this->query->orderBy($sortOrder);
        }
        return $this;
    }

}
