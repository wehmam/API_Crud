<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProdukRequest;
use App\Produk;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(){
        $product = Produk::all();
        return response()->json([
            'product'=>$product
        ]);
    }
    public function create(Request $request){

        $foto = $request->foto_produk->hashName();
        $fotoLocation = 'assets/gambar';
        $request->foto_produk->storeAs($fotoLocation,$foto);
            Produk::create([
                'nama_produk' => $request->nama_produk,
                'jenis_produk' => $request->jenis_produk,
                'harga_produk' => $request->harga_produk,
                'foto_produk'=> $request->foto_produk->hashName()
            ]);
                $res['pesan'] = 'berhasil Menambahkan Data';
                return response($res);
    }

    public function update(Request $request,$id){

        $product = Produk::find($id);
        dd($product->foto_produk);
        $product->update([
            'nama_produk' => $request->nama_produk,
            'jenis_produk' => $request->jenis_produk,
            'harga_produk' => $request->harga_produk,
            'foto_produk'=> $request->foto_produk ? $request->foto_produk->hashName() : $product->foto_produk
        ]);
        $file = $request->foto_produk;
        $fotoLocation = 'assets/gambar';

        if($file){
            Storage::delete('assets/gambar',$product->find($id)->foto_produk);
            $request->foto_produk->storeAs($fotoLocation,$request->foto_produk->hashName());
        }

        return response()->json([
            'message' => 'Data Berhasil Diedit'
        ]);
    }
    
    public function show($id){
        $product = Produk::findOrFail($id);
        // dd($product->foto_produk);
        return response()->json($product);
    }

    public function destroy($id){
        $product = Produk::destroy($id);
        Storage::delete('assets/gambar',$product->foto_produk);
        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ]);
    }
}
