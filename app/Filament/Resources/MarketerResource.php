<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarketerResource\Pages;
use App\Filament\Resources\MarketerResource\RelationManagers;
use App\Models\Marketer;
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

class MarketerResource extends Resource
{
    protected static ?string $model = Marketer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Marketer';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $pluralLabel = 'Marketer';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_agency')
                    ->required(),
                TextInput::make('alamat_tenant')
                    ->required(),
                TextInput::make('nomor_sertifikat_p4t')
                    ->label("Nomor Sertifikat P4T")
                    ->required(),
                TextInput::make('email')
                    ->required(),
                TextInput::make('no_telp')
                    ->required(),
                TextInput::make('fax')
                    ->required(),
                TextInput::make('no_hp')
                    ->required(),
                TextInput::make('no_whatsapp')
                    ->required(),
                TextInput::make('npwp')
                    ->required(),
                Select::make('jenis_marketer')
                    ->required()
                    ->options([
                        'internal' => 'Internal',
                        'external' => 'External',
                    ])
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_agency')
                    ->label('Nama Agency')
                    ->searchable(),
                TextColumn::make('alamat_tenant')
                    ->label('Alamat Tenant')
                    ->searchable(),
                TextColumn::make('nomor_sertifikat_p4t')
                    ->label('Nomor Sertifikat P4T')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('no_telp')
                    ->label('No Telp')
                    ->searchable(),
                TextColumn::make('fax')
                    ->label('Fax')
                    ->searchable(),
                TextColumn::make('no_hp')
                    ->label('No HP')
                    ->searchable(),
                TextColumn::make('no_whatsapp')
                    ->label('No Whatsapp')
                    ->searchable(),
                TextColumn::make('npwp')
                    ->label('Npwp')
                    ->searchable(),
                TextColumn::make('jenis_marketer')
                    ->label('Jenis Marketer')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarketers::route('/'),
            'create' => Pages\CreateMarketer::route('/create'),
            'edit' => Pages\EditMarketer::route('/{record}/edit'),
        ];
    }
}
