<?php

namespace App\Filament\Resources\Produks\Pages;

use App\Filament\Resources\Produks\ProdukResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateProduk extends CreateRecord
{
    protected static string $resource = ProdukResource::class;

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label(__('filament-panels::resources/pages/create-record.form.actions.create.label'))
            ->requiresConfirmation()
            ->modalIcon('heroicon-o-information-circle')
            ->modalHeading('Simpan Data Produk?')
            ->modalDescription('Apakah Anda yakin ingin menambahkan produk baru?')
            ->modalSubmitActionLabel('OK')
            ->modalCancelActionLabel('Batal')
            ->action(fn () => $this->create());
    }
}
