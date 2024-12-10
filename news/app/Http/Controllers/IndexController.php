<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\RubricRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use DB;
use App\Models\Rubric;
use Illuminate\Support\Facades\Gate;

class IndexController extends Controller
{

    public function index()
    {
        $articles = Article::all();
        return view('index',compact('articles'));
    }
    public function show(Article $artId)
    {
        $info = DB::table('articles')
            ->join('rubrics', 'articles.rubrics_id', '=', 'rubrics.id')
            ->where('articles.id', '=', $artId->id)
            ->get();

        $array = json_decode(json_encode($info), true);
        $array[0]['id'] = $artId->id;
        return view('article')->with(['article' => $array[0]]);
    }
    public function showRubric($id)
    {
        $rubric = Rubric::findOrFail($id);
        $articles = Article::where('rubrics_id', $id)->get();

        return view('rubric', compact('rubric', 'articles'));
    }
    public function destroy(Article $article)
    {

        $article->delete();
        return redirect()
            ->route('index')->with('success');
    }
    public function createArticle()
    {
        $rubrics = Rubric::all();
        return view('add-article')->with(['rubrics' => $rubrics->toArray()]);
    }

    public function storeArticle(ArticleRequest $request)
    {
        $request->validate($request->rules());
        $data=$request->validated();
        $file = $request->image;
        $fileName = $file->getClientOriginalName();
        $data['image'] = $fileName;
        $article = new Article();
        $article->fill($data);
        $article->save();
        $target_path = public_path() . '/images/';
        $file->move($target_path, $fileName);
        return redirect()
            ->route('index');
    }
    public function createRubric()
    {
        $rubrics = Rubric::all();
        return view('add-rubric')->with(['rubrics' => $rubrics->toArray()]);
    }

    public function storeRubric(RubricRequest $request)
    {
        $request->validate($request->rules());
        $data=$request->validated();
        $rubric = new Rubric();
        $rubric->fill($data);
        $rubric->save();
        return redirect()
            ->route('index');
    }
}
