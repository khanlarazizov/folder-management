<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\StoreTagRequest;
use App\Lib\Repositories\Interfaces\ITagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public $tag;

    public function __construct(ITagRepository $tag)
    {
        $this->tag = $tag;
    }

    public function index(Request $request)
    {
        $tags = $this->tag->getAllTagsWithPagination($request);

        return view('tags.index', compact('tags'));
    }

    public function store(StoreTagRequest $request)
    {
        $this->tag->createTag($request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $tag = $this->tag->getTagById($id);

        return response()->json($tag);
    }

    public function update(StoreTagRequest $request, string $id)
    {
        $this->tag->updateTag($id,$request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function destroy(string $id)
    {
        $this->tag->deleteTag($id);
    }
}
