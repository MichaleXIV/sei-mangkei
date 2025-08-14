<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KontrakTenantResource\Pages;
use App\Filament\Resources\KontrakTenantResource\RelationManagers;
use App\Filament\Resources\KontrakTenantResource\RelationManagers\KavlingsRelationManager;
use App\Models\Kavling;
use App\Models\KontrakTenant;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Number;

class KontrakTenantResource extends Resource
{
    protected static ?string $model = KontrakTenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Kontrak Tenant';
    protected static ?string $navigationGroup = 'Operasional Data';
    protected static ?string $pluralLabel = 'Kontrak Tenant';
    protected static ?int $navigationSort = 1;

    protected static function calculateAccrual(Get $get, Set $set): void
    {
        $startDate = \Carbon\Carbon::parse($get('kontrak_date'));
        $endDate = \Carbon\Carbon::parse($get('end_date'));
        $contractValue = (float) $get('kontrak_nilai');

        if ($startDate && $endDate && $contractValue) {
            $durationInYears = $startDate->diffInDays($endDate) / 365;
            $accrualValue = $durationInYears > 0 ? $contractValue / $durationInYears : 0;
            $set('nilai_accrual', Number::format($accrualValue, 2, locale: 'id'));
        }
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Select::make('tenant_id')
                    ->label('Nama Tenant')
                    ->required()
                    ->searchable()
                    ->native(false)
                    ->options(fn () => Tenant::pluck("nama", "id")->toArray()),
                TextInput::make('luas')
                    ->label('Luas')
                    ->suffix("m²")
                    ->required()
                    ->placeholder("Luas")
                    ->numeric(),
                Select::make('kavling_ids')
                    ->relationship(
                        name: 'kavlings',
                        titleAttribute: "no_bk",
                        // modifyQueryUsing: fn (Builder $query) => $query->doesntHave("kontrakTenant")
                    )
                    ->label('No Blok Kavling')
                    // using this way, cuz the foreign key is set in Kavling, not in KontrakTenant
                    // cuz that issue field 'kontrak_tenant_id' in table kavling not updated
                    // with this way, the form 'kavling_ids' can be modified in CreateKontrakTenant.mutateFormDataBeforeCreate
                    // ->options(fn () => Kavling::pluck("no_bk", "id")->toArray())
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('marketers')
                    ->relationship('marketers', 'nama_agency')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('jenis_tenant')
                    ->required()
                    ->options([
                        "Tenant Baru" => "Tenant Baru",
                        "Ekspansi" => "Ekspansi",
                    ])
                    ->native(false),
                Select::make('skema')
                    ->label('Skema Pembayaran')
                    ->required()
                    ->options([
                        "Blocksales" => "Blocksales",
                        "Retail" => "Retail",
                    ])
                    ->native(false),
                TextInput::make('jenis_industri')
                    ->placeholder('Jenis Industri')
                    ->required(),
                Select::make('sumber_modal')
                    ->required()
                    ->options([
                        "Penanaman Modal Asing" => "Penanaman Modal Asing",
                        "Penanaman Modal Dalam Negeri" => "Penanaman Modal Dalam Negeri",
                    ])
                    ->native(false),
                TextInput::make('negara_asal')
                    ->placeholder("Negara Asal")
                    ->required(),
                Select::make('insentif')
                    ->required()
                    ->options([
                        "Tax Holiday" => "Tax Holiday",
                        "Tax Allowance" => "Tax Allowance",
                    ])
                    ->native(false),
                TextInput::make('produksi')
                    ->label('Jenis Produksi')
                    ->placeholder("Jenis Produksi")
                    ->required(),
                TextInput::make('kapasitas_produksi')
                    ->placeholder("Kapasitas Produksi")
                    ->required(),
                TextInput::make('no_perjanjian')
                    ->label('Nomor Perjanjian Pemanfaatan Lahan (Nomor Kontrak)')
                    ->placeholder("Nomor Perjanjian Pemanfaatan Lahan")
                    ->required()
                    ->numeric(),
                TextInput::make('kontrak')
                    ->label('Nomor Kontrak (nomor perjanjian Pemanfaatan Lahan)')
                    ->placeholder("Nomor Kontrak")
                    ->required(),
                DatePicker::make('kontrak_date')
                    ->label('Tanggal Kontrak')
                    ->placeholder("Tanggal Kontrak")
                    ->required()
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        self::calculateAccrual($get, $set);
                    }),
                DatePicker::make('end_date')
                    ->label('Tanggal Berakhir Kontrak')
                    ->placeholder("Tanggal Berakhir Kontrak")
                    ->required()
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        self::calculateAccrual($get, $set);
                    }),
                TextInput::make('kontrak_nilai')
                    ->label('Nilai Kontrak')
                    ->placeholder("Nilai Kontrak")
                    ->prefix("Rp. ")
                    ->required()
                    ->live(debounce: 500)
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        self::calculateAccrual($get, $set);
                    })
                    ->numeric(),
                TextInput::make('nilai_accrual')
                    ->required()
                    ->placeholder("Nilai Accrual")
                    ->dehydrated()
                    ->prefix("Rp. ")
                    ->suffix("/tahun")
                    ->disabled(),
                TextInput::make('harga_m')
                    ->label('Harga')
                    ->placeholder("Harga")
                    ->prefix("Rp. ")
                    ->suffix("/m²")
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
                        "Kavling Mentahan" => "Kavling Mentahan",
                        "Kavling Siap Bangun" => "Kavling Siap Bangun",
                    ])
                    ->native(false),
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
                    ->directory('attachments') // This will store files in storage/app/public/attachments
                    ->visibility('public') // Files will be publicly accessible
                    ->preserveFilenames() // Optional: preserve original filenames
                    ->required(),
            ]);
    }

    // protected function afterSave(Model $record, array $data): void
    // {
    //     dd($data);
    //     if (isset($data['kavlings'])) {
    //         Kavling::whereIn('id', $data['kavlings'])
    //             ->update(['kontrak_tenant_id' => $record->id]);
    //     }
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tenant')
                    ->searchable(),
                TextColumn::make('luas')
                    ->searchable(),
                TextColumn::make('kavlings.no_bk')
                    ->label("No Blok Kavling")
                    ->listWithLineBreaks()
                    ->limitList(2)
                    ->expandableLimitedList()
                    ->badge()
                    ->searchable(),
                TextColumn::make('marketers.nama_agency')
                    ->listWithLineBreaks()
                    ->limitList(2)
                    ->expandableLimitedList()
                    ->badge()
                    // ->bulleted()
                    // ->separator(",")
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
                ImageColumn::make('attachment')
                    ->label('Image')
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
            'index' => Pages\ListKontrakTenants::route('/'),
            'create' => Pages\CreateKontrakTenant::route('/create'),
            'edit' => Pages\EditKontrakTenant::route('/{record}/edit'),
        ];
    }
}
