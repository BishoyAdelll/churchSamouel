<?php

namespace App\Filament\Resources\FamilyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChildreenRelationManager extends RelationManager
{
    protected static string $relationship = 'childreen';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('الابناء')
                    ->description('اضافة ابناء اولا اختار اسم الاب والصف الدراسى ثم اكتب الاسم')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('الاسم')
                            ->maxLength(255),
                        Forms\Components\Select::make('education_id')
                            ->label('الصف الدراسى')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->relationship('education','name')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label(' اسم الابن')
                    ->searchable(),
                Tables\Columns\TextColumn::make('education.name')
                    ->label('الصف الدراسى')
                    ->searchable()
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
