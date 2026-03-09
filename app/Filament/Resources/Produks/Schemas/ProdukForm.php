<?php

namespace App\Filament\Resources\Produks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('tipe')
                    ->required(),
                TextInput::make('jenis')
                    ->required(),
                TextInput::make('harga')
                    ->required()
                    ->numeric(),
                TextInput::make('stok')
                ->required()
                ->numeric()
                ->default(1)
                ->rule('min:1') // ini server-side validation
                ->helperText('Masukkan stok minimal 1'),
                FileUpload::make('image')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
