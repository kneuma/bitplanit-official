<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Auth;
use App\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/profile.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'location' => 'required',
        ]);

        $data = Profile::create([
            'username' => $request->username,
            'birthday' => $request->birthday,
            'location' => $request->location,
            'occupation' => $request->occupation,
            'website' => $request->website,
            'bio' => $request->bio
        ]);

        return redirect('/profile/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id=null)
    {
        // if no ID passed, set ID to logged in user
        if(is_null($id)) $id = auth()->user()->id;
        $user = User::find($id);

        return view('profile', compact ('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update($id, request $request, user $user)
    {
        $user = User::find($id);
        $user->update([
            'username' => $request->username,
            'birthday' => $request->birthday,
            'location' => $request->location,
            'occupation' => $request->occupation,
            'website' => $request->website,
            'bio' => $request->bio
        ]);

        $user->save();

        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
