<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReferensiController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel bagian
        $dataallbagian = DB::connection('sqlsrv_user')->table('ref_bagian')->get();
        return view('referensi.bagian', ['dataallbagian' => $dataallbagian]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomenklatur' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tanggal_aktif' => 'required|date',
        ]);

        $addbagian = [
            'Nomenklatur' => $request->nomenklatur,
            'Nama' => $request->nama,
            'TanggalAktif' => $request->tanggal_aktif,
        ];

        try {
            DB::connection('sqlsrv_user')->table('ref_bagian')->insert($addbagian);
            return redirect()->route('bagian.index')->with('sukses', 'Berhasil Menambahkan Data Bagian');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Menambahkan Data Bagian: ' . $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'BagianId' => 'required|string',
            'nomenklatur' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tanggal_aktif' => 'required|date',
        ]);

        $updatebagian = [
            'Nomenklatur' => $request->nomenklatur,
            'Nama' => $request->nama,
            'TanggalAktif' => $request->tanggal_aktif,
        ];

        try {
            DB::connection('sqlsrv_user')->table('ref_bagian')->where('BagianId', $request->BagianId)->update($updatebagian);
            return redirect()->route('bagian.index')->with('sukses', 'Berhasil Merubah Data Bagian');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Merubah Data Bagian: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::connection('sqlsrv_user')->table('ref_bagian')->where('BagianId', $id)->delete();
            return redirect()->route('bagian.index')->with('sukses', 'Berhasil Menghapus Data Bagian');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Menghapus Data Bagian: ' . $e->getMessage()])->withInput();
        }
    }

    public function getBagianById($id)
    {
        $bagian = DB::connection('sqlsrv_user')->table('ref_bagian')->where('BagianId', $id)->first();
        return response()->json($bagian);
    }

    public function indexUrusan()
    {
        $urusanData = DB::connection('sqlsrv_user')->table('ref_urusan')->get();
        $bagianData = DB::connection('sqlsrv_user')->table('ref_bagian')->get();

        return view('referensi.urusan', compact('urusanData', 'bagianData'));
    }

    public function storeUrusan(Request $request)
    {
        $request->validate([
            'nomenklatur' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tanggal_aktif' => 'required|date',
            'bagian_id' => 'required|string',
        ]);

        $urusanData = [
            'Nomenklatur' => $request->nomenklatur,
            'Nama' => $request->nama,
            'TanggalAktif' => $request->tanggal_aktif,
            'BagianId' => $request->bagian_id,
        ];

        try {
            DB::connection('sqlsrv_user')->table('ref_urusan')->insert($urusanData);
            return redirect()->route('urusan.index')->with('sukses', 'Berhasil Menambahkan Data Urusan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Menambahkan Data Urusan: ' . $e->getMessage()])->withInput();
        }
    }

    public function updateUrusan(Request $request, $urusanId)
    {
        $request->validate([
            'nomenklatur' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tanggal_aktif' => 'required|date',
            'bagian_id' => 'required|string'
        ]);

        $data = [
            'Nomenklatur' => $request->nomenklatur,
            'Nama' => $request->nama,
            'TanggalAktif' => $request->tanggal_aktif,
            'BagianId' => $request->bagian_id
        ];

        try {
            DB::connection('sqlsrv_user')->table('ref_urusan')->where('UrusanId', $urusanId)->update($data);
            return redirect()->route('urusan.index')->with('sukses', 'Berhasil Merubah Data Urusan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Merubah Data Urusan: ' . $e->getMessage()])->withInput();
        }
    }

    public function deleteUrusan($urusanId)
    {
        try {
            DB::connection('sqlsrv_user')->table('ref_urusan')->where('UrusanId', $urusanId)->delete();
            return redirect()->route('urusan.index')->with('sukses', 'Berhasil Menghapus Data Urusan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Menghapus Data Urusan: ' . $e->getMessage()])->withInput();
        }
    }

    public function getUrusanById($urusanId)
    {
        $urusan = DB::connection('sqlsrv_user')->table('ref_urusan')->where('UrusanId', $urusanId)->first();
        return response()->json($urusan);
    }


    public function indexRole()
    {
        // Mengambil semua data dari tabel role
        $dataallrole = DB::connection('sqlsrv_user')->table('role')->get();
        return view('referensi.role', ['dataallrole' => $dataallrole]);
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'namarole' => 'required|string|max:255',
        ]);

        $addrole = [
            'Namarole' => $request->namarole,
        ];

        try {
            DB::connection('sqlsrv_user')->table('role')->insert($addrole);
            return redirect()->route('role.index')->with('sukses', 'Berhasil Menambahkan Data Role');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Menambahkan Data Role: ' . $e->getMessage()])->withInput();
        }
    }

    public function updateRole(Request $request, $roleid)
    {
        $request->validate([
            'namarole' => 'required|string|max:255',
        ]);

        $dataUpdate = [
            'Namarole' => $request->namarole,
        ];

        try {
            DB::connection('sqlsrv_user')->table('role')->where('Roleid', $roleid)->update($dataUpdate);
            return redirect()->route('role.index')->with('sukses', 'Berhasil Mengubah Data Role');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Mengubah Data Role: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroyRole($roleid)
    {
        try {
            DB::connection('sqlsrv_user')->table('role')->where('Roleid', $roleid)->delete();
            return redirect()->route('role.index')->with('sukses', 'Berhasil Menghapus Data Role');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal Menghapus Data Role: ' . $e->getMessage()]);
        }
    }


}
 