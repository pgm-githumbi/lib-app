<?php

namespace App\Http\Controllers;

use App\Traits\AuthorizationNames;
use App\Traits\Tables;
use App\Models\BookLoan;
use App\Models\Extension;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Traits\ResourceValidator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PostExtensionRequest;

class ExtensionController extends Controller
{
    use ResourceValidator, HttpResponses, Tables, AuthorizationNames;
    /**
     * Display a listing of the resource.
     */
    public function index(string $loan_id, Request $req)
    {
        $this->validateModelExists(BookLoan::class, $loan_id);
        $loan = BookLoan::findOrFail($loan_id);
        Gate::authorize($this->permNames['get-loan'], $loan);
        $ext = BookLoan::with('extensions')->find($loan_id)->extensions;
        return $this->success($ext, "Extensions retrieved");
        
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
    public function store(PostExtensionRequest $request, string $loan_id)
    {
        $this->validateModelExists(BookLoan::class, $loan_id);
        Gate::authorize($this->permNamesSpatie['post-loan'], BookLoan::class);
        $ext = new Extension();
        $ext->fill($request->all());
        $ext->book_loan_id = $loan_id;
        $ext->save();
        return $this->success($ext, "Resource created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $loan_id, string $id)
    {
        $this->validateModelExists(BookLoan::class, $loan_id);
        $this->validateModelExists(Extension::class, $id);
        $loan = BookLoan::findOrFail($loan_id);
        Gate::authorize($this->permNames['get-loan'], $loan);
        $ext = Extension::find($id);
        return $this->success($ext, "Resource retrieved successfully");
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
    public function update(PostExtensionRequest $req, string $loan_id, string $ext_id)
    {
        $this->validateModelExistsWith(Extension::class, $ext_id, 
                $this->extensionsLoan, $loan_id);

        $loan = BookLoan::findOrFail($loan_id);
        Gate::authorize($this->permNames['put-loan'], $loan);
        $ext = Extension::find($ext_id);
        if($req->filled($this->extensionsLoan)){
            if($ext->{$this->extensionsLoan} != $req->input($this->extensionsLoan)){
                abort(400, "Cannot modify extensions loan. Make a new extension instead.");
            }
        }
        $ext->fill($req->all());
        $ext->save();
        return $this->success($ext,"Extension modified successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $loan_id, string $ext_id)
    {
        $this->validateModelExists(Extension::class, $ext_id);
        $this->validateModelExistsWith(Extension::class, $ext_id, 
                $this->extensionsLoan, $loan_id);

        $loan = BookLoan::findOrFail($loan_id);
        Gate::authorize($this->permNames['remove-loan'], $loan);
        $ext = Extension::find($ext_id);
        $ext->delete();
        return $this->success($ext, "Extension deleted successfully");
    }
}
