<?php

namespace App\Filament\Resources\Users\Schemas;

use Carbon\Carbon;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        TextEntry::make('roles.name')
                            ->label('Role')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'admin' => 'primary',
                                'user' => 'info',
                            })
                            ->formatStateUsing(fn (string $state) => ucfirst($state)),
                        TextEntry::make('movies_count')
                            ->counts('movies')
                            ->label('Total Movies')
                            ->icon(Heroicon::Film),
                        TextEntry::make('created_at')
                            ->label('Joined At')
                            ->formatStateUsing(fn (string $state) => Carbon::parse($state)->format('d M Y H:i:s')),
                    ])->columns(3), // columns inside the section

            ])->columns(1); // columns for the entire infolist
    }
}
