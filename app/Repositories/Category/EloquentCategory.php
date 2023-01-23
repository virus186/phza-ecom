<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EloquentCategory extends EloquentRepository implements BaseRepository, CategoryRepository
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function all()
    {
        return $this->model->with(
            'subGroup:id,name,category_group_id,deleted_at',
            'subGroup.group:id,name,deleted_at',
            'featureImage',
            'coverImage'
        )->withCount('products', 'listings')->get();
    }

    public function trashOnly()
    {
        return $this->model->with(
            'subGroup:id,name,category_group_id,deleted_at',
            'subGroup.group:id,name,deleted_at'
        )->onlyTrashed()->get();
    }

    //Create Category
    public function store(Request $request)
    {
        $result = parent::store($request);

        $this->clear_cache($result);

        return $result;
    }

    public function update(Request $request, $id)
    {
        $result = parent::update($request, $id);

        $this->clear_cache($result);

        return $result;
    }

    public function destroy($id)
    {
        $category = parent::findTrash($id);

        $category->flushImages();

        $result = $category->forceDelete();

        $this->clear_cache($result);

        return $result;
    }

    public function massDestroy($ids)
    {
        $catSubGrps = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($catSubGrps as $catSubGrp) {
            $catSubGrp->flushImages();
        }

        $result = parent::massDestroy($ids);

        $this->clear_cache($result);

        return $result;
    }

    public function emptyTrash()
    {
        $catSubGrps = $this->model->onlyTrashed()->get();

        foreach ($catSubGrps as $catSubGrp) {
            $catSubGrp->flushImages();
        }

        $result = parent::emptyTrash();

        $this->clear_cache($result);

        return $result;
    }

    private function clear_cache($result = false)
    {
        if ($result) {
            Cache::forget('category_list_for_form');

            return true;
        }

        return false;
    }
}
