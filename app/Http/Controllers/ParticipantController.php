<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ParticipantImport;
use App\Exports\ParticipantExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Schoolarship;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Schoolarship::all();
        return view('participant')->with([
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Excel::download(new ParticipantExport(), 'result.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Excel::import(new ParticipantImport(), $request->file);
        return redirect('participant');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function add(Request $request)
    {
        $lastCode = DB::table('schoolarship')
            ->select(DB::raw('MAX(CAST(SUBSTRING(code, 1) AS UNSIGNED)) AS last_trx'))
            ->value('last_trx');

        $data = [
            'code' => $lastCode + 1,
            'name' => $request->input('name'),
            'school' => $request->input('school'),
            'status' => 0,
        ];
        Schoolarship::create($data);
        return redirect('dashboard')->with('message', 'Data siswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Schoolarship::findOrFail($id);
        $student->delete();
        return redirect('dashboard')->with('message', 'Data siswa berhasil dihapus!');
    }
}
