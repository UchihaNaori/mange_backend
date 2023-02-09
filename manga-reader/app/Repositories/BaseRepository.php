<?php
    namespace App\Repositories;

    use App\Constants\Constant;
    use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface {
    protected $model;

    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Model
     *
     * @return mixed
     */
    abstract public function model();

    public function makeModel()
    {
        $this->model = app()->make(
            $this->model()
        );
    }

    /**
     * Get all
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Find by id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes = [])
    {
        return $this->model->create($attributes);
    }

    /***
     * Update by id
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updateById($id, array $attributes = [])
    {
        $model = $this->findById($id);
        $model->update($attributes);

        return $model;
    }

    /***
     * Delete id
     *
     * @param $id
     * @return void
     */
    public function deleteById($id)
    {
        $model = $this->findById($id);
        $model->active = Constant::DELETE;
        $model->update();
    }

    /**
     * Delete selected
     *
     * @param $lsId
     * @return void
     */
    public function deleteSelected($lsId)
    {
        foreach ($lsId as $id) {
            $this->deleteById($id);
        }
    }

    /**
     * Change status
     *
     * @param $id
     * @return bool
     */
    public function changeStatus($id)
    {
        $model = $this->findById($id);

        if ($model->published == Constant::ACTIVE) {
            $model->published = Constant::INACTIVE;
            $model->update();
        } elseif ($model->published == Constant::INACTIVE) {
            $model->published = Constant::ACTIVE;
            $model->update();
        }

        return true;
    }

    /**
     * Change order
     *
     * @param $item
     * @return bool
     */
    public function changeChapterNumber($item)
    {
        $model = $this->findById($item['id']);
        $model->sort_order = $item['order'];
        $model->update();

        return true;
    }
}
?>
