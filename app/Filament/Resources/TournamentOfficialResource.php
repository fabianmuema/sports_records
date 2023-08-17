<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\TypeOfSport;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\TournamentOfficial;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TournamentOfficialResource\Pages;
use App\Filament\Resources\TournamentOfficialResource\RelationManagers;

class TournamentOfficialResource extends Resource
{
    protected static ?string $model = TournamentOfficial::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('profile_picture')
                ->image(),
                Select::make('type_of_sport')
                ->options(TypeOfSport::all()->pluck('name', 'id')),
                Forms\Components\TextInput::make('member')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('age')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('height')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('weight')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('profile_picture'),
                Tables\Columns\TextColumn::make('type_of_sport'),
                Tables\Columns\TextColumn::make('member'),
                Tables\Columns\TextColumn::make('age'),
                Tables\Columns\TextColumn::make('height'),
                Tables\Columns\TextColumn::make('weight'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTournamentOfficials::route('/'),
            'create' => Pages\CreateTournamentOfficial::route('/create'),
            'edit' => Pages\EditTournamentOfficial::route('/{record}/edit'),
        ];
    }
}
