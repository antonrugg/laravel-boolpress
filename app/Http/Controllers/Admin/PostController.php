<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all(); //recuperiamo tutti i post
        return view('admin.posts.index', compact('posts'));
        //ritorno la view in admin/posts/index.blade.php e passo tutti i posts

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
        //ritorno la view in admin/posts/create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'title' => 'required|max:250',
            'content' => 'required|min:5',
            'category' => 'exists:categories,id',
            'tags' => 'exists:tags,id',
            'image'=>'nullable|image'
        ],
        [
            'title.required' =>'Titolo deve essere valorizzato.',
            'title.max' =>'Hai superato i 250 caratteri.',
            'content.required' => 'Il contenuto deve essere compilato.',
            'content.min' => 'Minimo 5 caratteri.',
            'category_id.exists' => 'La categoria selezionata non esiste',
            'tags' => 'Il tag non esiste',
            'image'=>'il file deve essere un\'immagine'
            //modifichiamo il messaggio di errore standard
        ]);
        //validazione dati

        $postData = $request->all(); //prendiamo tutti i dati


        if(array_key_exists('image', $postData)){
            $img_path = Storage::put('uploads', $postData['image']);
            $postData['cover'] = $img_path;
        }

        $newPost = new Post();//creiamo una nuova istanza di post
        $newPost->fill($postData);//filliamo newPost instance con i dati
        // $slug = Str::slug($newPost->title);//prendo il valore di titolo che potrebbe avere caratteri particolari e lo passiamo in slug per sistemarlo

        // dd($slug);//dump test per vedere lo slug prima
        // dd($alternativeSlug)

        // $alternativeSlug = $slug;//ci serve valorizzarlo uguale cosi' dopo il while possiamo avere il valore univoco corretto

        // $postFound = Post::where('slug', $slug)->first();
        //definiamo una variabile, usiamo post con static method where
        //se passiamo due parametri fa l'uguaglianza quindi se slug e' uguale al nostro slug
        //prendiamo solo il primo record con quello slug ->first()

        // $counter = 1;
        //mettiamo un numero in coda allo slug e lo facciamo partire da 1
        // while($postFound){//fintanto che postFound esiste (fintanto che un record e' uguale allo slug continuiamo a ciclare, pero' cambio lo slug da verificare)
            // $alternativeSlug = $slug . '_' . $counter;//definiamo una chiave che prende lo slug e ci aggiunge il counter
            // $counter++;//aumentiamo il contatore
            // $postFound = Post::where('slug', $alternativeSlug)->first();
            //definiamo una variabile con all'interno il primo slug uguale al nostro slug alternativo
        // }

        // $newPost->slug = $alternativeSlug;
        $newPost->slug = Post::convertToSlug($newPost->title);
        //funzione nel model Post
        $newPost->save();

        if(array_key_exists('tags', $postData)){
            $newPost->tags()->sync($postData['tags']);
            //add tags
        }



        $newPost->save();
        //salviamo il post

        return redirect()->route('admin.posts.index');
        //redirect alla route dove ci sono tutti i post
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        // $post = Post::findOrFail($id);
        if(!$post){
            abort(404);
        }
        // $category = Category::find($post->category_id);
        //al post del findOrFail per provare
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post )
    {
        //
        if(!$post){
            abort(404);
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Post $post)
    {
        //
        $request->validate([
            'title' => 'required|max:250',
            'content' => 'required|min:5',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image'=>'nullable|image'

        ],
        [
            'title.required' =>'Titolo deve essere valorizzato.',
            'title.max' =>'Hai superato i 250 caratteri.',
            'content.required' => 'Il contenuto deve essere compilato.',
            'content.min' => 'Il contenuto deve essere minimo di 5 caratteri.',
            'category_id.exists' => 'La categoria selezionata non esiste',
            'tags' => 'Il tag non esiste',
            'image'=>'il file deve essere un\'immagine'
            //modifichiamo il messaggio di errore standard
        ]);

        // $post = Post::findOrFail($id);
        $postData = $request->all();

        if(array_key_exists('image', $postData)){
            if($post->cover){
                Storage::delete($post->cover);
            }

            $img_path = Storage::put('uploads', $postData['image']);
            $postData['cover'] = $img_path;
        }

        $post->fill($postData);

        $post->slug = Post::convertToSlug($post->title);

        if(array_key_exists('tags', $postData)){
            $post->tags()->sync($postData['tags']);
            //add tags
        }else{
            $post->tags()->sync([]);
        }

        $post->update();

        return redirect()->route('admin.posts.index', compact('post'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        if($post){
            $post->tags()->sync([]);
            if($post->cover){
                Storage::delete($post->cover);
            }
            $post->delete();
        }



        return redirect()->route('admin.posts.index', compact('post'));
    }
}
