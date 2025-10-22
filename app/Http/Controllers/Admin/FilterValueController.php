<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FilterValueRequest;
use App\Services\Admin\FilterValueService;
use App\Models\Filter;

class FilterValueController extends Controller
{

    protected $filterValueService;

    public function __construct(FilterValueService $filterValueService)
    {
        $this->filterValueService = $filterValueService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($filterId)
    {
        $filter = Filter::findOrFail($filterId);
        $filterValue = $this->filterValueService->getAll($filterId);

        return view('admin.filter_values.index', compact('filter', 'filterValues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($filterId)
    {
        $filter = Filter::findOrFail($filterId);
        $title = "Add Filter Value";

        return view('admin.filter_values.add_edit_filter_value', compact('title', 'filter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilterValueRequest $request, $filterId)
    {
        $filter = Filter::findOrFail($filterId);

        $this->filterValueService->store($request->validated(), $filterId);

        return redirect()->route('filter-values.index', $filter->id)->with('success_message', 'Filter Value added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($filterId, $id)
    {
        $filter = Filter::findOrFail($filterId);
        $filterValue = $this->filterValueService->find($filterId, $id);
        $title = "Edit Filter Value";

        return view('admin.filter_values.add_edit_filter_value', compact('title', 'filter', 'filterValue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FilterValueRequest $request, $filterId, $id)
    {
        $filter = Filter::findOrFail($filterId);
        
        $this->filterValueService->update($filterId, $id, $request->validated());

        return redirect()->route('filter-values.index', $filter->id)->with('success_message', 'Filter value updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($filterId, $id)
    {
        $this->filterValueService->delete($filterId, $id);
        
        return redirect()->route('filter-values.index', $filterId)->with('success_message', 'Filter value deleted successfully!');
    }
}
