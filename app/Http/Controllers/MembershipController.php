<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = Membership::with("user")->get();
        return view("admin.membership.index", compact("memberships"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view("admin.membership.create", compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $member = new Membership();
        $member->user_id = $request->input('user');
        $member->save();
        return redirect()->route("admin.membership.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        $users = User::all();
        return view("admin.membership.edit", compact("membership", "users"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membership $membership)
    {
        $membership->user_id = $request->input('user');
        $membership->point = $request->input('point');
        $membership->save();
        return redirect()->route("admin.membership.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        $membership->delete();
        return redirect()->route("admin.membership.index");
    }
    
    public function indexAdmin(){
        $memberships = Membership::with("user")->get();
        return view("admin.membership.index", compact("memberships"));
    }
}
