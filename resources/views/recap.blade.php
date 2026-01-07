<x-layouts.app>
    <div class="p-3">
        <h2 class="text-center font-bold text-2xl">Recap</h2>
        <h3 class="text-center font-medium text-xl">{{$startDate}} until {{$endDate->format('Y-m-d')}}</h3>

        <a href="/" class="text-blue-400 underline flex hover:text-blue-500">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12l7 -7M8 12l7 7"/>
                </svg>
            </span>
            Home
        </a>

        @foreach ($recap as $team_id => $employees)
            @switch($team_id)
                @case(1)
                    <div class="text-2xl font-medium mt-3 mb-1">Hot Kitchen</div>
                    @break
                @case(2)
                    <div class="text-2xl font-medium mt-3 mb-1">Plating</div>
                @break
                @case(3)
                    <div class="text-2xl font-medium mt-3 mb-1">Steward</div>
                @break
            @endswitch

            <table class="border-2">
                @foreach ($employees as $requests)
                    <tr class="border-2">
                        <th class="border-2 px-2">{{ $requests[0]->employee->name }}</th>
                        <td class="flex flex-wrap gap-3 p-2">
                            @foreach ($requests as $request)
                                <x-request-badge date="{{ $request->date }}" type-id="{{ $request->type_id }}" reason="{{ $request->reason }}" />
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
        @endforeach
    </div>
</x-layouts.app>