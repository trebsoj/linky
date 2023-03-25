<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\RedirectLog;
use App\Models\Variable;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Groups;
use Carbon\Carbon;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('link.index', [
            'links' => $this->replaceVariables(
                Link::with('group')
                    ->get()
                    ->sortBy(function ($link) {
                        return strtoupper("#{$link->group->name}#{$link->name}#");
                    })
                    ->values()
                    ->all()
            )
        ]);
    }

    public function indexPublic()
    {
        return view('public.index', [
            'links' => $this->replaceVariables(
                Link::with('group')
                    ->where('public','=', '1')
                    ->get()
                    ->sortBy(function ($link) {
                        return strtoupper("#{$link->group->name}#{$link->name}#");
                    })
                    ->values()
                    ->all()
            ), 'public'=> true
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'href' => 'required',
            'id_group' => 'required',
        ]);
//        return $request->all();
        Link::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        $hostname = url('/');

        $logs = RedirectLog::
            where('id_link','=', $link->id)
            ->get()
            ->sortByDesc('created_at')
        ;
        $logsLast24h = RedirectLog::
            where('id_link','=', $link->id)
            ->where('created_at', '>=', Carbon::parse( Carbon::now()->addDay(-1)))
            ->count()
        ;

        return view('link.edit', compact('link', 'hostname', 'logs', 'logsLast24h'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        $request['public'] = $request->input("public") ? $request['public'] : "0";
        $request->validate([
            'name' => 'required',
            'href' => 'required',
            'public' => 'required',
        ]);
        $link->update($request->all());
        return redirect()->route('group.show', ['group' => $link->id_group]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return $this->return();
    }

    public function return(){
        return back();
    }

    public function replaceVariables($links){
        $variables = Variable::orderByRaw('LENGTH(`key`) desc, `key`')->get();
        foreach ($links as $l) {
            foreach ($variables as $v) {
                $l->href = str_replace($v->key, $v->value, $l->href);
            }
        }
        return $links;
    }
    private function sort($a,$b){
        return strlen($b)-strlen($a);
    }

    public function redirect(string $code)
    {
        $links = $this->replaceVariables(
            Link::where('code','=', $code)
                ->get()
        );

        if(count($links) > 0) {

            $log = new RedirectLog;
            $log->id_link = $links[0]->id;
            $log->ip = request()->getClientIp();
            $log->save();

            return redirect($links[0]->href);
        } else {
            return abort('404');
        }
    }


}
