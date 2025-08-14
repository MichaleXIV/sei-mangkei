<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermohonanHgbAtauHtResource\Pages;
use App\Filament\Resources\PermohonanHgbAtauHtResource\RelationManagers;
use App\Models\PermohonanHgbAtauHt;
use App\Models\Tenant;
use Dom\Text;
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

class PermohonanHgbAtauHtResource extends Resource
{
    protected static ?string $model = PermohonanHgbAtauHt::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Operasional Data';
    protected static ?string $navigationLabel = 'Permohonan HGB/HT';
    protected static ?string $pluralLabel = 'Permohonan HGB/HT';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tenant_id')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->label("Nama Tenant")
                    ->options(Tenant::pluck("nama", "id")->toArray()),
                TextInput::make('kontrak')
                    ->label('Nomor Kontrak')
                    ->placeholder("Nomor Kontrak")
                    ->required(),
                DatePicker::make('kontrak_date')
                    ->label('Tanggal Kontrak')
                    ->placeholder("Tanggal Kontrak")
                    ->required()
                    ->native(false),
                TextInput::make('masa_sewa')
                    ->label('Masa Sewa')
                    ->placeholder("Masa Sewa")
                    ->required()
                    ->numeric(),
                TextInput::make('kontrak_nilai')
                    ->label('Nilai Kontrak')
                    ->prefix("Rp. ")
                    ->placeholder("Nilai Kontrak")
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->label('Status Permohonan')
                    ->required()
                    ->options([
                        "HGB" => "HGB",
                        "Hak Tanggung" => "Hak Tanggung",
                    ])
                    ->native(false),
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
                TextColumn::make('tenant')
                    ->label("Nama Tenant")
                    ->searchable(),
                TextColumn::make('kontrak')
                    ->label("Nomor Kontrak")
                    ->searchable(),
                TextColumn::make('kontrak_date')
                    ->label("Tanggal Kontrak")
                    ->searchable(),
                TextColumn::make('masa_sewa')
                    ->searchable(),
                TextColumn::make('kontrak_nilai')
                    ->label("Nilai Kontrak")
                    ->searchable(),
                TextColumn::make('status')
                    ->label("Status Permohonan")
                    ->searchable(),
                ImageColumn::make('attachment')
                    ->label('Attachment')
                    ->disk('public')
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
            'index' => Pages\ListPermohonanHgbAtauHts::route('/'),
            'create' => Pages\CreatePermohonanHgbAtauHt::route('/create'),
            'edit' => Pages\EditPermohonanHgbAtauHt::route('/{record}/edit'),
        ];
    }
}
