<div class="flex flex-col">
    <div class="flex flex-col text-center gap-0.5">
        <h2 class="text-3xl font-bold">Milu</h2>
        <h3 class="text-2xl font-medium">Schedule Request</h3>
    </div>

    <form action="" class="flex flex-col gap-6" wire:submit="save">
        <div class="flex flex-col gap-1">
            <label for="team" class="font-medium">
                Team
                <span class="text-red-400">*</span>
            </label>
            <select name="team" id="team" required wire:model.live="teamID"
                class="outline-2 outline-gray-400 rounded-lg py-1.5 active:border-rose-300 px-2 {{ $teamID != 0 ? 'text-black' : 'text-gray-400' }}">
                <option value="0" default selected hidden>Select team</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- @if($teamID != 0) --}}
            <div class="flex flex-col gap-1">
                <label for="name" class="font-medium">
                    Name
                    <span class="text-red-400">*</span>
                </label>
                <select name="name" id="name" required wire:model.blur="employeeID"
                    class="outline-2 outline-gray-400 rounded-lg py-1.5 active:border-rose-300 px-2 {{ $employeeID != '' ? 'text-black' : 'text-gray-400' }}">
                    <option value="0" default selected hidden>Select name</option>
                    @foreach ($employees as $employee)
                        <option value={{ $employee->id }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
        {{-- @endif --}}

        @foreach ($requests as $index => $request)
            <div class="flex gap-3 md:gap-4 justify-start items-end">
                <div class="flex flex-col gap-1 flex-1">
                    <label for="date" class="font-medium">
                        Request Date
                        <span class="text-red-400">*</span>
                    </label>
                    <input type="date" min={{ $nextWeekStartDate }} max={{ $nextWeekEndDate }} required wire:model.blur="requests.{{ $index }}.date"
                        class="outline-2 outline-gray-400 rounded-lg py-1 active:border-rose-300 px-2 {{ $request['date'] != '' ? 'text-black' : 'text-gray-400' }}">
                </div>
    
                <div class="flex flex-col gap-1 flex-1">
                    <label for="date" class="font-medium">
                        Request Type
                        <span class="text-red-400">*</span>
                    </label>
                    <select name="type" id="type" required wire:model.blur="requests.{{ $index }}.type_id" 
                        class="outline-2 outline-gray-400 rounded-lg py-1.5 active:border-rose-300 px-2 {{ $request['type_id'] != 0 ? 'text-black' : 'text-gray-400' }}">
                        <option value="0" default selected hidden>Select request type</option>
                        @foreach ($types as $type)
                            <option value={{ $type->id }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                @if (count($requests) > 1)
                    <button wire:click.prevent="remove({{ $index }})" class="cursor-pointer px-3 bg-red-400 rounded-lg text-3xl text-white {{ $requests[$index] != '' ? 'text-black' : 'text-gray-400' }}">-</button>
                @endif
            </div>
        @endforeach
        
        <div>
            <button wire:click.prevent="add" class="text-center cursor-pointer bg-blue-400 text-white font-medium py-1.5 rounded-lg px-4">+ Add</button>
        </div>

        <button  class="text-center cursor-pointer bg-green-600 text-white font-medium py-1.5 rounded-lg px-4">Submit</button>
    </form>
</div>