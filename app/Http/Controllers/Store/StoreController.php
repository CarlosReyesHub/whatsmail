<?php

namespace App\Http\Controllers\Store;

use App\Exports\StoreExport;
use App\Http\Controllers\Controller;
use App\Imports\Store\StoreImport;
use App\Models\Master\Category;
use App\Models\Store\Store;
use App\Observers\Master\CategoryObserver;
use App\Observers\Master\DirectoryObserver;
use App\Observers\Store\StoreObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{



    /*
    |--------------------------------------------------------------------------
    | Store or Customer Data
    |--------------------------------------------------------------------------
    */

    protected $storeObserver;
    protected $directoryObserver;
    protected $categoryObserver;

    public function __construct(StoreObserver $storeObserver, DirectoryObserver $directoryObserver, CategoryObserver $categoryObserver)
    {
        $this->storeObserver        = $storeObserver;
        $this->directoryObserver    = $directoryObserver;
        $this->categoryObserver     = $categoryObserver;
    }

    /*
    |--------------------------------------------------------------------------
    | 1. Stores List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {

        $queryArray     = $request->all();
        $params         = http_build_query($queryArray);

        if ($request->ajax()) {

            $stores         = $this->storeObserver->getData($request);

            return DataTables::of($stores)
                ->addColumn('province', function ($row) {
                    $province   = $row->district->city->province->name ?? '';
                    $provinceID = $row->district->city->province_id ?? '';
                    $html = '<a href="' . route('directory.cities') . '?province=' . $provinceID . '" class="text-info">' . $province . '</a>';
                    return $html;
                })->addColumn('city', function ($row) {
                    $cityType = $row->district->city->type ?? '';
                    $cityName = $row->district->city->name ?? '';
                    $html = '<a href="' . route('directory.districts') . '?city=' . ($row->district->city_id ?? '') . '" class="text-info">' . $cityType . ' ' . $cityName . '</a>';
                    return $html;
                })->addColumn('category', function ($row) {
                    $html = '<a class="text-info" href="' . route('stores') . '?category=' . $row->category_id . '"> ' . ($row->category->name ?? '') . ' </a>';
                    return $html;
                })->addColumn('district', function ($row) {
                    $html = '<a class="text-info" href="' . route('stores') . '?district=' . $row->district_id . '"> ' . ($row->district->name ?? '') . ' </a>';
                    return $html;
                })->addColumn('action', function ($row) {
                    $html = '<a href="' . route('stores.update', $row->id) . '" class="btn btn-outline-warning btn-icon fs-16 ">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <a href="' . route('stores.delete', $row->id) . '" class="btn btn-outline-danger btn-icon fs-16 deletebutton">
                                <i class="bx bx-trash "></i>
                            </a>';

                    return $html;
                })->addColumn('status_attribute', function ($row) {
                    $status = $row->status == 'yes' ? __('general.no_active') : __('general.active');
                    return $status;
                })->rawColumns(['province',  'city', 'category', 'district', 'status_attribute', 'action'])
                ->make(true);
        }

        return view('stores.index', ['page'  => __("page.contact.page"), 'breadcumb' => true], compact('params'));
    }

    /*
    |--------------------------------------------------------------------------
    | 2. Create Page
    |--------------------------------------------------------------------------
    */

    public function create(Request $request)
    {
        $categories     = $this->categoryObserver->getData($request)->get(['id', 'name']);
        $provinces      = $this->directoryObserver->getProvince($request)->get(['id', 'name']);
        return view('stores.create', ['page' => __('page.contact.add'), 'breadcumb' => true], compact('categories', 'provinces'));
    }

    /*
    |--------------------------------------------------------------------------
    | 3. Update Page
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Store $store)
    {
        $categories     = $this->categoryObserver->getData($request)->get(['id', 'name']);
        $provinces      = $this->directoryObserver->getProvince($request)->get(['id', 'name']);
        return view('stores.update', ['page' => __('page.contact.edit'), 'breadcumb' => true], compact('categories', 'provinces', 'store'));
    }

    /*
    |--------------------------------------------------------------------------
    | 4. Create Data
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $this->validate($request, [
            'category'      => 'required',
            'name'          => 'required',
            'pemilik'       => 'nullable',
        ]);

        $this->storeObserver->createData($request);

        return redirect()->route('stores')->with(['flash'    => __('general.success_add_data')]);
    }

    /*
    |--------------------------------------------------------------------------
    | 5. Update Data
    |--------------------------------------------------------------------------
    */

    public function edit(Request $request, Store $store)
    {
        $this->validate($request, [
            'category'      => 'required',
            'name'          => 'required',
            'pemilik'       => 'nullable',
        ]);

        $this->storeObserver->updateData($request, $store);

        return redirect()->route('stores')->with(['flash'    => __('general.success_update')]);
    }


    /*
    |--------------------------------------------------------------------------
    | 6. Delete Data
    |--------------------------------------------------------------------------
    */

    public function delete(Store $store)
    {
        $this->storeObserver->deleteData($store);

        return redirect()->back()->with(['flash'    => __('general.success_deleted')]);
    }

    /*
    |--------------------------------------------------------------------------
    | 7. Import Data
    |--------------------------------------------------------------------------
    */

    public function import(Request $request)
    {
        $this->validate($request, [
            'file'  => 'mimes:xlsx'
        ]);

        if ($request->file) {

            $import = Excel::toArray(new StoreImport(), $request->file('file'));

            if (count($import[0]) > 0) {


                try {

                    DB::beginTransaction();

                    foreach ($import[0] as $d) {
                        if ($d['name'] != null) {
                            $category = Category::firstOrCreate(
                                [
                                    'name' => strtoupper($d['category']),
                                ]
                            );

                            $existingStore = Store::where('name', $d['name'])
                                ->where('phone', $d['phone'] ?? null)
                                ->first();

                            if (!$existingStore) {
                                Store::create([
                                    'category_id'           => $category->id,
                                    'district_id'           => $d['district'],
                                    'name'                  => $d['name'],
                                    'phone'                 => !empty($d['phone']) ? $d['phone'] : null,
                                    'email'                 => !empty($d['email']) ? $d['email'] : null,
                                    'address'               => $d['address'],
                                    'pemilik'               => !empty($d['pemilik']) ? $d['pemilik'] : null,
                                ]);
                            }
                        }
                    }

                    DB::commit();

                    return redirect()->back()->with(['flash'    => __('general.success_import')]);
                } catch (\Exception $e) {

                    DB::rollBack();

                    return redirect()->back()->with(['gagal'    => $e->getMessage()]);
                }
            } else {
                return redirect()->back()->with(['gagal'    => __('general.file_not_reader')]);
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | 8. Export Data
    |--------------------------------------------------------------------------
    */

    public function export(Request $request)
    {
        return (new StoreExport($request, $this->storeObserver))->download('customer_or_store_reports-' . date('Y-m-d') . '.xlsx');
    }
}
