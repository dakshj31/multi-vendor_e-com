<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FilterRequest;
use App\Services\Admin\FilterService;
use App\Models\Filter;
use App\Models\Category;

class FilterController extends Controller
{

    protected $filterService;

    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = $this->filterService->getAll();
        $title = "Filters";
        return view('admin.filters.index', compact('filters','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with('subcategories')->where('parent_id', null)->get();
        $title = "Add Filter";
        return view('admin.filters.add_edit_filter', compact('categories','title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilterRequest $request)
    {
        $this->filterService->store($request->validated());
        return redirect()->route('filters.index')->with('success_message', 'Filter added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $filter = Filter::with('categories')->findOrFail($id);

        $categories = Category::with('subcategories')->where('parent_id', null)->where('status', 1)->get();

        $selectedCategories = $filter->categories->pluck('id')->toArray();

        return view('admin.filters.add_edit_filter', [
            'title' => 'Edit Filter',
            'filter' => $filter,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FilterRequest $request, $id)
    {
        $this->filterService->update($id, $request->validated());
        return redirect()-route('filters.index')->with('success_message', 'Filter updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->filterService->delete($id);
        return redirect()->route('filters.index')->with('success_message', 'Filter deleted successfully');
    }

    public function updateFilterStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            $status = $this->filterService->updateFilterStatus($data);
            return response()->json(['status' => $status, 'filter_id' => $data['filter_id']]);
        }
    }
}
