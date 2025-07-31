<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UtilitasPerformanceResource\Pages;
use App\Filament\Resources\UtilitasPerformanceResource\RelationManagers;
use App\Models\Tenant;
use App\Models\UtilitasPerformance;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UtilitasPerformanceResource extends Resource
{
    protected static ?string $model = UtilitasPerformance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Operasional Data';
    protected static ?string $navigationLabel = 'Utilitas Performance';
    protected static ?string $pluralLabel = 'Utilitas Performance';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        $bulan = [
            "januari" => "Januari",
            "februari" => "Februari",
            "maret" => "Maret",
            "april" => "April",
            "mei" => "Mei",
            "juni" => "Juni",
            "juli" => "Juli",
            "agustus" => "Agustus",
            "september" => "September",
            "oktober" => "Oktober",
            "november" => "November",
            "desember" => "Desember",
        ];

        $jenusUtilitas = [
            "listrik" => "Listrik",
            "air_bersih" => "Air Bersih",
            "limbah_cair" => "Limbah Cair",
            "jasa_lain" => "Jasa Lain",
            "tank_farm" => "Tank Farm",
            "dry_port" => "Dry Port",
        ];

        $sumberEnergi = [
            "pln" => "PLN",
            "plts" => "PLTS",
            "pltbg" => "PLTBG",
            "wwtp_tahap_i" => "WWTP Tahap I",
            "wwtp_tahap_ii" => "WWTP Tahap II",
            "wtp_tahap_i" => "WTP Tahap I",
            "wtp_tahap_ii" => "WTP Tahap II",
            "wtp_tahap_iii" => "WTP Tahap III",
        ];

        return $form
            ->schema([
                Select::make('tenant_id')
                    ->label("Nama Tenant")
                    ->native(false)
                    ->required()
                    ->searchable()
                    ->options(Tenant::pluck("nama", "id")->toArray()),
                Select::make('bulan')
                    ->label("Bulan")
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->options($bulan),
                TextInput::make('tahun')
                    ->label("Tahun")
                    ->numeric()
                    ->required(),
                TextInput::make('pelaku_usaha')
                    ->label("Pelaku Usaha")
                    ->required(),
                Select::make('jenis_utilitas')
                    ->label("Jenis Utilisasi")
                    ->required()
                    ->searchable()
                    ->native(false)
                    ->options($jenusUtilitas),
                Select::make('sumber_energi')
                    ->label("Sumber Energi")
                    ->required()
                    ->searchable()
                    ->native(false)
                    ->options($sumberEnergi),
                TextInput::make('penjualan_kuantitas')
                    ->label("Penjualan Kuantitas")
                    ->numeric()
                    ->required(),
                Select::make('satuan')
                    ->label("Satuan")
                    ->required()
                    ->options([
                        "kwh" => "kWh",
                        "m2" => "m²",
                        "m3" => "m³",
                    ]),
                TextInput::make('pendapatan')
                    ->label("Pendapatan")
                    ->prefix("Rp. ")
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tenant.nama')
                    ->searchable(),
                TextColumn::make('bulan')
                    ->searchable(),
                TextColumn::make('tahun')
                    ->searchable(),
                TextColumn::make('pelaku_usaha')
                    ->searchable(),
                TextColumn::make('jenis_utilitas')
                    ->searchable(),
                TextColumn::make('sumber_energi')
                    ->searchable(),
                TextColumn::make('penjualan_kuantitas')
                    ->searchable(),
                TextColumn::make('satuan')
                    ->searchable(),
                TextColumn::make('pendapatan (Rp)')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUtilitasPerformances::route('/'),
            'create' => Pages\CreateUtilitasPerformance::route('/create'),
            'edit' => Pages\EditUtilitasPerformance::route('/{record}/edit'),
        ];
    }
}
