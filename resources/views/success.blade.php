<x-layouts.app>
    <div class="min-h-screen flex items-center justify-center px-2">
        <div class="flex flex-col text-center">
            <div class="text-2xl">{{ request('name') != null ? 'Hi, '.request('name').'! ' : '' }}Your request submitted successfully.</div>
            <a class="text-blue-400 underline hover:text-blue-500" href="/">Go to home.</a>
        </div>
    </div>
</x-layouts.app>