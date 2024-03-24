<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StreetResource\Pages;
use App\Filament\Resources\StreetResource\RelationManagers;
use App\Models\Street;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StreetResource extends Resource
{
    protected static ?string $model = Street::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationLabel = 'الشارع ';
    protected static ?string $pluralModelLabel = 'الشارع';
    protected static ?string $modelLabel = 'الشارع';
    protected static ?string $navigationGroup='العنوان';
    protected static ?int $navigationSort=4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('الشارع')
                    ->description('تعديل او اضافة الشارع')
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('اسم الشارع')
                    ->required()
                    ->maxLength(255),
            ])
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('اسم الشارع')
                    ->searchable(),
                Tables\Columns\TextColumn::make('family_count')->counts('family')->label('عدد العائلات '),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStreets::route('/'),
            'create' => Pages\CreateStreet::route('/create'),
            'view' => Pages\ViewStreet::route('/{record}'),
            'edit' => Pages\EditStreet::route('/{record}/edit'),
        ];
    }
}
