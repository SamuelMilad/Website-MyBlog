<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
class ArticleController extends Controller
{

    protected function validator (array $data){
        return Validator:: make($data, [
            'title'=>'required',
            'body'=>'required'
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return view('welcome')->with('articles',$articles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //1- validation title/body
        $this->validator($request->all())->validate();

        //2- add to database

        //1- get file from form
        $file = $request->file('thumbnall');
        //2- name the file
        $time = Carbon::now();
        $directory = date_format($time, 'Y').'/'.date_format($time, 'M').'/'.date_format($time, 'D');
        $fileName = date_format($time,'h').date_format($time,'s').rand(1,9).'.'.$file->extension();
        //3- upload
        Storage::disk('public')->putFileAs($directory,$file,$fileName);

        //$article = Article::create($request->all());
        $article = Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'thumbnall' => $directory.'/'.$fileName
        ]);

        //3- return to another page
        $request->session()->flash('message', 'The article has been added successfully');
        return redirect()->route('admin_index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::where('id',$id)->firstOrFail();
        return view('article')->with('article',$article);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article=Article::where('id',$id)->firstOrFail();
        return view('admin.edit')->with('article',$article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article=Article::where('id',$id)->firstOrFail();
        $article ->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        if($request->file('thumbnall')){
            //1- get file from form
            $file = $request->file('thumbnall');
            //2- name the file
            $time = Carbon::now();
            $directory = date_format($time, 'Y').'/'.date_format($time, 'M').'/'.date_format($time, 'D');
            $fileName = date_format($time,'h').date_format($time,'s').rand(1,9).'.'.$file->extension();
            //3- upload
            Storage::disk('public')->putFileAs($directory,$file,$fileName);

            $article->thumbnall = $directory.'/'.$fileName;
            $article->save();
        }

        //return to another page
        $request->session()->flash('message', 'The article has been edited successfully');
        return redirect()->route('admin_index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
