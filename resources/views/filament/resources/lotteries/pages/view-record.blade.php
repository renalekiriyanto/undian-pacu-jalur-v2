<x-filament-panels::page>
    @if ($this->hasInfolist())

        <div class="card">
            <table class="">
                <thead>
                    <th>Action</th>
                    <th>No.</th>
                    <th>Kiri</th>
                    <th>Asal</th>
                    <th>No.</th>
                    <th>Kanan</th>
                    <th>Asal</th>
                </thead>
                <tbody>
                    @foreach ($this->infolist as $item)
                        @foreach ($item->games->sortBy('urutan_hilir') as $item2)
                            <tr>
                                <td>
                                    <x-filament::input.wrapper>
                                        <x-filament::input.select wire:model="status_game"
                                            wire:change="changeStatus({{ $item2->id }}, $event.target.value)"
                                            wire:key="{{ $item2->id }}">
                                            @foreach (['PENDING', 'LIVE', 'FAILED', 'ANNOUNCEMENT', 'DONE'] as $status)
                                                <option value="{{ $status }}"
                                                    @if ($item2->status === $status) selected @endif>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </x-filament::input.select>
                                    </x-filament::input.wrapper>

                                    <x-filament::input.wrapper>
                                        <x-filament::input.select
                                            wire:change="updatePemenang({{ $item2->id }}, $event.target.value)"
                                            wire:key="{{ $item2->id }}">
                                            <option value="">--Pilih Pemenang--</option>
                                            @foreach ([$item2->name_jalur_kiri, $item2->name_jalur_kanan] as $pemenang)
                                                <option value="{{ $pemenang->name }}"
                                                    @if ($item2->pemenang === $pemenang->id) selected @endif>
                                                    {{ $pemenang->name }}
                                                </option>
                                            @endforeach
                                        </x-filament::input.select>
                                    </x-filament::input.wrapper>
                                </td>
                                <td>{{ $item2->urutan_hilir }}</td>
                                <td {{ $item2->pemenang === $item2->name_jalur_kiri->id ? 'class=pemenang' : '' }}>
                                    {{ $item2->name_jalur_kiri->name }}
                                </td>
                                <td {{ $item2->pemenang === $item2->name_jalur_kiri->id ? 'class=pemenang' : '' }}>
                                    {{ $item2->name_jalur_kiri->region->name }}/{{ $item2->name_jalur_kiri->region->district->slug }}
                                <td>{{ $item2->urutan_hilir }}</td>
                                <td {{ $item2->pemenang === $item2->name_jalur_kanan->id ? 'class=pemenang' : '' }}>
                                    {{ $item2->name_jalur_kanan->name }}</td>
                                <td {{ $item2->pemenang === $item2->name_jalur_kanan->id ? 'class=pemenang' : '' }}>
                                    {{ $item2->name_jalur_kanan->region->name }}/{{ $item2->name_jalur_kanan->region->district->slug }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        {{ $this->form }}
    @endif

    @if (count($relationManagers = $this->getRelationManagers()))
        <x-filament-panels::resources.relation-managers :active-manager="$this->activeRelationManager" :managers="$relationManagers" :owner-record="$record"
            :page-class="static::class" />
    @endif

    <style>
        table {
            border-collapse: collapse;
        }

        .pemenang {
            background-color: greenyellow;
        }

        th,
        td {
            border: 1px solid #ccc;
        }
    </style>
</x-filament-panels::page>
