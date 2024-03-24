<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilyResource\Pages;
//use App\Filament\Resources\FamilyResource\RelationManagers;
use App\Filament\Resources\FamilyResource\RelationManagers\ChildreenRelationManager;
use App\Models\Address;
use App\Models\Child;
use App\Models\Church;
use App\Models\District;
use App\Models\Family;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class FamilyResource extends Resource
{
    protected static ?string $model = Family::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'العائلات';
    protected static ?string $pluralModelLabel = 'العائلات';
    protected static ?string $modelLabel = 'العائلات';
    protected static ?string $navigationGroup="العائلات";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('العنوان')
                    ->description(' العنوان والشارع والكنيسة و الحى التابع لهم')
                    ->schema([
                        Forms\Components\Select::make('area_id')
                            ->relationship('area','name')
                            ->searchable()
                            ->preload()
                            ->required()->label('اسم المنطقة'),
                        Forms\Components\Select::make('church_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->options(Church::query()->pluck('name','id'))->label('الكنيسة التابع لها'),
                        Forms\Components\Select::make('district_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->options(District::query()->pluck('name','id'))->label('اسم المربع السكنى '),
                        Forms\Components\Select::make('address_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->options(Address::query()->pluck('name','id'))->label('نوع السكن'),
                        Forms\Components\Select::make('street_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('street','name')
                        ->columnSpanFull()->label('الشارع الرئيسى'),

                    ])->columns(2),
                        Forms\Components\Section::make('البيانات الشخصية')
                            ->description('بيانات الزوج والزوجة وارقام التليفون و العنوان التفصيلى ')
                            ->schema([
                        Forms\Components\TextInput::make('name')
                            ->maxLength(255)->label('اسم الزوج'),
                        Forms\Components\TextInput::make('mother_name')
                            ->maxLength(255)->label('اسم الزوجة '),
                        Forms\Components\Toggle::make('status')
                            ->label('ارملة')->columnSpanFull(),
                        Forms\Components\FileUpload::make('father_image')
                            ->image()
                            ->label('صورة الاب')
                            ->imageEditor()
                            ->openable(),
                        Forms\Components\FileUpload::make('mother_image')
                            ->image()
                            ->label('صورة الام')
                            ->imageEditor()
                            ->openable(),
                        Forms\Components\TextInput::make('first_phone')
                            ->tel()
                            ->maxLength(255)->label('رقم التليفون '),
                        Forms\Components\TextInput::make('second_phone')
                            ->tel()
                            ->maxLength(255)->label('رقم تليفون اخر'),
                        Forms\Components\MarkdownEditor::make('address')
                            ->disableToolbarButtons([
                                'attachFiles',
                            ])
                            ->maxLength(65535)
                            ->columnSpanFull()->label('عنوان تفصيلى'),
                            ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('اسم الزوح'),
                Tables\Columns\TextColumn::make('mother_name')
                    ->searchable()->label('اسم الزوجة'),
                Tables\Columns\TextColumn::make('first_phone')
                    ->searchable()->label('رقم التليفون'),
                Tables\Columns\TextColumn::make('second_phone')
                    ->searchable()->label('رقم تليفون اخر'),
                Tables\Columns\TextColumn::make('address.name')
                    ->searchable()->sortable()->label('نوع السكن'),
                Tables\Columns\TextColumn::make('district.name')
                    ->searchable()->sortable()->label('اسم المربع السكنى '),
                Tables\Columns\TextColumn::make('street.name')
                    ->searchable()->sortable()->label('الشارع الرئيسى'),
                Tables\Columns\ImageColumn::make('father_image')
                    ->circular()
                ->label('صورة الاب')
                , Tables\Columns\ImageColumn::make('mother_image')
                    ->circular()
                    ->label('صورة الام')
                ,
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->label('عنوان تفصيلى '),
                Tables\Columns\ToggleColumn::make('status')
                    ->sortable()
                    ->label('ارملة'),
                Tables\Columns\TextColumn::make('childreen.name')
                    ->searchable()
                    ->label('اسماء الابناء'),
                Tables\Columns\TextColumn::make('childreen.education.name')
                    ->searchable()
                    ->label('السنة الدراسية'),
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
                Tables\Filters\SelectFilter::make('address')
                    ->relationship('address', 'name')
                    ->native(false)
                    ->label('نوع السكن'),
                Tables\Filters\SelectFilter::make('street')
                    ->relationship('street', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->label('الشارع'),
                Tables\Filters\TernaryFilter::make('status')
                ->label('ارملة')
                ->boolean()
                ->truelabel("ارملة")
                ->falselabel("ليست ارملة")
                ->native(false)
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

    public static function getRelations(): array
    {
        return [
            ChildreenRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFamilies::route('/'),
            'create' => Pages\CreateFamily::route('/create'),
            'view' => Pages\ViewFamily::route('/{record}'),
            'edit' => Pages\EditFamily::route('/{record}/edit'),
        ];
    }
}
