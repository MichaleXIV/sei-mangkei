<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Resources\TenantResource\RelationManagers;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Tenant';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $pluralLabel = 'Tenant';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make("nama")
                    ->label("Nama Tenant")
                    ->required(),
                Textarea::make("alamat")
                    ->label("Alamat Tenant")
                    ->required(),
                TextInput::make("email")
                    ->email()
                    ->required(),
                TextInput::make("notelp")
                    ->required()
                    ->numeric()
                    ->label('No Telp'),
                TextInput::make("fax")
                    ->required()
                    ->label('Fax'),
                TextInput::make("nohp")
                    ->required()
                    ->numeric()
                    ->label('No HP'),
                TextInput::make("nowa")
                    ->required()
                    ->numeric()
                    ->label('No Whatsapp'),
                TextInput::make("npwp")
                    ->required()
                    ->numeric()
                    ->label('Npwp'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("nama")
                    ->label('Nama Tenant')
                    ->searchable(),
                TextColumn::make("alamat")
                    ->label('Alamat Tenant')
                    ->searchable(),
                TextColumn::make("email")
                    ->label('Email')
                    ->searchable(),
                TextColumn::make("notelp")
                    ->label('No Telp')
                    ->searchable(),
                TextColumn::make("fax")
                    ->label('Fax')
                    ->searchable(),
                TextColumn::make("nohp")
                    ->label('No HP')
                    ->searchable(),
                TextColumn::make("nowa")
                    ->label('No Whatsapp')
                    ->searchable(),
                TextColumn::make("npwp")
                    ->label('Npwp')
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
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }
}
