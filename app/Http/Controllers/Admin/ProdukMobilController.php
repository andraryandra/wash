<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProdukMobil;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriMobil;
use App\Http\Controllers\Controller;

class ProdukMobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk_mobil = ProdukMobil::with(['kategoriMobil'])->get();
        $kategori_mobils = KategoriMobil::get();
        return view('admin.produk.produk_mobil.index', compact(
            'produk_mobil',
            'kategori_mobils',
        ));
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
        [
            'kategori_mobil_id' => 'nullable',
            'nama_produk' => 'required',
            'harga_produk' => 'required|integer',
            'deskripsi_produk' => 'required',
            'slug_produk' => 'nullable',
        ],
        [
            'kategori_mobil_id.required' => 'Kategori Mobil harus diisi',
            'nama_produk.required' => 'Nama Produk harus diisi',
            'harga_produk.required' => 'Harga Produk harus diisi',
            'deskripsi_produk.required' => 'Deskripsi Produk harus diisi',
        ]);

        $produk_mobil = ProdukMobil::create([
            'kategori_mobil_id' => $request->kategori_mobil_id,
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'slug_produk' => Str::slug($request->nama_produk),
        ]);

        if($produk_mobil){
            //redirect dengan pesan sukses
            return redirect()->route('produk-mobil.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('produk-mobil.index')->with(['error' => 'Data Gagal Disimpan!']);
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

        $this->validate($request,
        [
            'kategori_mobil_id' => 'nullable',
            'nama_produk' => 'required',
            'harga_produk' => 'required|integer',
            'deskripsi_produk' => 'required',
            'slug_produk' => 'nullable',
        ],
        [
            'kategori_mobil_id.required' => 'Kategori Mobil harus diisi',
            'nama_produk.required' => 'Nama Produk harus diisi',
            'harga_produk.required' => 'Harga Produk harus diisi',
            'deskripsi_produk.required' => 'Deskripsi Produk harus diisi',
        ]);

        $produk_mobil = ProdukMobil::findOrFail($id);

        $produk_mobil->update([
            'kategori_mobil_id' => $request->kategori_mobil_id,
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'slug_produk' => Str::slug($request->nama_produk),
        ]);

        if($produk_mobil){
            //redirect dengan pesan sukses
            return redirect()->route('produk-mobil.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('produk-mobil.index')->with(['error' => 'Data Gagal Diupdate!']);
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
                $produk_mobil = ProdukMobil::findOrFail($id);
                $produk_mobil->delete();

                if($produk_mobil){
                    //redirect dengan pesan sukses
                    return redirect()->route('produk-mobil.index')->with(['success' => 'Data Berhasil Dihapus!']);
                }else{
                    //redirect dengan pesan error
                    return redirect()->route('produk-mobil.index')->with(['error' => 'Data Gagal Dihapus!']);
                }
    }
}
