<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AdrresRelationManager;
use App\Models\Order;
use App\Models\product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


use DateTime;
use Faker\Core\Number;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Set;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Get;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use PhpParser\Builder\Function_;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Sipariş Bilgileri')->schema([
                    Select::make('user_id')
                        ->label('Müşteri')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('payment_method')
                        ->label('Payment Methods')
                        ->options([
                            'stripe' => 'Stripe',
                            'cod' => 'Cash on Delivery'
                        ])
                        ->required(),





                    Select::make('payment_status')
                        ->label('Ödeme Durumu')
                        ->options([
                            'beklemede' => 'Beklemede',
                            'ödendi' => 'Ödendi',
                            'başarısız' => 'Başarısız'
                        ])
                        ->default('beklemede')
                        ->required(),

                    ToggleButtons::make('status')
                        ->inline()
                        ->default('new')
                        ->required()
                        ->options([
                            'new' => 'new',
                            'processing'=> 'Processing',
                            'shipped'=>'Shipped',
                            'delivered'=>'Delivered',
                            'cancelled' => 'Cancelled'
                        ])
                        ->colors([
                            'new'=>'info',
                            'processing'=> 'warning',
                            'shipped'=>'success',
                            'delivered'=>'success',
                            'cancelled' => 'danger'
                        ])
                        ->icons([
                            'new'=>'heroicon-m-sparkles',
                            'processing'=> 'heroicon-m-arrow-path',
                            'shipped'=>'heroicon-m-truck',
                            'delivered'=>'heroicon-m-check-badge',
                            'cancelled' => 'heroicon-m-x-circle'
                        ]),

                    Select::make('currency')
                        ->options([
                            'inr'=>'INR',
                            'tl' => 'Tl',
                            'usd' => 'USD',
                            'eur' => 'EUR'
                        ])
                        ->default('tl')
                        ->required(),



                    Select::make('shipping_method')
                    ->label('kargo')
                    ->options([
                        'aras' => 'ARAS',
                        'mng' => 'MNG',
                        'ptt' => 'PTT'
                    ])
                    ->required(),


                        Textarea::make('not')
                    ->columnSpanFull()

            ])->columns(2),

            Section::make('Siparişler')->schema([
                Repeater::make('items')
    ->relationship('items')

                    ->schema([

                        Select::make('product_id')
                            ->label('Ürün')
                            ->relationship('Product','name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->distinct()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->columnSpan(4)
                            ->reactive()
                           -> afterStateUpdated(fn ($state, Set $set) => $set('unit_amount', Product::find($state)->price ?? 0))
                           -> afterStateUpdated(fn ($state, Set $set) => $set('total_amount', Product::find($state)->price ?? 0)),




                        TextInput::make('quantity')
                        ->numeric()
                        ->required()
                        ->default(1)
                        ->minValue(1)
                        ->columnSpan(2)
                        ->reactive()
                        ->afterStateUpdated(fn ($state, $set, $get) => $set('total_amount', $state * $get('unit_amount'))),



                    TextInput::make('unit_amount')
                        ->numeric()
                        ->required()
                        ->disabled()
                        ->dehydrated()
                        ->columnSpan(2),

                    TextInput::make('total_amount')
                        ->numeric()
                        ->required()
                        ->dehydrated()
                        ->columnSpan(3),

                        ])->columnSpan(12),
                        Placeholder::make('grand_total_placeholder')
                            ->label('grand total')
                            ->content(function(Get $get, Set $set){
                                $total = 0;
                                if (!$repeaters = $get('items')) {
                                    return $total;
                                }

                                foreach ($repeaters as $key => $repeater){
                                    $total += $get("items.{$key}.total_amount");
                                }
                                $set('grand_total', $total);

                            }),
                        Hidden::make('grand_total')
                            ->default(0)

                        ])





            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user.name')
                ->label('customer')
                ->sortable()
                ->searchable(),


                TextColumn::make('grand_total')
                ->numeric()
                ->sortable(),


                TextColumn::make('payment_method')
                ->numeric()
                ->sortable(),

                TextColumn::make('payment_status')
                ->numeric()
                ->sortable(),

                TextColumn::make('currency')
                ->sortable()
                ->searchable(),

                TextColumn::make('shipping_method')
                ->sortable()
                ->searchable(),




                SelectColumn::make('status')
                ->options(['new' => 'new',
                'processing'=> 'Processing',
                'shipped'=>'Shipped',
                'delivered'=>'Delivered',
                'cancelled' => 'Cancelled'

                ])
                ->sortable()
                ->searchable(),

                TextColumn::make('created_at')
                ->DateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true)





            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            AdrresRelationManager::class
        ];
    }
    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count()>10? 'success':'danger';
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
