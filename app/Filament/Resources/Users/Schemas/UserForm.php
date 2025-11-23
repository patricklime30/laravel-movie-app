<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        $isCreate = $schema->getOperation() === "create";
        $isEdit = $schema->getOperation() === "edit";

        return $schema
            ->components([
                Section::make('User Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('roles')
                            ->label('Role')
                            ->relationship('roles', 'name')
                            ->getOptionLabelFromRecordUsing(function ($record) {
                            
                                if ($record->name === 'admin') {
                                    return 'Admin'; 
                                } elseif ($record->name === 'user') {
                                    return 'User';
                                }

                                return $record->name;
                            })
                            ->required(),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->label('Password')
                            ->required($isCreate)
                            ->helperText($isEdit ? 'Leave empty if not changed the password.' : ''),
                    ])
            ])->columns(1);
    }
}
