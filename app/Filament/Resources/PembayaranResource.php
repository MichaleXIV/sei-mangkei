<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use App\Models\Pembayaran;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Operasional Data';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $pluralLabel = 'Pembayaran';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("tenant_id")
                    ->required()
                    ->native(false)
                    ->label("Nama Tenant")
                    ->options(Tenant::pluck("nama", "id")->toArray())
                    ->searchable(),
                TextInput::make("kontrak")
                    ->required()
                    ->label("Nomor Kontrak")
                    ->placeholder("Nomor Kontrak"),
                DatePicker::make('kontrak_date')
                    ->label('Tanggal Kontrak')
                    ->placeholder("Tanggal Kontrak")
                    ->required()
                    ->native(false),
                TextInput::make("masa_sewa")
                    ->label("Masa Sewa")
                    ->placeholder("Masa Sewa")
                    ->required()
                    ->numeric(),
                TextInput::make("investasi")
                    ->label("Realisasi Investasi")
                    ->placeholder("Realisasi Investasi")
                    ->required()
                    ->numeric(),
                TextInput::make('kontrak_nilai')
                    ->label('Nilai Kontrak')
                    ->placeholder("Nilai kontrak")
                    ->prefix("Rp.")
                    ->required()
                    ->numeric(),
                TextInput::make('pembayaran_termin')
                    ->label('Termin Pembayaran')
                    ->placeholder("Termin Pembayaran")
                    ->required(),
                TextInput::make('nilai')
                    ->label('Nilai')
                    ->placeholder("Nilai")
                    ->prefix("Rp.")
                    ->required()
                    ->numeric(),
                TextInput::make('persentase')
                    ->label('Persentase')
                    ->placeholder("Persentase")
                    ->suffix("%")
                    ->required()
                    ->numeric(),
                DatePicker::make('date')
                    ->label('Tanggal Pembayaran')
                    ->placeholder("Tanggal Pembayaran")
                    ->required()
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tenant')
                    ->label("Nama Tenant")
                    ->searchable(),
                TextColumn::make("kontrak")
                    ->label("Nomor Kontrak")
                    ->searchable(),
                TextColumn::make('kontrak_date')
                    ->label("Tanggal Kontrak")
                    ->searchable(),
                TextColumn::make('masa_sewa')
                    ->searchable(),
                TextColumn::make("investasi")
                    ->label("Realisasi Investasi")
                    ->searchable(),
                TextColumn::make('kontrak_nilai')
                    ->searchable(),
                TextColumn::make('pembayaran_termin')
                    ->searchable(),
                TextColumn::make('nilai')
                    ->searchable(),
                TextColumn::make('persentase')
                    ->searchable(),
                TextColumn::make('date')
                    ->label("Tanggal Pembayaran")
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
