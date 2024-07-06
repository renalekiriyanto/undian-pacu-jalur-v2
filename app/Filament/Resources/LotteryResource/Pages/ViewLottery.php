<?php

namespace App\Filament\Resources\LotteryResource\Pages;

use App\Filament\Resources\LotteryResource;
use App\Models\Canoe;
use App\Models\Game;
use App\Models\Status;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class ViewLottery extends ViewRecord
{
    protected static string $resource = LotteryResource::class;
    protected static string $view = 'filament.resources.lotteries.pages.view-record';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            TextColumn::make('games')
        ];
    }

    public function openNewUserModal()
    {
        dd('asdasd');
    }

    public function changeStatus($id, $state)
    {
        $data = Game::find($id);
        $data->update([
            'status' => $state
        ]);

        $data->save();
    }

    public function updatePemenang($id, $state)
    {
        $data = Game::find($id);
        $jalur = Canoe::where('slug', Str::slug($state))->first();
        $data->update([
            'pemenang' => $jalur->id
        ]);

        $data->save();
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['games'] = $this->record;
        $data['status_list'] = Status::all()->pluck('name', 'id');

        return $data;
    }
}
