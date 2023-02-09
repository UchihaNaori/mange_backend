<?php
    namespace App\Services;

    use App\Models\TaskType;
    use App\Repositories\TaskTypeRepository;
    use Illuminate\Console\View\Components\Task;

    class TaskTypeService {
        protected $taskTypeRrepository;

        public function __construct(TaskTypeRepository $taskTypeRepository)
        {
            $this->taskTypeRrepository = $taskTypeRepository;
        }

        public function index()
        {
            return $this->taskTypeRrepository->getList();
        }

        public function fillData($request)
        {
            return [
                'title' => $request->title,
                'icon' => $request->icon,
                'color' => $request->color
            ];
        }

        public function create($request)
        {
            $data = $this->fillData($request);

            return $this->taskTypeRrepository->create($data);
        }

        public function delete($id) {
          $taskType = TaskType::where('id', $id);
          $taskType->delete();

          return $taskType->first();
        }

        public function updateTaskType($id, $request)
        {
            $data = $this->fillData($request);
            $taskType = $this->taskTypeRrepository->updateById($id, $data);

            return $taskType;
        }
    }
?>
