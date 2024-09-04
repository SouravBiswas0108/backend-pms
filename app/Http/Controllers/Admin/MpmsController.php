<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kra;
use App\Models\Mpms;
use App\Models\Obj;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MpmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session()->has('year2')) {
            $year = session('year2');
            //dd($year);
        } else {
            $year = date('Y');
        }
        $user = Auth::user();

        $data1_new = Mpms::with(['kras.objs'])->where('id', '1')->get()->toArray();
        $data2_new = Mpms::with(['kras.objs'])->where('id', '2')->get()->toArray();
        $data3_new = Mpms::with(['kras.objs'])->where('id', '3')->get()->toArray();

        $data1 = collect($data1_new)->map(function ($item) {
            return collect($item['kras'])->flatMap(function ($kra) use ($item) {
                return collect($kra['objs'])->map(function ($obj) use ($item, $kra) {
                    return [
                        'id' => $obj['id'],
                        'heading' => $item['heading'],
                        'point' => $item['point'],
                        'kra_title' => $kra['kra_title'],
                        'kra_weight' => $kra['kra_weight'],
                        'mpms_tables_id' => $kra['mpms_id'],
                        'obj_title' => $obj['obj_title'],
                        'obj_weight' => $obj['obj_weight'],
                        'Initiative' => $obj['Initiative'],
                        'kpi' => $obj['kpi'],
                        'target' => $obj['target'],
                        'Responsible' => $obj['Responsible'],
                        'kra_id' => $obj['kra_id'],
                    ];
                });
            });
        })->collapse()->all();

        $data2 = collect($data2_new)->map(function ($item) {
            return collect($item['kras'])->flatMap(function ($kra) use ($item) {
                return collect($kra['objs'])->map(function ($obj) use ($item, $kra) {
                    return [
                        'id' => $obj['id'],
                        'heading' => $item['heading'],
                        'point' => $item['point'],
                        'kra_title' => $kra['kra_title'],
                        'kra_weight' => $kra['kra_weight'],
                        'mpms_tables_id' => $kra['mpms_id'],
                        'obj_title' => $obj['obj_title'],
                        'obj_weight' => $obj['obj_weight'],
                        'Initiative' => $obj['Initiative'],
                        'kpi' => $obj['kpi'],
                        'target' => $obj['target'],
                        'Responsible' => $obj['Responsible'],
                        'kra_id' => $obj['kra_id'],
                    ];
                });
            });
        })->collapse()->all();

        $data3 = collect($data3_new)->map(function ($item) {
            return collect($item['kras'])->flatMap(function ($kra) use ($item) {
                return collect($kra['objs'])->flatMap(function ($obj) use ($item, $kra) {
                    return [
                        'id' => $obj['id'],
                        'heading' => $item['heading'],
                        'point' => $item['point'],
                        'kra_title' => $kra['kra_title'],
                        'kra_weight' => $kra['kra_weight'],
                        'mpms_tables_id' => $kra['mpms_id'],
                        'obj_title' => $obj['obj_title'],
                        'obj_weight' => $obj['obj_weight'],
                        'Initiative' => $obj['Initiative'],
                        'kpi' => $obj['kpi'],
                        'target' => $obj['target'],
                        'Responsible' => $obj['Responsible'],
                        'kra_id' => $obj['kra_id'],
                    ];
                });
            });
        })->collapse()->all();

        return view('admin.mpms.listview', compact("data1", "data2", "data3", 'year'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mpms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (session()->has('year2')) {
            $year = session('year2');
            //dd($year);
        } else {
            $year = date('Y');
        }
        $data = $request->all();
        // dd($data['kra_title']);
        $request->validate([
            'form_name' => 'required',
            'kra_title' => 'required|string|max:500',
            'kra_weight' => 'required|numeric|max:100',
        ]);
        $mpms_id = $data['form_name'];

        if (isset($data['kra_id'])) {
            dd("This is under Working");
        } else {

            $kra = Kra::create([
                "kra_title" => $data['kra_title'],
                "kra_weight" => $data['kra_weight'],
                "mpms_id" => $data['form_name'],
                "year" => $year
            ]);

            $id = $kra->id;
            $status = "create";
            return view('admin.mpms.final', compact('id', 'mpms_id', 'status'));
        }


    }


    public function finalStore(Request $request)
    {
        $data = $request->all();

        if (session()->has('year2')) {
            $year = session('year2');
        } else {
            $year = date('Y');
        }

        $validator = Validator::make($request->all(), [
            'objactives.*.obj_title' => 'required|string|max:500',
            'objactives.*.obj_weight' => 'required|numeric',
            'objactives.*.initiative' => 'required|string|max:500',
            'objactives.*.kpi' => 'required|string|max:500',
            'objactives.*.target' => 'required|string|max:255',
            'objactives.*.responsible' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            // If validation fails, you can return a response or handle it as needed.
            return response()->json(['errors' => $validator->errors()]);
        }


        $kra_id = $data['kra_id'];
        $mpms_id = $data['mpms_id'];

        // dd($request->objactives);
        foreach ($request->objactives as $key => $objective) {
            # code...
            Obj::create([
             "obj_title" => $objective['obj_title'],
             "obj_weight" => $objective['obj_weight'],
             "Initiative" => $objective['initiative'],
             "kpi" => $objective['kpi'],
             "target" => $objective['target'],
             "Responsible" => $objective['responsible'],
             "kra_id" => $kra_id,
             "mpms_id" => $mpms_id,

            ]);
        }
        return to_route('admin.mpms.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
