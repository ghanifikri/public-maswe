<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AttributeValue;
use App\Http\Requests\StoreAttributeValueRequest;
use App\Http\Requests\UpdateAttributeValueRequest;
use App\Models\admin\Attribute;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attributeValues = AttributeValue::where('attribute_id', $id)->get();
        return view('admin.ProductPage.attribute.attributeValue.index', compact('attribute','attributeValues'));
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
     * @param  \App\Http\Requests\StoreAttributeValueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttributeValueRequest $request)
    {
        AttributeValue::create([
            'attribute_id' => $request->attribute_id,
            'value' => $request->value
        ]);

        return redirect()->route('attributeValue.index',$request->attribute_id)->with(['success' => 'databerhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeValue $attributeValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeValue $attributeValue)
    {
        $attribute = Attribute::where('id', $attributeValue->attribute_id)->first();
        $attributeValues = AttributeValue::where('attribute_id', $attributeValue->attribute_id)->get();
        return view('admin.ProductPage.attribute.attributeValue.index', compact('attributeValue','attribute','attributeValues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttributeValueRequest  $request
     * @param  \App\Models\admin\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttributeValueRequest $request, AttributeValue $attributeValue)
    {
        $attributeValue->update([
            'value' => $request->value
        ]);

        return redirect()->route('attributeValue.index',$attributeValue->attribute_id)->with(['success' => 'data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeValue $attributeValue)
    {
        //
    }
}
