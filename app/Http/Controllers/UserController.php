<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserFilter $filter)
    {
        $user = $request->user();
        if($user->can('viewEvery', $user))
            return $this->success(User::query()->filter($filter)->get());
        if($user->can('viewThemselves', $user))
            return $this->success($user);
        return $this->authorize('viewEvery', $user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return abort(404, 'Method not supported');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return abort(404, 'Method not supported');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if($user->can('viewAny', $user)) return $user;
        if($user->can('viewThemselves', $user))
            return $user;
        return $this->authorize('viewThemselves', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return abort(404, 'Method not supported');
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        return abort(404, 'Method not supported');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return abort(404, 'Method not supported');
    }
}
