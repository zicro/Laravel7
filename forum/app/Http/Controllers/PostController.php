<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth')->only(['create', 'edit', 'destroy']);
        $this->middleware('auth')->except(['index', 'show', 'all', 'archive']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // recuperer la liste des posts avec le count des parameters :
       $posts = Post::withCount('comments')->orderBy('updated_at', 'desc')->get();

        # faire passer les donnes depuis le controller
        # vers la vue a l'aide d'une array []
        return view('posts.index', [
            'posts' =>  $posts,
            'tab' => 'list'
        ]);
    }

    // get the list of SofDeleted Posts : 

    public function archive()
    {
        // recuperer la liste des posts qui seront supprimer
        // avec le count des parameters :
        $posts = Post::onlyTrashed()->withCount('comments')->orderBy('updated_at', 'desc')->get();

        # faire passer les donnes depuis le controller
        # vers la vue a l'aide d'une array []
        return view('posts.index', [
            'posts' =>  $posts,
            'tab'=> 'archive'
        ]);
    }

    // get lists of all posts, with SoftDeleted Posts : 

    public function all()
    {
        // recuperer la liste des posts qui sont supprimer 
        // + les posts qui ne sont pas supprimer avec le count des parameters :
        $posts = Post::withTrashed()->withCount('comments')->orderBy('updated_at', 'desc')->get();

        # faire passer les donnes depuis le controller
        # vers la vue a l'aide d'une array []
        return view('posts.index', [
            'posts' =>  $posts,
            'tab'=>'all'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //sert a afficher le formulaire d'ajout
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {

        // validate data : 

       /*  $validateData = $request->validate([
            'title' => 'bail|required|min:4|max:100',
            'content' => 'required'
        ]); */

        //sert a ajouter les donnes dans la BDD
        ## Methode : 01
        /* $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = Str::slug($post->title,'-');
        $post->active = 1; 
        
         $post->save();*/

        ## Methode : 02
        // on specifier les champs dans la request qui 
        // seront affecter au table $data[]
        $data = $request->only(['title', 'content']);
        // on ajout les data qui n'est pas recuperer depuis request:
        $data['slug'] = Str::slug(  $data['title'] , '-');
        $data['active'] = 0;
        
        $post = Post::create($data);
        // cree la session flash message
        $request->session()->flash('status' ,'Post was Created');

       
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // on peut afficher un seule element dans le id est passer par params
        //dd(\App\Post::find($id));

        return view('posts.show', [
            'post' => Post::with('comments')->findOrFail($id),
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //recuperer les informations su post a editer via son ID
        $post = Post::findOrFail($id);
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        //ici on va stocker les donner recuperer a partir du 
        // formulaire EDIT via le Request
        // aussi on a utiliser StorePost la class qui sert
        // a verifier les condition required ... pour les 
        // donnes envoyer via le formulaire

        ## on recupere l'element a modifier a partir de son id
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = Str::slug( $post->title, '-');

        $post->save();

        $request->session()->flash('status', 'Post Updated Success');
        return redirect(route('posts.show', ['post'=>$post->id]));

    }

    public function restore(Request $request, $id){

        // from la liste des posts supprimer, on restore
        // the one who's ID is in Pamars
        $post = Post::onlyTrashed()->whereId($id);
        $post->restore();
        

        $request->session()->flash('status', 'Restored Success !!');
        return redirect()->back();
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //on supprimer l'element dans le id est passer en parameters
        ## Method 01
        /* $post = Post::find($id);
        $post->delete(); */

        # Method 02
        Post::destroy($id);

        $request->session()->flash('status', 'Deleted Success !!');
        return redirect()->back();
    }

    public function idelete(Request $request, $id){
        // supprimer le post physiquement
        // operarion irreversible
        // on ne peut pas la recupere par la suite...
        $post = Post::onlyTrashed()->where('id', $id)->first();
        $post->forceDelete();

        $request->session()->flash('status', 'Dropped Success !!');
        return redirect()->back();
    }
}
