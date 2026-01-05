<div class="flex flex-col md:p-15 p-5">
    <div class="flex flex-col text-center gap-0.5">
        <h2 class="text-3xl font-bold">Milu</h2>
        <h3 class="text-2xl font-medium">Schedule Request</h3>
        <a href="/recap" class="text-blue-400 underline flex justify-center hover:text-blue-500" target="_blank">
            Request Recap
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M11 5h-6v14h14v-6"/>
                        <path d="M13 11l7 -7"/>
                        <path d="M21 3h-6M21 3v6"/>
                    </g>
                </svg>
            </span>
        </a>
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
            @error("teamID")
                <div class="text-red-400 text-sm">{{ $message }}</div>
            @enderror
        </div>

        @if ($teamID != 0)
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
                @error("employeeID")
                    <div class="text-red-400 text-sm">{{ $message }}</div>
                @enderror
            </div>
        @endif
        
       
        @if (count($offRequests) > 0)
            <div class="flex flex-col gap-1">
                <div class="font-medium">
                    <div class="flex items-center gap-2">
                        Off List
                        <button class="cursor-pointer" wire:click.prevent="updateOffRequests({{ $teamID }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <table class="border-2 border-gray-400">
                    <tr>
                        <td class="text-sm text-center border-2 border-gray-400">Date</td>
                        @foreach ($offRequests as $off)
                            <td class="text-sm text-center border-2 border-gray-400 {{ ($teamID == 1 && $off->total >= 3) || ($teamID > 1 && $off->total >= 2) ? 'bg-red-300' : ''}}">
                                {{ substr($off->date, 8, 2) }}-{{ substr($off->date, 5, 2) }}
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="text-sm text-center border-2 border-gray-400">Total</td>
                        @foreach ($offRequests as $off)
                            <td class="text-center border-2 border-gray-400 {{ ($teamID == 1 && $off->total >= 3) || ($teamID > 1 && $off->total >= 2) ? 'bg-red-300' : ''}}">
                                {{ $off->total }}
                            </td>
                        @endforeach
                    </tr>  
                </table>
            </div>
        @endif

        @foreach ($requests as $index => $request)
            <div class="flex gap-2 md:gap-4 items-stretch">
                <div class="flex flex-col gap-1 flex-1">
                    <label for="date" class="font-medium">
                        Request Date
                        <span class="text-red-400">*</span>
                    </label>
                    <input type="date" min={{ $nextWeekStartDate }} max={{ $nextWeekEndDate }} required wire:model.blur="requests.{{ $index }}.date"
                        class="outline-2 outline-gray-400 rounded-lg py-1 active:border-rose-300 px-2 {{ $request['date'] != '' ? 'text-black' : 'text-gray-400' }}">
                    @error("requests.$index.date")
                        <div class="text-red-400 text-sm">{{ $message }}</div>
                    @enderror
                    @error("requests.$index.date_error")
                        <div class="text-red-400 text-sm">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="flex flex-col gap-1 flex-1">
                    <label for="date" class="font-medium">
                        Request Type
                        <span class="text-red-400">*</span>
                    </label>
                    <select name="type" id="type" required wire:model.blur="requests.{{ $index }}.type_id" 
                        class="outline-2 outline-gray-400 rounded-lg py-1.5 active:border-rose-300 px-2 {{ $request['type_id'] != 0 ? 'text-black' : 'text-gray-400' }}">
                        <option value="0" default selected hidden>Select type</option>
                        @foreach ($types as $type)
                            <option value={{ $type->id }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error("requests.$index.type_id")
                        <div class="text-red-400 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                @if (count($requests) > 1)
                    <button wire:click.prevent="remove({{ $index }})" class="cursor-pointer px-3 bg-red-400 rounded-lg text-3xl text-white">-</button>
                @endif
            </div>
        @endforeach
        
        <div>
            <button wire:click.prevent="add" class="text-center cursor-pointer bg-blue-400 text-white font-medium py-1.5 rounded-lg px-4">+ Add</button>
        </div>

        <button  class="cursor-pointer bg-green-600 text-white font-medium py-1.5 rounded-lg px-4 flex gap-3 justify-center">
            Submit
            <div wire:loading wire:target="save">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3c4.97 0 9 4.03 9 9"><animateTransform attributeName="transform" dur="1.5s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg>
            </div>
        </button>
    </form>
</div>