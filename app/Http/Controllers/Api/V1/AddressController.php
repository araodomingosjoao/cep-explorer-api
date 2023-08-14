<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Services\AddressService;
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
        if ($request->has('cep') || $request->has('logradouro')) {
            $filteredAddresses = $this->filter(Address::query(), $request);

            if ($filteredAddresses->count() > 0) {
                return response()->json($filteredAddresses);
            }

            $cep = AddressService::findAndSaveCEP($request->input('cep'));
            if (!empty($cep)) {
                $cep = Address::find($cep->id)->paginate(10);
                return response()->json($cep);
            }

            return response()->json($filteredAddresses);
        }

        $allAddresses = Address::paginate($request->input('per_page', 10));
        return response()->json($allAddresses);
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
