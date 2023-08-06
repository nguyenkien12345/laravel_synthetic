<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class InfiniteScrollPaginationController extends Controller
{
    public function index() {
        $blogs = Blog::paginate(10);
        return view('infinite-scroll-pagination.index', compact('blogs'));
    }

    public function getMoreBlogInfiniteScroll(Request $request) {
        $blogs = Blog::paginate(10);
        $html = view('infinite-scroll-pagination.blog-row', compact('blogs'))->render();
        return response()->json([
            'message' => 'success',
            'status' => true,
            'html' => $html
        ]);
    }
}
