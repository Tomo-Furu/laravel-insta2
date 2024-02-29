<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    private $category;
    private $post;

    public function __Construct(Category $category, Post $post) {
        $this->category = $category;
        $this->post = $post;
    }

    public function index() {
        $all_categories = $this->category->orderBy('updated_at', 'desc')->paginate(10);

        $all_posts = $this->post->all();
        $count= 0;
        foreach($all_posts as $post) {
            if($post->categoryPosts->count() == 0) {
                $count++; //add 1 to count
            }
        }

        return view('admin.categories.index')->with('all_categories', $all_categories)
                                            ->with('uncategorized_count', $count);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:categories,name|max:50'
        ]);

        $this->category->name = $request->name;
        $this->category->save();

        return redirect()->back();
    }

    public function destroy($id) {
        $this->category->destroy($id);

        return redirect()->back();
    }

    public function update($id, Request $request) {
        $request->validate([
            'name' => 'required|max:50|unique:categories,name,'.$id
            //unique:categories,name,5
        ]);

        $category_a = $this->category->findOrFail($id);
        $category_a->name = $request->name;
        $category_a->save();

        return redirect()->back();
    }
}
