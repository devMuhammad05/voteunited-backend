<?php

namespace App\Filament\Resources\Members\Tables;

use App\Enums\VoteType;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class MembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('external_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                ImageColumn::make('image_url')
                    ->label("Image"),

                TextColumn::make('name')
                    ->weight(FontWeight::Bold)
                    ->searchable(),
                TextColumn::make('party')
                    ->searchable(),
                TextColumn::make('state')
                    ->searchable(),
                TextColumn::make('district')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),


                TextColumn::make('total_upvotes')
                    ->label('Total Upvotes')
                    ->getStateUsing(fn($record) => $record->votes()
                        ->where('type', VoteType::Upvote)
                        ->count())
                    ->sortable(),

                TextColumn::make('total_downvotes')
                    ->label('Total Downvotes')
                    ->getStateUsing(fn($record) => $record->votes()
                        ->where('type', VoteType::Downvote)
                        ->count())
                    ->sortable(),

                // ImageColumn::make('image_attribution'),
                TextColumn::make('source_url')
                    ->tooltip("Click to copy source")
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('external_updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
