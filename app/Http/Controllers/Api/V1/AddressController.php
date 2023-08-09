<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Address::query();

        $perPage = $request->input('per_page', 10);
        
        if ($request->has('cep')) {
            $query->where('postal_code', $request->input('cep'));
        }

        if ($request->has('logradouro')) {
            $query->where('street', 'LIKE', '%' . $request->input('logradouro') . '%');
        }

        $address  = $query->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'message' => 'Operation successfully performed',
            'address' => $address
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        Address::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Operation successfully performed',
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Operation successfully performed',
            'address' => AddressResource::make($address)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $address->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Operation successfully performed',
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Operation successfully performed',
        ]); 
    }
}
