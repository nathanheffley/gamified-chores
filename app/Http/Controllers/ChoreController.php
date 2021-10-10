<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use Illuminate\Http\Request;

class ChoreController extends Controller
{
    public function index()
    {
        return view('chores.index', [
            'chores' => Chore::all(),
        ]);
    }

    public function create()
    {
        return view('chores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'points' => 'required|integer',
            'photo' => 'required|image',
        ]);

        Chore::query()->create([
            'title' => $validated['title'],
            'points' => $validated['points'],
            'photo' => $validated['photo']->store('chores', 'public'),
        ]);

        return redirect('chores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chore  $chore
     * @return \Illuminate\Http\Response
     */
    public function show(Chore $chore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chore  $chore
     * @return \Illuminate\Http\Response
     */
    public function edit(Chore $chore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chore  $chore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chore $chore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chore  $chore
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chore $chore)
    {
        //
    }
}
