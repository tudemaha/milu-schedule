<x-layouts.app>
    <div class="px-2">
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
                    <tr>
                        <th class="border-2 px-2">{{ $requests[0]->employee->name }}</th>
                        <td class="flex flex-wrap gap-3 p-2">
                            @foreach ($requests as $request)
                                <x-request-badge date="{{ $request->date }}" type-id="{{ $request->type_id }}" />
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
        @endforeach
    </div>
</x-layouts.app>