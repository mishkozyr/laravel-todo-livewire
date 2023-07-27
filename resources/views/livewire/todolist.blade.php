<div class="max-w-screen mx-5 flex flex-col">

    <button wire:click="create()"
        class="w-max flex flex-row items-center h-12 px-4 mt-4 rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer">
        <span class="flex items-center justify-center text-lg text-green-400">
            <svg fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                stroke="currentColor"
                class="h-6 w-6">
                <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </span>
        <span class="ml-3">New task</span>
    </button>
    
    <!-- таблица -->
    <div class="rounded-lg border border-gray-200 shadow-md my-5 w-full">
  
        <table class="w-full border-collapse bg-white text-center text-sm text-gray-500">
  
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-2 pl-4 py-4 font-medium text-gray-900">Title</th>
            <th scope="col" class="px-2 py-4 font-medium text-gray-900 ">Description</th>
            <th scope="col" class="px-2 py-4 font-medium text-gray-900">Priority</th>
            <th scope="col" class="px-2 py-4 font-medium text-gray-900">Completed</th>
            <th scope="col" class="px-2 pr-4 py-4 font-medium text-gray-900">Buttons</th>
          </tr>
        </thead>
  
        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
  
            @foreach ($tasks as $task)
            
                <tr wire:key="{{ $task->id }}" class="hover:bg-gray-50">
                    <td class="px-2 pl-4 py-4">
                        <div class="text-sm font-normal text-gray-900">
                            <div class="font-medium text-gray-700">{{ $task->title }}</div>
                        </div>
                    </td>
        
                    <td class="px-2 py-4">
                        {{ $task->description }}
                    </td>  
        
                    <td class="px-2 py-4">
        
                        @if ($task->priority === 0)
                            <span class="inline-flex items-center gap-1 rounded-full 
                                bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                low priority
                            </span>
                        @elseif ($task->priority === 1)
                            <span class="inline-flex items-center gap-1 rounded-full 
                                bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                normal priority
                            </span>
                        @else 
                            <span class="inline-flex items-center gap-1 rounded-full 
                                bg-red-50 px-2 py-1 text-xs font-semibold text-red-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                high priority
                            </span>
                        @endif
                    </td>

                    <td class="px-2 py-4">
        
                        @if ($task->completed)
                            <span class="inline-flex items-center gap-1 rounded-full 
                                bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                completed
                            </span>
                        @else 
                            <span class="inline-flex items-center gap-1 rounded-full 
                                bg-red-50 px-2 py-1 text-xs font-semibold text-red-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                not completed
                            </span>
                        @endif
                    </td>
        
                    <td class="px-2 pr-4 py-4 flex justify-center">
                        <div class="flex justify-end gap-4">
                            <button wire:click="update({{ $task->id }})" 
                                class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="h-6 w-6"
                                    x-tooltip="tooltip">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 
                                        19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 
                                        4.487zm0 0L19.5 7.125"
                                    />
                                </svg>
                            </button>
            
                            <button @click="if (confirm('Are you sure you want to delete this task?')) {
                                $wire.delete({{ $task->id }})}" class="cursor-pointer">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="h-6 w-6"
                                    x-tooltip="tooltip">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 
                                        1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 
                                        2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 
                                        .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 
                                        013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 
                                        1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                    />
                                </svg>
                            </button>
            
                        </div>
                    </td>
                    
                </tr>

            @endforeach
  
        </tbody>
  
      </table>
  
    </div>

    @if ($showPopUp)

        <div class="relative z-10">

            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            
            <div class="fixed inset-0 z-10 overflow-y-auto">

                <div wire:click='togglePopUp()' class="flex min-h-full items-center justify-center p-4">

                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">

                        <div @click.stop class="w-auto">
                            
                            <form wire:submit="store()">

                                <div class="p-5">

                                    <div class="border-b border-gray-900/10 pb-4">
                                        <h2 class="text-base text-center font-semibold leading-7 text-gray-900">
                                            {{ $mode === 'create' ? 'Create task' : 'Edit task' }}
                                        </h2>

                                        <div class="mt-2">

                                            <div class="flex flex-col">

                                                {{-- title --}}
                                                <div class="w-full">
                                                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900">
                                                        Title
                                                    </label>

                                                    <div>
                                                        @error('title') <span class="error">{{ $message }}</span> @enderror 
                                                    </div>

                                                    <div class="mt-2">
                                                        <input wire:model="title" type="text" name="Title"
                                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 
                                                            ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset 
                                                            focus:ring-indigo-600"
                                                        />
                                                    </div>
                                                </div>

                                                {{-- description --}}
                                                <div>
                                                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">
                                                        Description
                                                    </label>

                                                    <div>
                                                        @error('description') <span class="error">{{ $message }}</span> @enderror 
                                                    </div>

                                                    <div class="mt-2">
                                                        <textarea wire:model="description" title="Description"
                                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 
                                                            ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset 
                                                            focus:ring-indigo-600">
                                                        </textarea>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="flex items-center justify-between mt-4">

                                        <div>
                                            @error('priority') <span class="error">{{ $message }}</span> @enderror 
                                        </div>

                                        {{-- priority --}}
                                        <fieldset class="mr-4">
                                            <div class="flex items-center gap-x-3 w-full">
                                                <input title="priority" type="radio" value="0" wire:model="priority"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                />

                                                <label for="priority" class="block text-sm font-medium leading-6 
                                                    text-gray-900">
                                                    low priority
                                                </label>
                                            </div>
                                        
                                            <div class="flex items-center gap-x-3 w-full">
                                                <input title="priority" type="radio" value="1" wire:model="priority"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                />

                                                <label for="priority" class="block text-sm font-medium leading-6 
                                                    text-gray-900">
                                                    normal  priority 
                                                </label>
                                            </div>

                                            <div class="flex items-center gap-x-3 w-full">
                                                <input title="priority" type="radio" value="2" wire:model="priority"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                />

                                                <label for="priority" class="block text-sm font-medium leading-6 
                                                    text-gray-900">
                                                    high priority
                                                </label>
                                            </div>
                                        </fieldset>
                                

                                        <div class="items-center">
                                            @if ($mode === 'update')
                                                {{-- completed --}}
                                                <fieldset class="mr-4">
                                                    <div class="flex items-center gap-x-3 w-full">
                                                        <input title="completed" type="radio" value="1" wire:model="completed"
                                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                        />

                                                        <label for="completed" class="block text-sm font-medium leading-6 
                                                            text-gray-900">
                                                            completed 
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            @endif
                                            <button wire:click="togglePopUp()" type="button" 
                                                class="inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm 
                                                font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                                                hover:bg-gray-50">
                                                Cancel
                                            </button>

                                            <button type="submit"
                                                class="inline-flex justify-center rounded-md bg-green-600 px-3 py-2 text-sm 
                                                font-semibold text-white shadow-sm hover:bg-green-500">
                                                {{ $mode === 'create' ? 'Add' : 'Save' }}
                                            </button>
                                        </div>

                                    </div>

                                </div>
                    
                            </form>

                        </div>
                        
                    </div>

                </div>

            </div>

        </div>

    @else

        {{-- pagination  --}}
        {{ $tasks->links() }}

    @endif

</div>