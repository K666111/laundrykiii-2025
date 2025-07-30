<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('customer_id')
                ->relationship('customer', 'name')
                ->required(),

            Forms\Components\Select::make('service_id')
                ->relationship('service', 'name')
                ->required(),

            Forms\Components\TextInput::make('quantity')
                ->required()
                ->numeric(),

            Forms\Components\TextInput::make('total')
                ->required()
                ->numeric(),

            Forms\Components\Select::make('status')
                ->required()
                ->options([
                    'pending' => 'Pending',
                    'processing' => 'Processing',
                    'complete' => 'Complete',
                    'completed' => 'Completed',
                ]),

            Forms\Components\DateTimePicker::make('transaction_date')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->sortable(),

                Tables\Columns\TextColumn::make('service.name')
                    ->label('Service')
                    ->sortable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total')
                    ->sortable()
                    ->money('IDR'),

                Tables\Columns\BadgeColumn::make('status')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->colors([
                        'secondary' => fn ($state) => $state === 'pending',
                        'warning' => fn ($state) => $state === 'processing',
                        'info' => fn ($state) => $state === 'complete',
                        'success' => fn ($state) => $state === 'completed',
                    ]),

                Tables\Columns\TextColumn::make('transaction_date')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
