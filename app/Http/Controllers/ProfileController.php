<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash};

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('users.edit', ['user' => auth()->user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        if ($request->hasFile('image')) {
            $user->image_file = $request->file('image');
        }

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return back();
    }
}
