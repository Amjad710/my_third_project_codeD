<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Notifications\IdeaPublished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $ideas = Idea::query()->where([
        'user_id'=>Auth::id(),
    ])->get(); 
    //$ideas = Auth::user()->ideas(); 

    return view('ideas.index',['ideas'=>$ideas]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description'=> ['required','min:10'],
        ]);
        $Idea =Idea::create([
        'description'=> request('description'),
        'state'=> 'pending',
        'user_id'=>Auth::id(),
    ]);
    Auth :: user() ->notify(new IdeaPublished($Idea));
    return redirect('/ideas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        Gate :: authorize('update' , $idea);
        //Auth :: user()-> can('update',$idea);
        return view('ideas.show',['idea'=>$idea]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        Gate :: authorize('update' , $idea);
        return view('ideas.edit',['idea'=>$idea]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Idea $idea)
    {
        Gate :: authorize('update' , $idea);
        $request->validate([
            'description'=> ['required','min:10'],
        ]);
        
        $idea->update([
        'description'=> request('description'),
    ]);
    return view('ideas.show',['idea'=>$idea]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
    $idea->delete();
    return redirect('/ideas');
    }
}
