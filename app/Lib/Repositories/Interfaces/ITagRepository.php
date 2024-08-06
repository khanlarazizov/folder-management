<?php

namespace App\Lib\Repositories\Interfaces;

interface ITagRepository
{
    public function getAllTags();

    public function getAllTagsWithPagination($data);

    public function getTagById($id);

    public function createTag($data);

    public function updateTag($id, $data);

    public function deleteTag($id);

}
