<?php

namespace App\Filament\Resources\EducationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

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
                        Forms\Components\Select::make('family_id')
                            ->required()
                            ->label('اسم الاب')
                            ->searchable()
                            ->preload()
                            ->relationship('family','name'),

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
                Tables\Columns\TextColumn::make('family.name')
                    ->label('اسم الاب')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('family.mother_name')
                    ->label('اسم الام')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('family.address')
                    ->label('العنوان ')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('family.first_phone')
                    ->label('رقم التليفون')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('family.second_phone')
                    ->label('رقم اخر')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('education.name')
                    ->label('السنة الدراسية')
                    ->searchable(),
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\CreateAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->exports([
                        ExcelExport::make('table')->fromTable(),
                    ]),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
