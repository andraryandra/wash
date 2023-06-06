<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriMobil;
use App\Http\Controllers\Controller;

class KategoriMobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori_mobil = KategoriMobil::get();
        return view('admin.kategori.kategori_mobil.index', compact('kategori_mobil'));
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
    public function store(Request $request)
    {
        $this->validate($request,
        ['kategori_mobil' => 'required'],
        ['kategori_mobil.required' => 'Nama Kategori Mobil tidak boleh kosong']);

        $kategori_mobil = KategoriMobil::create([
            'kategori_mobil' => $request->kategori_mobil,
            'slug_kategori_mobil' => Str::slug($request->kategori_mobil)
        ]);

        if($kategori_mobil){
            return redirect()->back()->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->back()->with(['error' => 'Data Gagal Disimpan!']);
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
    public function update(Request $request, $id)
    {
                // Validate the request...
                $this->validate($request,
                ['kategori_mobil' => 'required'],
                ['kategori_mobil.required' => 'Nama Kategori Mobil tidak boleh kosong']);

                $kategori_mobil = KategoriMobil::where('id', $id)->update([
                    'kategori_mobil' => $request->kategori_mobil,
                    'slug_kategori_mobil' => Str::slug($request->kategori_mobil)
                ]);

                if($kategori_mobil){
                    return redirect()->back()->with(['success' => 'Data Berhasil Disimpan!']);
                }else{
                    return redirect()->back()->with(['error' => 'Data Gagal Disimpan!']);
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                        // Validate the request...
                        $kategori_mobil = KategoriMobil::where('id', $id)->delete();

                        if($kategori_mobil){
                            return redirect()->back()->with(['success' => 'Data Berhasil Dihapus!']);
                        }else{
                            return redirect()->back()->with(['error' => 'Data Gagal Dihapus!']);
                        }
    }
}
