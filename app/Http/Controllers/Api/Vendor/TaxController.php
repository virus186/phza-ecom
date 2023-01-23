<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateTaxRequest;
use App\Http\Requests\Validations\UpdateTaxRequest;
use App\Repositories\Tax\TaxRepository;
use App\Http\Resources\TaxResource;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    private $tax;

    /**
     * constructor call
     */
    public function __construct(TaxRepository $tax)
    {
        parent::__construct();
        $this->tax = $tax;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter');

        if ($filter == 'trash') {
            $taxes = $this->tax->trashOnly();
        } else {
            $taxes = $this->tax->all();
        }
        return TaxResource::collection($taxes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaxRequest $request)
    {
        // Need Permission cheek

        try {
            $this->tax->store($request);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.tax_created_successfully')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TaxResource($this->tax->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxRequest $request, $id)
    {
        // Need permission check

        try {
            $this->tax->update($request, $id);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.tax_updated_successfully')]);
    }

    /**
     * move to trash
     */
    public function trash($id)
    {
        try {
            $this->tax->trash($id);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.tax_trashed_successfully')]);
    }

    /**
     * restore trash data
     */
    public function restore($id)
    {
        try {
            $this->tax->restore($id);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.tax_restored_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->tax->destroy($id);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.tax_deleted_successfully')]);
    }
}
