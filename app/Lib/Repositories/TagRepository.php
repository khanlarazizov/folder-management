<?php

namespace App\Lib\Repositories;

use App\Lib\Repositories\Interfaces\ITagRepository;
use App\Models\Tag;

class TagRepository implements ITagRepository
{

    public function getAllTags()
    {
        return Tag::all();
    }

    public function getAllTagsWithPagination($data)
    {
        return Tag::name($data['name'])->paginate(5);
    }

    public function getTagById($id)
    {
        return Tag::find($id);
    }

    public function createTag($data)
    {
        return Tag::create($data);
    }

    public function updateTag($id, $data)
    {
        $tag = Tag::find($id);

        return $tag->update($data);
    }


    public function deleteTag($id)
    {
        $tag = Tag::find($id);

        return $tag->delete();
    }
}
