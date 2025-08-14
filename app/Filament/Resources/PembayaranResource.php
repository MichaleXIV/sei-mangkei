<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use App\Models\Pembayaran;
use App\Models\Tenant;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Number;
use PhpParser\Node\Stmt\Label;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Operasional Data';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $pluralLabel = 'Pembayaran';
    protected static ?int $navigationSort = 3;

    protected static function calculatePersentase(Get $get, Set $set): void
    {
        $bayar = $get('nilai');
        $kontrak = $get('kontrak_nilai');

        if ($bayar && $kontrak) {
            $persentase = $bayar / $kontrak * 100;
            $set('persentase', Number::format($persentase, 2, locale: 'id'));
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("tipe_pembayaran")
                    ->required()
                    ->native(false)
                    ->label("Tipe Pembayaran")
                    ->options([
                        "Rencana Pembayaran Tenant" => "Rencana Pembayaran Tenant",
                        "Realisasi Pembayaran Tenant" => "Realisasi Pembayaran Tenant",
                        "Realisasi Investasi Infrastruktur Kek Sei Mangkei" => "Realisasi Investasi Infrastruktur Kek Sei Mangkei",
                    ])
                    ->reactive()
                    ->live()
                    ->columnSpanFull()
                    ->searchable(),
                Section::make("Detail Pembayaran")
                    ->description("Detail Pembayaran Tenant")
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make("tenant_id")
                                    ->required()
                                    ->native(false)
                                    ->label("Nama Tenant")
                                    ->options(Tenant::pluck("nama", "id")->toArray())
                                    ->searchable(),
                                TextInput::make("kontrak")
                                    ->required()
                                    ->label("Nomor Kontrak")
                                    ->placeholder("Nomor Kontrak"),
                                DatePicker::make('kontrak_date')
                                    ->label('Tanggal Kontrak')
                                    ->placeholder("Tanggal Kontrak")
                                    ->required()
                                    ->native(false)
                                    ->hidden(fn (Get $get) => $get('tipe_pembayaran') === 'Realisasi Pembayaran Tenant'),
                                TextInput::make("masa_sewa")
                                    ->label("Masa Sewa")
                                    ->placeholder("Masa Sewa")
                                    ->required()
                                    ->suffix("Bulan")
                                    ->numeric()
                                    ->hidden(fn (Get $get) => $get('tipe_pembayaran') === 'Realisasi Pembayaran Tenant'),
                                TextInput::make("investasi")
                                    ->label("Realisasi Investasi")
                                    ->placeholder("Realisasi Investasi")
                                    ->prefix("Rp.")
                                    ->required()
                                    ->numeric()
                                    ->hidden(fn (Get $get) => $get('tipe_pembayaran') === 'Rencana Pembayaran Tenant' || $get('tipe_pembayaran') === 'Realisasi Pembayaran Tenant'),
                                TextInput::make('kontrak_nilai')
                                    ->label('Nilai Kontrak')
                                    ->placeholder("Nilai kontrak")
                                    ->prefix("Rp.")
                                    ->required()
                                    ->numeric()
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        self::calculatePersentase($get, $set);
                                    }),
                                TextInput::make('nilai')
                                    ->label('Nilai')
                                    ->placeholder("Nilai")
                                    ->prefix("Rp.")
                                    ->required()
                                    ->numeric()
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        self::calculatePersentase($get, $set);
                                    }),
                                TextInput::make('persentase')
                                    ->label('Persentase')
                                    ->placeholder("Persentase")
                                    ->suffix("%")
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->hidden(fn (Get $get) => $get('tipe_pembayaran') === 'Rencana Pembayaran Tenant'),
                                TextInput::make('pembayaran_termin')
                                    ->label('Termin Pembayaran')
                                    ->placeholder("Termin Pembayaran")
                                    ->required(),
                                DatePicker::make('date')
                                    ->label('Tanggal Pembayaran')
                                    ->placeholder("Tanggal Pembayaran")
                                    ->required()
                                    ->native(false),
                            ])
                    ])->visible(fn (Get $get) => !empty($get('tipe_pembayaran')))->columnSpanFull(),
            ]);
        // return $form
        //     ->schema([
        //         Wizard::make([
        //             Wizard\Step::make('Tipe Pembayaran')
        //                 ->schema([
        //                     Select::make("tipe_pembayaran")
        //                         ->required()
        //                         ->native(false)
        //                         ->label("Tipe Pembayaran")
        //                         ->options([
        //                             "rencana_bayar" => "Rencana Pembayaran Tenant",
        //                             "realisasi_pembayaran" => "Realisasi Pembayaran Tenant",
        //                             "realisasi_investasi" => "Realisasi Investasi Infrastruktur Kek Sei Mangkei",
        //                         ])
        //                         ->reactive()
        //                         ->searchable(),
        //                 ]),

        //             Wizard\Step::make('Detail Pembayaran')
        //                 ->schema(function (Get $get) {
        //                     $type = $get('tipe_pembayaran');

        //                     if ($type == "rencana_bayar") {
        //                         return [
        //                             Section::make("Detail Rencana Pembayaran")
        //                                 ->description("Detail Rencana Pembayaran Tenant")
        //                                 ->schema([
        //                                     Select::make("tenant_id")
        //                                         ->required()
        //                                         ->native(false)
        //                                         ->label("Nama Tenant")
        //                                         ->options(Tenant::pluck("nama", "id")->toArray())
        //                                         ->searchable(),
        //                                     TextInput::make("kontrak")
        //                                         ->required()
        //                                         ->label("Nomor Kontrak")
        //                                         ->placeholder("Nomor Kontrak"),
        //                                     DatePicker::make('kontrak_date')
        //                                         ->label('Tanggal Kontrak')
        //                                         ->placeholder("Tanggal Kontrak")
        //                                         ->required()
        //                                         ->native(false),
        //                                     TextInput::make("masa_sewa")
        //                                         ->label("Masa Sewa")
        //                                         ->placeholder("Masa Sewa")
        //                                         ->required()
        //                                         ->numeric(),
        //                                     TextInput::make('kontrak_nilai')
        //                                         ->label('Nilai Kontrak')
        //                                         ->placeholder("Nilai kontrak")
        //                                         ->prefix("Rp.")
        //                                         ->required()
        //                                         ->numeric(),
        //                                     TextInput::make('pembayaran_termin')
        //                                         ->label('Termin Pembayaran')
        //                                         ->placeholder("Termin Pembayaran")
        //                                         ->required(),
        //                                     TextInput::make('nilai')
        //                                         ->label('Nilai')
        //                                         ->placeholder("Nilai")
        //                                         ->prefix("Rp.")
        //                                         ->required()
        //                                         ->numeric(),
        //                                     DatePicker::make('date')
        //                                         ->label('Tanggal Pembayaran')
        //                                         ->placeholder("Tanggal Pembayaran")
        //                                         ->required()
        //                                         ->native(false),
        //                                 ])
        //                         ];
        //                     }

        //                     if ($type == "realisasi_pembayaran") {
        //                         return [
        //                             Section::make("Detail Realisasi Pembayaran")
        //                                 ->description("Detail Realisasi Pembayaran Tenant")
        //                                 ->schema([
        //                                     Select::make("tenant_id")
        //                                         ->required()
        //                                         ->native(false)
        //                                         ->label("Nama Tenant")
        //                                         ->options(Tenant::pluck("nama", "id")->toArray())
        //                                         ->searchable(),
        //                                     TextInput::make("kontrak")
        //                                         ->required()
        //                                         ->label("Nomor Kontrak")
        //                                         ->placeholder("Nomor Kontrak"),
        //                                     TextInput::make('kontrak_nilai')
        //                                         ->label('Nilai Kontrak')
        //                                         ->placeholder("Nilai kontrak")
        //                                         ->prefix("Rp.")
        //                                         ->required()
        //                                         ->numeric(),
        //                                     TextInput::make('pembayaran_termin')
        //                                         ->label('Termin Pembayaran')
        //                                         ->placeholder("Termin Pembayaran")
        //                                         ->required(),
        //                                     TextInput::make('nilai')
        //                                         ->label('Nilai')
        //                                         ->placeholder("Nilai")
        //                                         ->prefix("Rp.")
        //                                         ->required()
        //                                         ->numeric(),
        //                                     TextInput::make('persentase')
        //                                         ->label('Persentase')
        //                                         ->placeholder("Persentase")
        //                                         ->suffix("%")
        //                                         ->required()
        //                                         ->numeric(),
        //                                     DatePicker::make('date')
        //                                         ->label('Tanggal Pembayaran')
        //                                         ->placeholder("Tanggal Pembayaran")
        //                                         ->required()
        //                                         ->native(false),
        //                                 ])
        //                         ];
        //                     }

        //                     if ($type == "realisasi_investasi") {
        //                         return [
        //                             Section::make("Detail Realisasi Investasi")
        //                                 ->description("Detail Realisasi Investasi Infrastruktur Kek Sei Mangkei")
        //                                 ->schema([
        //                                     Select::make("tenant_id")
        //                                         ->required()
        //                                         ->native(false)
        //                                         ->label("Nama Tenant")
        //                                         ->options(Tenant::pluck("nama", "id")->toArray())
        //                                         ->searchable(),
        //                                     TextInput::make("kontrak")
        //                                         ->required()
        //                                         ->label("Nomor Kontrak")
        //                                         ->placeholder("Nomor Kontrak"),
        //                                     DatePicker::make('kontrak_date')
        //                                         ->label('Tanggal Kontrak')
        //                                         ->placeholder("Tanggal Kontrak")
        //                                         ->required()
        //                                         ->native(false),
        //                                     TextInput::make("masa_sewa")
        //                                         ->label("Masa Sewa")
        //                                         ->placeholder("Masa Sewa")
        //                                         ->required()
        //                                         ->numeric(),
        //                                     TextInput::make("investasi")
        //                                         ->label("Realisasi Investasi")
        //                                         ->placeholder("Realisasi Investasi")
        //                                         ->required()
        //                                         ->numeric(),
        //                                     TextInput::make('kontrak_nilai')
        //                                         ->label('Nilai Kontrak')
        //                                         ->placeholder("Nilai kontrak")
        //                                         ->prefix("Rp.")
        //                                         ->required()
        //                                         ->numeric(),
        //                                     TextInput::make('pembayaran_termin')
        //                                         ->label('Termin Pembayaran')
        //                                         ->placeholder("Termin Pembayaran")
        //                                         ->required(),
        //                                     TextInput::make('nilai')
        //                                         ->label('Nilai')
        //                                         ->placeholder("Nilai")
        //                                         ->prefix("Rp.")
        //                                         ->required()
        //                                         ->numeric(),
        //                                     TextInput::make('persentase')
        //                                         ->label('Persentase')
        //                                         ->placeholder("Persentase")
        //                                         ->suffix("%")
        //                                         ->required()
        //                                         ->numeric(),
        //                                     DatePicker::make('date')
        //                                         ->label('Tanggal Pembayaran')
        //                                         ->placeholder("Tanggal Pembayaran")
        //                                         ->required()
        //                                         ->native(false),
        //                                 ])
        //                         ];
        //                     }

        //                     return [];
        //                 })
        //                 // ->visible(fn (Get $get) => !empty($get('tipe_pembayaran'))),
        //         ])
        //         ->columnSpanFull()
        //         ->submitAction(fn (Wizard $wizard) => view('filament.wizard-submit', ['wizard' => $wizard])),
        //     ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tenant')
                    ->label("Nama Tenant")
                    ->searchable(),
                TextColumn::make('tipe_pembayaran')
                    ->label("Tipe Pembayaran")
                    ->searchable(),
                TextColumn::make("kontrak")
                    ->label("Nomor Kontrak")
                    ->searchable(),
                TextColumn::make('kontrak_date')
                    ->label("Tanggal Kontrak")
                    ->searchable(),
                TextColumn::make('masa_sewa')
                    ->searchable(),
                TextColumn::make("investasi")
                    ->label("Realisasi Investasi")
                    ->searchable(),
                TextColumn::make('kontrak_nilai')
                    ->searchable(),
                TextColumn::make('pembayaran_termin')
                    ->searchable(),
                TextColumn::make('nilai')
                    ->searchable(),
                TextColumn::make('persentase')
                    ->searchable(),
                TextColumn::make('date')
                    ->label("Tanggal Pembayaran")
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
