<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdrresRelationManager extends RelationManager
{
    protected static string $relationship = 'adrres';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('first_name')
                ->required()
                ->maxLength(255),
                TextInput::make('last_name')
                ->required()
                ->maxLength(255),
                TextInput::make('phone')
                ->tel()
                ->required()
                ->maxLength(20),
                TextInput::make('city')
                ->required()
                ->maxLength(255),

                TextInput::make('state')
                ->required()
                ->numeric()
                ->maxLength(255),
                TextInput::make('zip_code')
                ->required()
                ->maxLength(255),

                TextInput::make('street_adress')
                ->required()
                ->columnSpanFull(),







                Forms\Components\TextInput::make('street_adress')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_adress')
            ->columns([
                TextColumn::make('fullname')
                ->label('full name'),

                TextColumn::make('phone'),

                TextColumn::make('city'),

                TextColumn::make('state'),

                TextColumn::make('zip_code'),

                TextColumn::make('street_adress'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
