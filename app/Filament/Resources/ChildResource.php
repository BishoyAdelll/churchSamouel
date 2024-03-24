<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChildResource\Pages;
use App\Filament\Resources\ChildResource\RelationManagers;
use App\Models\Child;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ChildResource extends Resource
{
    protected static ?string $model = Child::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'الابناء';
    protected static ?string $pluralModelLabel = 'الابناء';
    protected static ?string $modelLabel = 'الابناء';
    protected static ?string $navigationGroup="العائلات";



    public static function form(Form $form): Form
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
                            ->searchable()
                            ->preload()
                            ->label('اسم الاب')
                            ->relationship('family','name'),
                        Forms\Components\Select::make('education_id')
                            ->label('الصف الدراسى')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('education','name')
                        ->columnSpanFull(),
                    ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(' اسم الابن')
                    ->searchable(),

                Tables\Columns\TextColumn::make('family.name')
                    ->label('اسم الاب')
                    ->searchable()
                    ->sortable(),

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
                Tables\Filters\SelectFilter::make('education')
                    ->relationship('education', 'name')
                    ->label('السنة الدراسية '),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChildren::route('/'),
            'create' => Pages\CreateChild::route('/create'),
            'view' => Pages\ViewChild::route('/{record}'),
            'edit' => Pages\EditChild::route('/{record}/edit'),
        ];
    }
}
