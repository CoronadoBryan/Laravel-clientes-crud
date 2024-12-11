<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Clients;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Clients::where('user_id',Auth::user()->id)->get();

        return Inertia::render('Clients/Index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Clients/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->except('avatar');

        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $routeName = $file->store('avatars',['disk'=>'public']);
            $data['avatar'] = $routeName;
        }
        $data['user_id'] = Auth::user()->id;

        Clients::create($data);

        return to_route('client.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clients $clients)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clients $client)
    {

        return Inertia::render('Clients/Edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Clients $client)
    {
        $data = $request->except('avatar');
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $routeName = $file->store('avatars',['disk'=>'public']);
            $data['avatar'] = $routeName;

            if($client->avatar){
                Storage::disk('public')->delete($client->avatar);
            }
        }

        $client->update($data);

        return to_route('client.edit',$client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clients $client)
    {
        if($client->avatar){
            Storage::disk('public')->delete($client->avatar);
        }
        $client->delete();
        return to_route('client.index');
    }
}
