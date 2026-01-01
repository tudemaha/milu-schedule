<div class="flex flex-col">
    <div class="flex flex-col text-center gap-0.5">
        <h2 class="text-3xl font-bold">Milu</h2>
        <h3 class="text-2xl font-medium">Schedule Request</h3>
    </div>

    <form action="" class="flex flex-col gap-6">
        <div class="flex flex-col">
            <label for="team">Team</label>
            <select name="team" id="team" wire:model.live="team">
                <option value="" default selected hidden>select your team</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col">
            <label for="name">Name</label>
            <select name="name" id="name">
                <option value="" default selected hidden>select your team</option>
                <option value="1">Mr. Wayan</option>
                <option value="2">Kadek</option>
            </select>
        </div>
    </form>
</div>




