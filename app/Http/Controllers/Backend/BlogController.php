<?php

namespace App\Http\Controllers\Backend;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('blogs.index');

        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('backend.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('blogs.create');
        return view('backend.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('blogs.create');

        $request->validate([
            'title' => 'required|unique:blogs,title',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,bmp,tiff',
        ]);

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/blogs'), $filename);
            }

            Blog::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'image' => $filename,
                'date' => date('Y-m-d'),
                'status' => $request->filled('status')
            ]);

            notify()->success('Blog Created Successfully', 'Success');
            return redirect()->route('blogs.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Blog Create Failed', 'Error');
            return back();
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
        Gate::authorize('blogs.show');

        $blog = Blog::findOrFail($id);
        return view('backend.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('blogs.edit');

        $blog = Blog::findOrFail($id);
        return view('backend.blog.edit', compact('blog'));
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
        Gate::authorize('blogs.edit');

        $request->validate([
            'title' => 'required|unique:blogs,title,' . $id,
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff',
        ]);

        try {
            $blog = Blog::findOrFail($id);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/blogs/' . $blog->image));
                $filename = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/blogs'), $filename);
                $blog->update([
                    "image" => $filename,
                ]);
            }

            $blog->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'status' => $request->filled('status')
            ]);

            notify()->success('Blog Updated Successfully', 'Success');
            return redirect()->route('blogs.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Blog Update Failed', 'Error');
            return back();
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
        Gate::authorize('blogs.destroy');

        try {
            $blog = Blog::findOrFail($id);
            if ($blog->image) {
                @unlink(public_path('upload/blogs/' . $blog->image));
            }
            $blog->delete();
            notify()->success('Blog Deleted Successfully', 'Success');
            return redirect()->route('blogs.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Blog Delete Failed', 'Error');
            return back();
        }
    }
}
