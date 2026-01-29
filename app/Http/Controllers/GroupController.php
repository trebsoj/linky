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
    public function show(Group $group, Request $request)
    {
        $linksQuery = Link::where('id_group', '=', $group->id);

        if ($request->has('search') && !empty($request->search)) {
            $linksQuery->where('name', 'like', '%' . $request->search . '%');
        }

        $links = $this->linkController->replaceVariables(
            $linksQuery->orderByRaw('LOWER(name) ASC')->get()
        );
        return view('group.show', compact('links', 'group') + ['search' => $request->search]);
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
                ->orderByRaw('LOWER(name) ASC')
                ->get()
        );
        $public = true;
        return view('public.group', compact('links', 'group', 'public'));
    }

    /**
     * Redirect to a random link within the group.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function random(Group $group)
    {
        if (!$group->enable_random) {
            abort('404');
        }

        $links = Link::where('id_group', $group->id)->get();

        if ($links->isEmpty()) {
            return back()->with('error', 'This group has no links.');
        }

        $randomLink = $links->random();

        // Replace variables in href using LinkController's method
        $processedLinks = $this->linkController->replaceVariables(collect([$randomLink]));
        $href = $processedLinks->first()->href;

        return redirect($href);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $hostname = url('/');
        return view('group.edit', compact('group', 'hostname'));
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
            'name' => 'required|unique:groups,name,' . $group->id
        ]);
        $data = $request->all();
        $data['enable_random'] = $request->has('enable_random') ? 1 : 0;

        $group->update($data);
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
