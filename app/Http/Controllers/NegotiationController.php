<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorenegotiationRequest;
use App\Http\Requests\UpdatenegotiationRequest;
use App\Models\negotiation;

class NegotiationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $negotiations = negotiation::all();
        // dd($negotiation);
        return view('dashboard.negotiation.index' , compact(negotiations));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorenegotiationRequest $request)
    {
        //
        return view('dashboard.negotiation_create');
    }

    /**
     * Display the specified resource.
     */
    public function show(negotiation $negotiation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(negotiation $negotiation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatenegotiationRequest $request, negotiation $negotiation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(negotiation $negotiation)
    {
        //
    }
}
