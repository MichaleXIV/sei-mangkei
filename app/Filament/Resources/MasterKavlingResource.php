<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MasterKavlingResource\Pages;
use App\Filament\Resources\MasterKavlingResource\RelationManagers;
use App\Models\Kavling;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MasterKavlingResource extends Resource
{
    protected static ?string $model = Kavling::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Kavling';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $pluralLabel = 'Kavling';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make("bk")
                    ->label("Blok Kavling")
                    ->required(),
                TextInput::make("no_bk")
                    ->label("No Blok Kavling")
                    ->required(),
                TextInput::make("luas_kav")
                    ->label("Luas Kavling (m²)")
                    ->required()
                    ->numeric(),
                TextInput::make("lok_kav")
                    ->label("Lok Kavling (Dalam/Luar) Pagar")
                    ->required(),
                TextInput::make("jenis_kav")
                    ->label("Jenis Kavling")
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("bk")
                    ->label("Blok Kavling")
                    ->searchable(),
                TextColumn::make("no_bk")
                    ->label("No Blok Kavling")
                    ->searchable(),
                TextColumn::make("luas_kav")
                    ->label("Luas Kavling (m²)")
                    ->searchable(),
                TextColumn::make("lok_kav")
                    ->label("Lok Kavling (Dalam/Luar) Pagar")
                    ->searchable(),
                TextColumn::make("jenis_kav")
                    ->label("Jenis Kavling")
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
            'index' => Pages\ListMasterKavlings::route('/'),
            'create' => Pages\CreateMasterKavling::route('/create'),
            'edit' => Pages\EditMasterKavling::route('/{record}/edit'),
        ];
    }
}
