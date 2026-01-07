
@switch($typeId)
    @case(1)
        <div class="flex gap-1 bg-red-400 py-1 px-2 rounded-lg outline-2 outline-red-500 text-white">
            <div>{{ $date }}</div>
            <span>|</span>
            <div class="font-semibold">OFF</div>
            @if ($reason != '')                
                <span>|</span>
                <div>{{ $reason }}</div>
            @endif
        </div>
    @break
    @case(2)
        <div class="flex gap-1 bg-gray-400 py-1 px-2 rounded-lg outline-2 outline-gray-500 text-white">
            <div>{{ $date }}</div>
            <span>|</span>
            <div class="font-semibold">Morning (M)</div>
            @if ($reason != '')                
                <span>|</span>
                <div>{{ $reason }}</div>
            @endif
        </div>
    @break
    @case(3)
        <div class="flex gap-1 bg-gray-400 py-1 px-2 rounded-lg outline-2 outline-gray-500 text-white">
            <div>{{ $date }}</div>
            <span>|</span>
            <div class="font-semibold">Evening (E)</div>
            @if ($reason != '')                
                <span>|</span>
                <div>{{ $reason }}</div>
            @endif
        </div>
    @break
    @case(4)
        <div class="flex gap-1 bg-green-500 py-1 px-2 rounded-lg outline-2 outline-green-600">
            <div>{{ $date }}</div>
            <span>|</span>
            <div class="font-semibold">AL</div>
            @if ($reason != '')                
                <span>|</span>
                <div>{{ $reason }}</div>
            @endif
        </div>
    @break
    @case(5)
        <div class="flex gap-1 bg-orange-500 py-1 px-2 rounded-lg outline-2 outline-orange-600 text-white">
            <div>{{ $date }}</div>
            <span>|</span>
            <div class="font-semibold">SL</div>
            @if ($reason != '')                
                <span>|</span>
                <div>{{ $reason }}</div>
            @endif
        </div>
    @break
    @default
        
@endswitch