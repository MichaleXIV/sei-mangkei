<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfrastrukturKawasanResource\Pages;
use App\Filament\Resources\InfrastrukturKawasanResource\RelationManagers;
use App\Models\InfrastrukturKawasan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InfrastrukturKawasanResource extends Resource
{
    protected static ?string $model = InfrastrukturKawasan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Infrastruktur Kawasan';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $pluralLabel = 'Infrastruktur Kawasan';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListInfrastrukturKawasans::route('/'),
            'create' => Pages\CreateInfrastrukturKawasan::route('/create'),
            'edit' => Pages\EditInfrastrukturKawasan::route('/{record}/edit'),
        ];
    }
}
