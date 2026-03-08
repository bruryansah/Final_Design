<?php

namespace App\Filament\Resources\Pembelians\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PembelianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_pembelian')
                    ->required(),
                TextInput::make('produk_id')
                    ->required()
                    ->numeric(),
                TextInput::make('banyak')
                    ->required()
                    ->numeric(),
                TextInput::make('bayar')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
                        'Verifikasi' => 'Verifikasi',
                        'Proses' => 'Proses',
                        'Kirim' => 'Kirim',
                        'Sampai' => 'Sampai',
                        'Selesai' => 'Selesai',
                    ])
                    ->required(),
            ]);
    }
}
