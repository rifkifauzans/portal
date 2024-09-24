<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public static function getdatausers($userid){
        $a_datauser = [$userid];
        $datauser = DB::connection("sqlsrv_spdk")->select('exec USP_AMS_GET_USER ?',$a_datauser);
        // return json_encode(array('status' => true, 'data' => $a_datauser));  
        return $datauser;
    } 

    public function index(){
        $dataalluser = DB::connection('sqlsrv')->table('users_login')
        //->where('username','like','hangga%')
        //->leftjoin('tbl_bagian', function($join){
          //  $join->on('users.bagian','=','tbl_bagian.bagian');
            //$join->on('users.kota','=','tbl_bagian.kota');
        //})
        //->where('password','12345')
        //->whereIn('tbl.bagian.kode_bagian',$bagiankhusus)
        //->whereRaw('(username like "%Hendry%" or password ="12345")')
        
        ->get();
        //dd($dataalluser);
        $data['dataalluser']=$dataalluser;
        $status=0;
        //ini pakai compact
        return view('user.user',compact('dataalluser'));
        //ini pakai array
        //return view('user.user',$data);

    }

    public function view_form_user($id = null){
        //dd($id);
        $datakebun = DB::connection('sqlsrv')->table('ref_kebun')->where('status',1)->get();
        $datauser= DB::connection('sqlsrv')->table('users_login')->where('id',$id)->first();
        if($id){
            
            if(isset($datauser)){
                return view('user.form_user', compact('datauser','datakebun'));
            }
            else{
                return view('user.form_user', compact('datauser','datakebun'));
            }
            
        }
        else{
            return view('user.form_user', compact('datauser','datakebun'));
        }
        
    }

    public function func_storeuser(Request $request){
        // dd($request->name);
        $adduser=[
            'nama'=> $request->nama,
            'username'=>$request->username,
            'region'=>$request->region,
            'hakakses'=>$request->hakakses,
            'password'=>bcrypt(12345),
            'lokasiunit'=>$request->lokasiunit
        ];
        try {
            DB::connection('sqlsrv')->table('users_login')->insert($adduser);
            return redirect('/user/index')->with('sukses','Berhasil Menambahkan Data User');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Menambahkan Data User: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_updateuser(Request $request){
        $idnourut = $request->id;
        $adduser=[
            'nama'=> $request->nama,
            'username'=>$request->username,
            'region'=>$request->region,
            'hakakses'=>$request->hakakses,
            'lokasiunit'=>$request->lokasiunit
            // 'password'=>bcrypt($request->password)
        ];
        try {
            DB::connection('sqlsrv')->table('users_login')->where('id',$idnourut)->update($adduser);
            return redirect('/user/index')->with('sukses','Berhasil Merubah Data User');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Update Data User: ' . $e->getMessage()])->withInput();
        }
    }
    public function func_updatepassword(Request $request){
        $idnourut = $request->id;
        $adduser=[
            'password'=>bcrypt($request->password)
        ];
        if($request->password == $request->password2){
            try {
                DB::connection('sqlsrv')->table('users_login')->where('id',$idnourut)->update($adduser);
                return redirect('/user/index')->with('sukses','Berhasil Merubah Data Password');
            } catch (\Exception $e) {
                return back()->withErrors(['message' => 'Gagal Update Password: ' . $e->getMessage()])->withInput();
            }
        }else{
            return back();
        }
    }

    public function func_deleteuser($id = null){
        try {
            DB::connection('sqlsrv')->table('users_login')->where('id',$id)->delete();
            return redirect('/user/index')->with('sukses','Berhasil Menghapus Data User');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Menghapus User: ' . $e->getMessage()])->withInput();
        }
    }

    public static function getDataUser($id)
    {
        $a_datauser = [$id];
        $datauser = DB::connection("sqlsrv_user")->select('exec USP_AMS_GET_USER ?', $a_datauser);
        return $datauser;
    }

    public function indexUsers()
    {
        // Fetch all users along with their related 'bagian' and 'role'
        $dataalluser = DB::connection('sqlsrv_user')->table('users_login')
            ->leftJoin('ref_bagian', 'users_login.bagianid', '=', 'ref_bagian.BagianId')
            ->leftJoin('role', 'users_login.subbagianid', '=', 'role.roleid')
            ->select('users_login.*', 'ref_bagian.Nama as nama_bagian', 'role.namarole as nama_role')
            ->get();

        // Fetching 'bagian' and 'role' data for the dropdowns in the form
        $bagians = DB::connection('sqlsrv_user')->table('ref_bagian')->get();
        $roles = DB::connection('sqlsrv_user')->table('role')->get();

        return view('user.users', compact('dataalluser', 'bagians', 'roles'));
    }

    public function storeUsers(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'id_karyawan' => 'required|string',
            'username' => 'required|string|max:255|unique:users_login,username',
            'email' => 'required|email|max:255|unique:users_login,email',
            'region' => 'required|string|max:255',
            'bagianid' => 'required',
            'subbagianid' => 'required',
            'password' => 'required|string|min:5|confirmed',
        ]);

        $newUser = [
            'nama' => $validatedData['nama'],
            'id_karyawan' => $validatedData['id_karyawan'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'region' => $validatedData['region'],
            'bagianid' => $validatedData['bagianid'],
            'subbagianid' => $validatedData['subbagianid'],
            'password' => bcrypt($validatedData['password']),
        ];

        try {
            DB::connection('sqlsrv_user')->table('users_login')->insert($newUser);
            return redirect()->route('user.indexUsers')->with('sukses', 'Berhasil Menambahkan User Baru');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Menambahkan User Baru: ' . $e->getMessage()])->withInput();
        }
    }

    public function updateUsers(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:users_login,id',
            'nama' => 'required|string|max:255',
            'id_karyawan' => 'required|string',
            'username' => 'required|string|max:255|unique:users_login,username,' . $request->id,
            'email' => 'required|email|max:255|unique:users_login,email,' . $request->id,
            'region' => 'required|string|max:255',
            'bagianid' => 'required|string',
        ]);
    
        try {
            DB::connection('sqlsrv_user')->table('users_login')->where('id', $request->id)->update([
                'nama' => $validatedData['nama'],
                'id_karyawan' => $validatedData['id_karyawan'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'region' => $validatedData['region'],
                'bagianid' => $validatedData['bagianid'],
            ]);
    
            return response()->json(['status' => 'success', 'message' => 'Berhasil Memperbarui User']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal Memperbarui User: ' . $e->getMessage()], 500);
        }
    }
    


}
