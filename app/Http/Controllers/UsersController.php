<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Validator;
use App\Models\User;
use App\Models\Roles;
use App\Mail\MyMail;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Users'
        ];

        return view('users.index', $data);
    }

    public function list()
    {

        $data = [];

        $request = $_POST;
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

        $users = DB::table('users')
                ->orderBy('users.id','asc')
                ->leftJoin('roles', 'users.role', '=', 'roles.id')
                ->where(function($query) use ($filter) {
                    $query->where('users.name', 'like', '%' . $filter . '%')
                            ->orWhere('users.email', 'like', '%' . $filter . '%');
                })
                ->select('users.*', 'roles.name as role_name')
                ->skip($start)
                ->take($length)
                ->get();
                
        
        $total_record_filter = DB::table('users')
                                ->orderBy('users.id','asc')
                                ->leftJoin('roles', 'users.role', '=', 'roles.id')
                                ->where(function($query) use ($filter) {
                                    $query->where('users.name', 'like', '%' . $filter . '%')
                                            ->orWhere('users.email', 'like', '%' . $filter . '%');
                                })
                                ->select('users.*', 'roles.name as role_name')
                                ->count();

        $data = [];

        foreach ($users as $value) {
            ++$no;
            $value->no = $no;
            $value->edit = route('users.edit', ['id' => $value->id]);
            $value->delete = route('users.delete', ['id' => $value->id]);
            $value->status = ($value->email_verified_at == null) ? 'Unverified' : \Carbon\Carbon::parse($value->email_verified_at)->isoFormat('dddd, D MMM Y, HH:mm');
            $value->activation = route('users.activation', ['id' => $value->id]);
            $value->created_at = \Carbon\Carbon::parse($value->created_at)->isoFormat("dddd, D MMM Y, HH:mm");
            $data[] = $value;    
        }

        return response()->json([
            "draw"            => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
            "recordsTotal"    => intval( ( $total_record_filter ) ),
            "recordsFiltered" => intval( ( $total_record_filter ) ),
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Create New User',
            'roles' => Roles::all(),
        ];

        return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request, UsersService $usersService)
    {
        $save = $usersService->create($request->all());
        if ($save) {
            return redirect()->route('users')->with(['success' => 'Tambah user berhasil.']);
        } else { 
            return redirect()->route('users.create')->withInput()->withErrors(['error' => 'Ada kesalahan. Silahkan coba beberapa saat lagi.']);
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
        $user = User::findOrfail($id);

        $data = [
            'roles' => Roles::all(),
            'user'  => $user
        ];

        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, UsersService $usersService)
    {
        $save = $usersService->update($request->all());
        if ($save) {
            return redirect()->route('users')->with(['success' => 'Update user berhasil.']);
        } else { 
            return redirect()->route('users.edit')->withInput()->withErrors(['error' => 'Ada kesalahan. Silahkan coba beberapa saat lagi.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UsersService $usersService)
    {
        $delete = $usersService->delete($request->id);
        if ($delete) {
            return response()->json(['status' => 'success', 'message' => 'User berhasil dihapus.'], 200);
        } else { 
            return response()->json(['status' => 'error', 'message' => 'User gagal dihapus. Karena masih ada data yang belum dihapus.'], 422);
        }
    }

    public function activation($id)
    {
        $user = User::findOrFail($id);
        if ($user['email_verified_at'] == null) {
            $update = User::where(['id'   => $id])->update(['email_verified_at' => \Carbon\Carbon::now()]);
            if ($update) {
                $data = [
                    'subject'   => 'Account Activation',
                    'user'      => $user['name'],
                    'data'      => 'Selamat, akun Anda berhasil diaktivasi.'
                ];        
                Mail::to($user['email'])->send(new MyMail($data));
                return redirect()->route('users')->with(['success' => 'User berhasil diaktivasi.']);
            } else { 
                return redirect()->route('users')->withInput()->withErrors(['error' => 'Ada kesalahan. Silahkan coba beberapa saat lagi.']);
            }
        } else {
            $update = User::where(['id'   => $id])->update(['email_verified_at' => null]);
            if ($update) {
                $data = [
                    'subject'   => 'Account Suspended',
                    'user'      => $user['name'],
                    'data'      => 'Mohon maaf, akun Anda dinonaktifkan. Silahkan hubungi Administrator untuk informasi lebih lanjut.'
                ];        
                Mail::to($user['email'])->send(new MyMail($data));
                return redirect()->route('users')->with(['success' => 'User berhasil dinonaktifkan.']);
            } else { 
                return redirect()->route('users')->withInput()->withErrors(['error' => 'Ada kesalahan. Silahkan coba beberapa saat lagi.']);
            }
        }
    }
}
