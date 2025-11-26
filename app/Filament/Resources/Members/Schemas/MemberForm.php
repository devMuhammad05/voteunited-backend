<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('external_id')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('party'),
                TextInput::make('state'),
                TextInput::make('district')
                    ->numeric(),
                FileUpload::make('image_url')
                    ->image(),
                FileUpload::make('image_attribution')
                    ->image(),
                TextInput::make('terms'),
                TextInput::make('source_url'),
                DateTimePicker::make('external_updated_at'),
            ]);
    }
}
