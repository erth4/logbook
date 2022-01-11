<?php

namespace App\Http\Controllers;

use \Mpdf\Mpdf;
use App\Models\Logbook;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Requests\CreateLogbookRequest;
use App\Http\Requests\UpdateLogbookRequest;
use App\Services\LogbookService;
use SimpleXLSXGen;

class LogbookController extends Controller
{

    private function listStatus()
    {
        $status = Status::orderBy('id', 'asc')->get();
        $data = [];
        foreach($status as $value) {
            $data[$value['id']] = $value['name'];
        }
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $in_status = !empty($_GET['status']) ? $_GET['status'] : 0;

        session(['status' => $in_status]);

        $data = [
            'status'    => Status::orderBy('id', 'asc')->get(),
        ];

        return view('logbook.index', $data);
    }

    public function json_data()
    {
        
        $data = [];

        $request = $_POST;

        $from = !empty($request['from']) ? $request['from'] : date('Y-m-01');
        $to = !empty($request['to']) ? $request['to'] : date('Y-m-d');
        $in_status = !empty($request['status']) ? $request['status'] : 0;
        session(['status' => $in_status]);

        $no = intval($request['start']);
        $start = intval($request['start']);
        $length = intval($request['length']);
        $filter = "";

        if ( isset($request['start']) && $request['length'] != -1 ) {

            $start = intval($request['start']);
            $length = intval($request['length']);
        }

        if ( isset($request['search']) && $request['search']['value'] != '' ) {
            $filter = trim($request['search']['value']);
        }

        $logbook = Logbook::where('id_user', auth()->user()->id)
                            ->where(function($query) use ($filter) {
                                $query->where('description', 'like', '%' . $filter . '%')
                                        ->orWhere('results', 'like', '%' . $filter . '%')
                                        ->orWhere('constraint', 'like', '%' . $filter . '%');
                            })
                            ->when($in_status, function($query, $in_status) {
                                return $query->where('id_status', $in_status);
                            })
                            ->orderBy('execution_date','desc')
                            ->skip($start)
                            ->take($length)
                            ->get();      
        
        $total_record_filter = Logbook::where('id_user', auth()->user()->id)
                            ->where(function($query) use ($filter) {
                                $query->where('description', 'like', '%' . $filter . '%')
                                        ->orWhere('results', 'like', '%' . $filter . '%')
                                        ->orWhere('constraint', 'like', '%' . $filter . '%');
                            })
                            ->when($in_status, function($query, $in_status) {
                                return $query->where('id_status', $in_status);
                            })
                            ->count();

        $data = [];

        foreach ($logbook as $value) {
            ++$no;
            $value->no = $no;
            $value->edit = route('logbook.edit', ['id' => $value->id]);
            $value->delete = route('logbook.destroy');
            $value->execution_date = \Carbon\Carbon::parse($value->execution_date)->isoFormat('dddd, D MMM Y');
            $value->time = \Carbon\Carbon::parse($value->start_time)->format('H:i') . ' - ' . \Carbon\Carbon::parse($value->end_time)->format('H:i');
            $data[] = $value;    
        }

        die(json_encode([
            "draw"            => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
            "recordsTotal"    => intval( ( $total_record_filter ) ),
            "recordsFiltered" => intval( ( $total_record_filter ) ),
            'data' => $data
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'status'    => $this->listStatus()
        ];

        return view('logbook.create', $data);
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
            return redirect()->route('logbook', ['status='.session('status').''])->with(['success' => 'Tambah Log Book Berhasil.']);
        } else { 
            return redirect()->route('logbook.create')->withInput()->withErrors(['error' => 'Ada kesalahan. Silahkan coba beberapa saat lagi.']);
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
        $logbook = Logbook::findOrFail($id);

        $data = [
            'logbook'   => $logbook,
            'status'    => $this->listStatus()
        ];

        return view('logbook.edit', $data);
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
            return redirect()->route('logbook', ['status='.session('status').''])->with(['success' => 'Update Log Book Berhasil.']);
        } else { 
            return redirect()->route('logbook.create')->withInput()->withErrors(['error' => 'Ada kesalahan. Silahkan coba beberapa saat lagi.']);
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
            return response()->json(['status' => 'success', 'message' => 'Logbook berhasil dihapus.'], 200);
        } else { 
            return response()->json(['status' => 'success', 'message' => 'Logbook gagal dihapus.'], 422);
        }
    }


    public function export($type = 'pdf')
    {
        $in_status = !empty($_GET['status']) ? $_GET['status'] : 0;
        $status = Status::find($in_status);

        $status_name = "";
        if($status) {
            $status_name = $status['name'];
        }

        if ($type === 'pdf') {

            $mpdf = new Mpdf([
                'mode'                      => 'utf-8',
                'format'                    => 'A4',
                'orientation'               => 'L',
                'margin_left'               => 10,
                'margin_right'              => 10,
                'margin_top'                => 10,
                'margin_bottom'             => 10,
                'default_font_size'         => '12',
            ]);


            $data = [
                'logbook'   => Logbook::where([['id_user', auth()->user()->id]])->when($in_status, function($query, $in_status) {
                    return $query->where('id_status', $in_status);
                })->orderBy('execution_date', 'asc')->get(),
                'status'    => $status_name,
            ];
            $mpdf->SetTitle("Logbook " . auth()->user()->identity_number . " " . $status_name);
            $mpdf->WriteHTML(view('logbook.export', $data));
            $mpdf->Output("Logbook_".auth()->user()->identity_number."_".$status_name.".pdf", "I");
            exit;
        }

        if($type === 'excel') {

            $logbook = Logbook::where([['id_user', auth()->user()->id]])->when($in_status, function($query, $in_status) {
                    return $query->where('id_status', $in_status);
                })->orderBy('execution_date', 'asc')->get();
            


            $data = [];

            foreach ($logbook as $key => $value) {
                
                $row = [];
                $row[0] = $key+1;
                $row[1] = $value['description'];
                $row[2] = $value['execution_date'];
                $row[3] = $value['start_time'];
                $row[4] = $value['end_time'];
                $row[5] = $value['results'];
                $row[6] = $value['constraint'];
                $data[] = $row;
            }

            $header = [
                [
                    '<b>No</b>',
                    '<b>Kegiatan dan Lokasi KP</b>',
                    '<b>Tanggal</b>',
                    '<b>Dari Jam</b>',
                    '<b>Sampai Jam</b>',
                    '<b>Hasil</b>',
                    '<b>Kendala, Rencana Perubahan (Jika ada)</b>',
                ],
            ];

            $merge = array_merge($header, array_values($data));
            SimpleXLSXGen::fromArray( $merge )->downloadAs('Logbook-' . auth()->user()->identity_number . '-' . $status_name . '.xlsx');
            exit;

        }

        return redirect()->back();
    }
}
