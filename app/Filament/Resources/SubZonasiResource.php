<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubZonasiResource\Pages;
use App\Filament\Resources\SubZonasiResource\RelationManagers;
use App\Models\SubZonasi;
use App\Models\Zonasi;
use Dom\Text;
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

class SubZonasiResource extends Resource
{
    protected static ?string $model = SubZonasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Sub Zonasi';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $pluralLabel = 'Sub Zonasi';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('zonasi_id')
                    ->label("Zonasi")
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->options(Zonasi::pluck("nama", "id")->toArray()),
                TextInput::make('nama')
                    ->label('Nama Sub Zonasi')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Sub Zonasi')
                    ->searchable(),
                TextColumn::make('zonasi')
                    ->label('Zonasi')
                    ->searchable(),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubZonasis::route('/'),
            'create' => Pages\CreateSubZonasi::route('/create'),
            'edit' => Pages\EditSubZonasi::route('/{record}/edit'),
        ];
    }
}
