<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RkapResource\Pages;
use App\Filament\Resources\RkapResource\RelationManagers;
use App\Models\Rkap;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RkapResource extends Resource
{
    protected static ?string $model = Rkap::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Operasional Data';
    protected static ?string $navigationLabel = 'RKAP';
    protected static ?string $pluralLabel = 'RKAP';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('pemasaran_rp')
                    ->label('Pemasaran (RP)')
                    ->placeholder("Pemasaran (RP)")
                    ->prefix("Rp. ")
                    ->numeric()
                    ->required(),
                TextInput::make('pemasaran_ha')
                    ->label('Pemasaran (HA)')
                    ->placeholder("Pemasaran (HA)")
                    ->suffix("ha")
                    ->numeric()
                    ->required(),
                TextInput::make('air_bersih_rp')
                    ->label('Air Bersih (RP)')
                    ->placeholder("Air Bersih (RP)")
                    ->prefix("Rp. ")
                    ->numeric()
                    ->required(),
                TextInput::make('air_bersih_m3')
                    ->label('Air Bersih (m³)')
                    ->placeholder("Air Bersih (m³)")
                    ->suffix("m³")
                    ->numeric()
                    ->required(),
                TextInput::make('limbah_cair_rp')
                    ->label('Limbah Cair (RP)')
                    ->placeholder("Limbah Cair (RP)")
                    ->prefix("Rp. ")
                    ->numeric()
                    ->required(),
                TextInput::make('limbah_cair_m3')
                    ->label('Limbah Cair (m³)')
                    ->placeholder("Limbah Cair (m³)")
                    ->suffix("m³")
                    ->numeric()
                    ->required(),
                TextInput::make('listrik_rp')
                    ->label('Listrik (RP)')
                    ->placeholder("Listrik (RP)")
                    ->prefix("Rp. ")
                    ->numeric()
                    ->required(),
                TextInput::make('listrik_kwh')
                    ->label('Listrik (kWh)')
                    ->placeholder("Listrik (kWh)")
                    ->suffix("kWh")
                    ->numeric()
                    ->required(),
                TextInput::make('investasi')
                    ->label('RKAP Investasi')
                    ->placeholder("RKAP Investasi")
                    ->prefix("Rp. ")
                    ->numeric()
                    ->required(),
                TextInput::make('tahun_rkap')
                    ->label('Tahun RKAP')
                    ->placeholder("Tahun RKAP")
                    ->numeric()
                    ->required(),
                FileUpload::make('attachment')
                    ->label('Upload Attachment')
                    ->directory('attachments')
                    ->visibility('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pemasaran_rp')
                    ->label('Pemasaran (RP)')
                    ->searchable(),
                TextColumn::make('pemasaran_ha')
                    ->label('Pemasaran (HA)')
                    ->searchable(),
                TextColumn::make('air_bersih_rp')
                    ->label('Air Bersih (RP)')
                    ->searchable(),
                TextColumn::make('air_bersih_m3')
                    ->label('Air Bersih (m³)')
                    ->searchable(),
                TextColumn::make('limbah_cair_rp')
                    ->label('Limbah Cair (RP)')
                    ->searchable(),
                TextColumn::make('limbah_cair_m3')
                    ->label('Limbah Cair (m³)')
                    ->searchable(),
                TextColumn::make('listrik_rp')
                    ->label('Listrik (RP)')
                    ->searchable(),
                TextColumn::make('listrik_kwh')
                    ->label('Listrik (kWh)')
                    ->searchable(),
                TextColumn::make('investasi')
                    ->label('RKAP Investasi')
                    ->searchable(),
                TextColumn::make('tahun_rkap')
                    ->label('Tahun RKAP')
                    ->searchable(),
                ImageColumn::make('attachment')
                    ->label('Attachment')
                    ->disk('public')
                    ->visibility('public'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListRkaps::route('/'),
            'create' => Pages\CreateRkap::route('/create'),
            'edit' => Pages\EditRkap::route('/{record}/edit'),
        ];
    }
}
