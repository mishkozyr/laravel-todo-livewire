<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class ToDoList extends Component
{
    use WithPagination;

    // задача и ее свойства
    public $task;
    public $id;
    public $title;
    public $description;
    public $priority;
    public $completed;

    // свойство для изменения формы (create, read, update)
    public $mode = 'create';
    public $showPopUp = false;

    // правила валидации
    protected $rules = [
        'title' => 'required|string|max:55',
        'description' => 'required|string|max:255',
        'priority' => 'required|int',
        'completed' => 'bool'
    ];

    public function render()
    {
        $tasks = Task::orderByDesc('created_at')->paginate(5);
        
        return view('livewire.todolist', compact('tasks'))
        ->title('ToDoList');
    }

    public function create()
    {
        $this->mode = 'create';

        $this->togglePopUp();
    }

    public function update($taskId) 
    {
        $this->mode = 'update';

        $this->task = Task::findOrFail($taskId);

        $this->id = $this->task->id;
        $this->title = $this->task->title;
        $this->description = $this->task->description;
        $this->priority = $this->task->priority;
        $this->completed = $this->task->completed;

        $this->togglePopUp();
    }

    public function delete($taskId)
    {
        Task::findOrFail($taskId)->delete();
    }

    public function store()
    {
        $validatedData = $this->validate($this->rules);
        
        // проверяем, есть ли у статьи id (если есть, то это обновление, если нет - создание)
        if ($this->task && $this->task->id) {
            $this->task->update($validatedData);
        } else {
            $this->task = Task::create($validatedData);
        }

        // сбрасываем свойства формы и скрываем попап
        $this->togglePopUp();
    }

    public function togglePopUp()
    {
        $this->showPopUp = !$this->showPopUp;

        if (!$this->showPopUp) {
            $this->reset([
                'task', 'id', 'title', 'description', 'priority', 'completed', 'mode'
            ]);
        }
    }
}
