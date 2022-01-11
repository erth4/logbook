<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Http\Requests\CreateLogbookRequest;
use App\Http\Requests\UpdateLogbookRequest;
use App\Services\LogbookService;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logbook = Logbook::all();
        return response()->json(['data' => $logbook], 200);
    }

    public function xml()
    {
        header('Content-Type: text/xml');

        $logbook = Logbook::all();

        echo "<?xml version='1.0'?>";
        echo "<data>";
        foreach($logbook as $value) {
            echo "<logbook>";
            echo "<id>" . $value['id'] . "</id>";
            echo "<description>" . htmlspecialchars($value['description'], ENT_XML1, 'UTF-8') . "</description>";
            echo "<results>" . htmlspecialchars($value['results'], ENT_XML1, 'UTF-8') . "</results>";
            echo "<constraint>" . htmlspecialchars($value['constraint'], ENT_XML1, 'UTF-8') . "</constraint>";
            echo "<start_time>" . $value['start_time'] . "</start_time>";
            echo "<end_time>" . $value['end_time'] . "</end_time>";
            echo "<created_at>" . $value['created_at'] . "</created_at>";
            echo "<updated_at>" . $value['updated_at'] . "</updated_at>";
            echo "</logbook>";
        }
        echo "</data>";
        exit;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLogbookRequest $request, LogbookService $logbookService)
    {
        $save = $logbookService->create($request->all());
        if ($save) {
            return response()->json(['status' => 'sukses', 'response' => 'Tambah data berhasil.'], 200);
        } else { 
            return response()->json(['status' => 'gagal', 'response' => 'Tambah data gagal.'], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(UpdateLogbookRequest $request, LogbookService $logbookService)
    {
        $update = $logbookService->update($request->all());
        if ($update) {
            return response()->json(['status' => 'sukses', 'response' => 'Update data berhasil.'], 200);
        } else { 
            return response()->json(['status' => 'gagal', 'response' => 'Update data gagal.'], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, LogbookService $logbookService)
    {
        $delete = $logbookService->delete($request->id);
        if ($delete) {
            return response()->json(['status' => 'sukses', 'response' => 'Hapus data berhasil.'], 200);
        } else { 
            return response()->json(['status' => 'gagal', 'response' => 'Hapus data gagal.'], 403);
        }
    }
}
