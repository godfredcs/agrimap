<?php

namespace App\Http\Controllers;

use App\Models\DosageForm;
use App\Models\Classification;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dosage_forms = DosageForm::orderBy('name', 'ASC')->get();
        $classifications = Classification::orderBy('name', 'ASC')->get();

        if ($request->ajax() && $request->has('rel')) {
            switch ($request->rel) {
                case 'dosage_forms':
                    $items = $dosage_forms;
                    $rel   = 'dosage_forms';
                break;
                
                default:
                    $items = $classifications;
                    $rel   = 'classifications';
                break;
            }

            return view('settings.table', compact('items', 'rel'));
        }

        return view('settings.index', compact('dosage_forms', 'classifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        $item;

        if ($request->rel == 'dosage_forms') {
            $item = new DosageForm();
        } else {
            $item = new Classification();
        }

        $item->name = $request->name;
        $item->save();

        return json_encode(['message' => 'Item has been added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $item;

        if ($request->rel == 'dosage_forms') {
            $item = DosageForm::find($id);
        } else {
            $item = Classification::find($id);
        }

        if (is_null($item)) {
            return response()->json(['errors' => ['There is no item with such ID.']], 404);
        }

        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required']);

        $item;

        if ($request->rel == 'dosage_forms') {
            $item = DosageForm::find($id);
        } else {
            $item = Classification::find($id);
        }

        if (is_null($item)) {
            return response()->json(['errors' => ['There is no item with such ID.']], 404);
        }

        $item->update($request->all());

        return json_encode(['message' => 'Item has been updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $item;

        if ($request->rel == 'dosage_forms') {
            $item = DosageForm::find($id);
        } else {
            $item = Classification::find($id);
        }

        if (is_null($item)) {
            return response()->json(['errors' => ['There is no item with such ID.']], 404);
        }

        if (!$item->products->isEmpty()) {
            return response()->json(['errors' => ['Deletion failed because there are products using this item.']], 404);
        }

        $item->delete();

        return json_encode(['message' => 'Item has been updated successfully.']);
    }
}
