<?php

namespace App\Filament\Widgets;

use App\Models\Pembelian;
use Filament\Actions\BulkActionGroup;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PembelianSelesaiTable extends TableWidget
{
    protected static ?string $heading = 'Daftar Transaksi Selesai';

    // ✅ Membuat widget full lebar
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder =>
                Pembelian::query()
                    ->with('user')
                    ->where('status', 'Selesai')
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Pembeli')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email'),

                Tables\Columns\TextColumn::make('kode_pembelian')
                    ->label('Kode Pembelian')
                    ->searchable(),

                Tables\Columns\TextColumn::make('banyak')
                    ->label('Jumlah'),

                Tables\Columns\TextColumn::make('bayar')
                    ->label('Total Bayar')
                    ->money('IDR', true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Transaksi')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public static function canView(): bool
    {
        return Auth::user()->role === 'Admin';
    }
}
