<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MoviesRelationManager extends RelationManager
{
    protected static string $relationship = 'movies';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),
                Textarea::make('description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),
                TextInput::make('genre')
                    ->required(),
                Select::make('release_year')
                    ->options(array_combine(range(2000, 2025), range(2000, 2025)))
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('movies')
                    ->required()
                    ->columnSpan(2),
            ])->columns(2);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    ImageEntry::make('image')
                        ->disk('public')
                        ->imageSize('100%')
                        ->hiddenLabel(),
                ]),

                Section::make([
                    TextEntry::make('title'),
                    TextEntry::make('description'),
                    TextEntry::make('genre')
                        ->badge()
                        ->color('gray')
                        ->formatStateUsing(fn (string $state) => ucfirst($state)),
                    TextEntry::make('release_year'),
                ])

            ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ImageColumn::make('image')
                    ->square()
                    ->disk('public'),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('description')
                    ->limit(80),
                TextColumn::make('genre')
                    ->badge()
                    ->color('gray'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
