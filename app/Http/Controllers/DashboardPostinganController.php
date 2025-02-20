<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostinganController extends Controller
{
    // Resource Controller
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postingan = new Postingan();
        // Debugging
        // return $postingan->all();
        // return $postingan->where('user_id', auth()->user()->id)->get();

        return view('dashboard.postingan.blog', [
            'postingan' => $postingan->where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.postingan.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ddd($request);
        // return $request->file('images')->store('postingan-images');
        $validatedData = $request->validate([
            'judul' => 'required|max:100',
            'slug' => 'required|unique:postingans',
            'category_id' => 'required',
            'images' => 'image|file|max:20000',
            'body' => 'required'
        ]);

        if($request->file('images')){
            $validatedData['images'] = $request->file('images')->store('postingan-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 150, '...'); //strip_tags menghapus Syntax html

        Postingan::create($validatedData);

        return redirect('dashboard/blog')->with('success', 'Postingan berhasil! DiUpload');
    }

    /**
     * Display the specified resource.
     */
    public function show(Postingan $postingan)
    {
        // dd($postingan);
        // $test = $postingan->where('user_id', auth()->user()->id)->get();

        // dd($test);

        if(Auth::user()->id !== $postingan->user_id ) {
            abort(403);
        }
        // }else{
        //     abort(403);
        // }

        // dd([
        //     'user_id' => auth()->user()->id,
        //     'postingan_id' => Postingan::query()->get()[0]->id
        // ]);
        // Debugging untuk memastikan ID postingan sesuai
        // dd([
        //     'user_id' => auth()->user()->id,
        //     'postingan_id' => $postingan->id,
        //     'postingan_data' => $postingan
        // ]);
        // dd($postingan);
        return view('dashboard.postingan.postshow', [
            'postingan' => $postingan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postingan $postingan)
    {
        if(Auth::user()->id !== $postingan->user_id) {
            abort(403);
        }


        return view('dashboard.postingan.edit', [
            'postingan' => $postingan,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Postingan $postingan)
    {
        $rules = [
            'judul' => 'required|max:100',
            //'slug' => 'required|unique:postingans', //->cek gunakan kondisi karena laravel sifatnya menimpa data , jika unique menimpa val=sama akan eror
            'category_id' => 'required',
            'images' => 'image|file|max:20000',
            'body' => 'required'
        ];


        if($request->slug != $postingan->slug){
            $rules['slug'] = 'required|unique:postingans';
        }

        $validatedData = $request->validate($rules);

        if($request->file('images')){
            // Menghapus File yang tertimpa
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['images'] = $request->file('images')->store('postingan-images');
        }
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 150, '...'); //strip_tags menghapus Syntax html

        Postingan::where('id', $postingan->id)->update($validatedData);

        return redirect('dashboard/blog')->with('success', 'Postingan berhasil! DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Postingan $postingan)
    {
        // Lakukan Destroy Image yang sudah tertimpa
        if($postingan->images){
            Storage::delete($postingan->images);
        }
        Postingan::destroy($postingan->id);

        return redirect('dashboard/blog')->with('success', 'Postingan berhasil! Dihapus!');
    }

    public function checkSlug(Request $request) {
        $slug = SlugService::createSlug(Postingan::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
