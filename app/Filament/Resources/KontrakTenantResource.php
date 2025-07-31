<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KontrakTenantResource\Pages;
use App\Filament\Resources\KontrakTenantResource\RelationManagers;
use App\Models\KontrakTenant;
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

class KontrakTenantResource extends Resource
{
    protected static ?string $model = KontrakTenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Kontrak Tenant';
    protected static ?string $navigationGroup = 'Operasional Data';
    protected static ?string $pluralLabel = 'Kontrak Tenant';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tenant')
                    ->label('Nama Tenant')
                    ->required()
                    ->searchable()
                    ->native(false)
                    ->options(fn () => Tenant::pluck("nama", "nama")->toArray()),
                TextInput::make('luas')
                    ->label('Luas')
                    ->suffix("m²")
                    ->required()
                    ->placeholder("Luas")
                    ->numeric(),
                TextInput::make('lok_kav')
                    ->label('Lokasi Kavling')
                    ->placeholder("Lokasi Kavling")
                    ->required(),
                Select::make('marketer')
                    ->required()
                    ->options([
                        "internal_kinra" => "Internal Kinra",
                        "marketing_agency" => "Marketing Agency",
                    ])
                    ->native(false),
                Select::make('jenis_tenant')
                    ->required()
                    ->options([
                        "prospective_tenant" => "Prospective Tenant",
                        "tenant_baru" => "Tenant Baru",
                        "ekspansi" => "Ekspansi",
                    ])
                    ->native(false),
                Select::make('skema')
                    ->label('Skema Pembayaran')
                    ->required()
                    ->options([
                        "blocksales" => "Blocksales",
                        "retail" => "Retail",
                    ])
                    ->native(false),
                TextInput::make('jenis_industri')
                    ->placeholder('Jenis Industri')
                    ->required(),
                Select::make('sumber_modal')
                    ->required()
                    ->options([
                        "penanaman_modal_asing" => "Penanaman Modal Asing",
                        "penanaman_modal_dalam_negeri" => "Penanaman Modal Dalam Negeri",
                    ])
                    ->native(false),
                TextInput::make('negara_asal')
                    ->placeholder("Negara Asal")
                    ->required(),
                Select::make('insentif')
                    ->required()
                    ->options([
                        "tax_holiday" => "Tax Holiday",
                        "tax_allowance" => "Tax Allowance",
                    ])
                    ->native(false),
                TextInput::make('produksi')
                    ->label('Jenis Produksi')
                    ->placeholder("Jenis Produksi")
                    ->required(),
                TextInput::make('kapasitas_produksi')
                    ->placeholder("Kapasitas Produksi")
                    ->required(),
                TextInput::make('kontrak')
                    ->label('Nomor Kontrak')
                    ->placeholder("Nomor Kontrak")
                    ->required(),
                DatePicker::make('kontrak_date')
                    ->label('Tanggal Kontrak')
                    ->placeholder("Tanggal Kontrak")
                    ->required()
                    ->native(false),
                DatePicker::make('end_date')
                    ->label('Tanggal Berakhir Kontrak')
                    ->placeholder("Tanggal Berakhir Kontrak")
                    ->required()
                    ->native(false),
                TextInput::make('kontrak_nilai')
                    ->label('Nilai Kontrak')
                    ->placeholder("Nilai Kontrak")
                    ->required()
                    ->numeric(),
                TextInput::make('harga_m')
                    ->label('Harga')
                    ->placeholder("Harga")
                    ->prefix("Rp. ")
                    ->suffix("/m²")
                    ->required()
                    ->numeric(),
                TextInput::make('nilai_accrual')
                    ->required()
                    ->placeholder("Nilai Accrual")
                    ->numeric(),
                TextInput::make('no_perjanjian')
                    ->label('Nomor Perjanjian Pemanfaatan Lahan')
                    ->placeholder("Nomor Perjanjian Pemanfaatan Lahan")
                    ->required()
                    ->numeric(),
                TextInput::make('kavling_harga')
                    ->label('Harga Kavling')
                    ->placeholder("Harga Kavling")
                    ->prefix("Rp. ")
                    ->required()
                    ->numeric(),
                DatePicker::make('date_ppl')
                    ->label('Tanggal Penyarahan Pemanfaatan Lahan')
                    ->placeholder("Tanggal Penyarahan Pemanfaatan Lahan")
                    ->required()
                    ->native(false),
                Select::make('kavling_jenis')
                    ->required()
                    ->options([
                        "kavling_mentahan" => "Kavling Mentahan",
                        "kavling_siap_bangun" => "Kavling Siap Bangun",
                    ])
                    ->native(false),
                Select::make('status')
                    ->label('Status Permohonan')
                    ->required()
                    ->options([
                        "hgb" => "HGB",
                        "hak_tanggung" => "Hak Tanggung",
                    ])
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tenant')
                    ->searchable(),
                TextColumn::make('luas')
                    ->searchable(),
                TextColumn::make('lok_kav')
                    ->searchable(),
                TextColumn::make('marketer')
                    ->searchable(),
                TextColumn::make('jenis_tenant')
                    ->searchable(),
                TextColumn::make('skema')
                    ->searchable(),
                TextColumn::make('jenis_industri')
                    ->searchable(),
                TextColumn::make('sumber_modal')
                    ->searchable(),
                TextColumn::make('negara_asal')
                    ->searchable(),
                TextColumn::make('insentif')
                    ->searchable(),
                TextColumn::make('produksi')
                    ->searchable(),
                TextColumn::make('kapasitas_produksi')
                    ->searchable(),
                TextColumn::make('kontrak')
                    ->searchable(),
                TextColumn::make('kontrak_date')
                    ->searchable(),
                TextColumn::make('end_date')
                    ->searchable(),
                TextColumn::make('kontrak_nilai')
                    ->searchable(),
                TextColumn::make('harga_m')
                    ->searchable(),
                TextColumn::make('nilai_accrual')
                    ->searchable(),
                TextColumn::make('no_perjanjian')
                    ->searchable(),
                TextColumn::make('kavling_harga')
                    ->searchable(),
                TextColumn::make('date_ppl')
                    ->searchable(),
                TextColumn::make('kavling_jenis')
                    ->searchable(),
                TextColumn::make('status')
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
            'index' => Pages\ListKontrakTenants::route('/'),
            'create' => Pages\CreateKontrakTenant::route('/create'),
            'edit' => Pages\EditKontrakTenant::route('/{record}/edit'),
        ];
    }
}
