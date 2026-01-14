<div class="flex flex-col md:p-15 p-5">
    <div class="flex flex-col text-center gap-0.5 mb-4">
        <h2 class="text-3xl font-bold">Set Password</h2>
        <p class="text-sm">
            This password will be used to submit your requested schedule.
            Store and remember your password. You will need to contact the administrator to reset your password.
        </p>
    </div>

    <form class="flex flex-col gap-6" wire:submit="save">
        <div class="flex gap-2">
            <div class="flex flex-col gap-1 flex-1">
                <label for="team" class="font-medium">
                    Team
                    <span class="text-red-400">*</span>
                </label>
                <input type="text" id="team" name="team" disabled value="{{ $team }}"
                    class="w-full outline-2 outline-gray-400 rounded-lg py-1 px-2 text-black bg-gray-100">
            </div>

            <div class="flex flex-col gap-1 flex-1">
                <label for="name" class="font-medium">
                    Name
                    <span class="text-red-400">*</span>
                </label>
                <input type="text" id="name" name="name" disabled value="{{ $name }}""
                    class="w-full outline-2 outline-gray-400 rounded-lg py-1 px-2 text-black bg-gray-100">
            </div>
        </div>

        <div class="flex flex-col gap-1 flex-1">
            <label for="password" class="font-medium">
                Password
                <span class="text-red-400">*</span>
            </label>
            <input type="password" id="password" name="password" wire:model.blur="password" required
                placeholder="Type your password"
                class="outline-2 outline-gray-400 rounded-lg py-1 active:border-rose-300 px-2 {{ $password != '' ? 'text-black' : 'text-gray-400' }}">
            @error('password')
                <div class="text-red-400 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-1 flex-1">
            <label for="repeat-password" class="font-medium">
                Repeat Password
                <span class="text-red-400">*</span>
            </label>
            <input type="password" id="repeat-password" name="repeat-password" wire:model.blur="passwordRepeat" required
                placeholder="Retype your password"
                class="outline-2 outline-gray-400 rounded-lg py-1 active:border-rose-300 px-2 {{ $passwordRepeat != '' ? 'text-black' : 'text-gray-400' }}">
            @error('passwordRepeat')
                <div class="text-red-400 text-sm">{{ $message }}</div>
            @enderror
        </div>

        @error('filled')
                <div class="text-red-400 text-sm">{{ $message }}</div>
            @enderror

        <button  class="cursor-pointer bg-green-600 text-white font-medium py-1.5 rounded-lg px-4 flex gap-3 justify-center">
            Submit
            <div wire:loading wire:target="save">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3c4.97 0 9 4.03 9 9"><animateTransform attributeName="transform" dur="1.5s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg>
            </div>
        </button>
    </form>

</div>
