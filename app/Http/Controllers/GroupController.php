<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Link;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    protected $linkController;
    public function __construct(LinkController $linkController)
    {
        $this->linkController = $linkController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:groups'
        ]);
        $group = Group::create($request->all());
        return redirect()->route('group.show', ['group' => $group->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $links = $this->linkController->replaceVariables(
            Link::where('id_group', '=', $group->id)->orderBy('name', 'asc')->get()
        );
        return view('group.show', compact('links', 'group'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function showPublic(Group $group)
    {
        $links = $this->linkController->replaceVariables(
            Link::where('id_group', '=', $group->id)
                ->where('public', '=', "1")
                ->orderBy('name', 'asc')
                ->get()
        );
        $public = true;
        return view('public.group', compact('links', 'group', 'public'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|unique:groups'
        ]);
        $group->update($request->all());
        return redirect()->route('group.show',['group' => $group->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect('/');
    }
}
