<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProspektiveTenantResource\Pages;
use App\Filament\Resources\ProspektiveTenantResource\RelationManagers;
use App\Models\ProspektiveTenant;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
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
                    ->prefix("Rp. ")
                    ->required()
                    ->numeric(),
                Select::make('kavlings')
                    ->relationship(
                        name: 'kavlings',
                        titleAttribute: "no_bk",
                    )
                    ->label('No Blok Booking Kavling')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('evidence')
                    ->label('Evidence')
                    ->required()
                    ->options([
                        "Surat Minat" => "Surat Minat",
                        "Berita Acara Kesepatakan" => "Berita Acara Kesepatakan",
                        "Lainnya" => "Lainnya",
                    ])
                    ->native(false),
                Select::make('kategori')
                    ->label('Kategori')
                    ->required()
                    ->options([
                        "Cold" => "Cold",
                        "Warm" => "Warm",
                        "Hot" => "Hot",
                    ])
                    ->native(false),
                Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        "Penjajakan Awal" => "Penjajakan Awal",
                        "Perjanjian Pendahuluan" => "Perjanjian Pendahuluan",
                        "FS" => "FS",
                        "Deal Kontrak" => "Deal Kontrak",
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
                    ->prefix("Rp. ")
                    ->required(),
                FileUpload::make('attachment')
                    ->label('Upload Attachment')
                    ->directory('attachments')
                    ->visibility('public')
                    ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tenant')
                    ->label("Nama Tenant")
                    ->searchable(),
                TextColumn::make("booking_fee")
                    ->label("Booking Fee")
                    ->prefix("Rp. ")
                    ->searchable(),
                TextColumn::make('kavlings.no_bk')
                    ->label("No Blok Booking Kavling")
                    ->listWithLineBreaks()
                    ->limitList(2)
                    ->expandableLimitedList()
                    ->badge()
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
            'index' => Pages\ListProspektiveTenants::route('/'),
            'create' => Pages\CreateProspektiveTenant::route('/create'),
            'edit' => Pages\EditProspektiveTenant::route('/{record}/edit'),
        ];
    }
}
