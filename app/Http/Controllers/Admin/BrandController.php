<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\BrandService;
use App\Models\Brand;
use Session;

class BrandController extends Controller
{

    protected $brandService;

    // Inject AdminService using Constructor
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page', 'brands');
        $result = $this->brandService->brands();
        if($result['status'] == "error") {
            return redirect('admin/dashboard')->with('error_message', $result['message']);
        }

        return view('admin.brands.index', [
            'brands' => $result['brands'],
            'brandsModule' => $result['brandsModule']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Brand';
        return view('admin.brands.add_edit_brand', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = $this->brandService->addEditBrand($request);
        return redirect()->route('brands.index')->with('success_message', $message);
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
    public function edit(string $id)
    {
        $title = 'Edit Brand';
        $brand = Brand::findOrFail($id);
        // $getCategories = Category::getCategories('Admin');
        return view('admin.brands.add_edit_brand', compact('title', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge(['id' => $id]);
        $message = $this->brandService->addEditBrand($request);
        return redirect()->route('brands.index')->with('success_message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result= $this->brandService->deleteBrand($id);
        return redirect()->back()->with('success_message', $result['message']);
    }

    public function updateBrandStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = $this->brandService->updateBrandStatus($data);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }
}
