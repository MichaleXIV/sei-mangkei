<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProspektiveTenantResource\Pages;
use App\Filament\Resources\ProspektiveTenantResource\RelationManagers;
use App\Models\ProspektiveTenant;
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

class ProspektiveTenantResource extends Resource
{
    protected static ?string $model = ProspektiveTenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Operasional Data';
    protected static ?string $navigationLabel = 'Prospektive Tenant';
    protected static ?string $pluralLabel = 'Prospektive Tenant';
    protected static ?int $navigationSort = 2;

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
                TextInput::make('booking_fee')
                    ->label('Booking Fee')
                    ->placeholder("Booking Fee")
                    ->required()
                    ->numeric(),
                TextInput::make('lok_kav_book')
                    ->label('Lokasi Booking Kavling')
                    ->placeholder("Lokasi Booking Kavling")
                    ->required(),
                Select::make('evidence')
                    ->label('Evidence')
                    ->required()
                    ->options([
                        "surat_minat" => "Surat Minat",
                        "berita_acara_kesepatakan" => "Berita Acara Kesepatakan",
                        "lainnya" => "Lainnya",
                    ])
                    ->native(false),
                Select::make('kategori')
                    ->label('Kategori')
                    ->required()
                    ->options([
                        "cold" => "Cold",
                        "warm" => "Warm",
                        "hot" => "Hot",
                    ])
                    ->native(false),
                Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        "penjajakan_awal" => "Penjajakan Awal",
                        "perjanjian_pendahuluan" => "Perjanjian Pendahuluan",
                        "fs" => "FS",
                        "deal_kontrak" => "Deal Kontrak",
                    ])
                    ->native(false),
                DatePicker::make('kontrak_date')
                    ->label('Tanggal Booking')
                    ->placeholder("Tanggal Booking")
                    ->required()
                    ->native(false),
                TextInput::make("kontrak_nilai_rencana")
                    ->label("Nilai Kontrak Rencana")
                    ->placeholder("Nilai kontrak Rencana")
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tenant')
                    ->searchable(),
                TextColumn::make("booking_fee")
                    ->searchable(),
                TextColumn::make('lok_kav_book')
                    ->searchable(),
                TextColumn::make('evidence')
                    ->searchable(),
                TextColumn::make('kategori')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('kontrak_date')
                    ->searchable(),
                TextColumn::make('kontrak_nilai_rencana')
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
            'index' => Pages\ListProspektiveTenants::route('/'),
            'create' => Pages\CreateProspektiveTenant::route('/create'),
            'edit' => Pages\EditProspektiveTenant::route('/{record}/edit'),
        ];
    }
}
