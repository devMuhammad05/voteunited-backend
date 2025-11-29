<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Post Details')
                    ->columns(2)
                    ->columnSpan(1)
                    ->components([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter an engaging post title')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            })
                            ->columnSpanFull(),

                        FileUpload::make('image_url')
                            ->label('Featured Image')
                            ->disk('public')
                            ->directory('posts')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('200')
                            ->nullable()
                            ->helperText('Upload a featured image for your post')
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Short Description')
                            ->maxLength(500)
                            ->rows(3)
                            ->placeholder('Write a brief description that will appear in post previews and search results')
                            ->helperText('Brief description for post preview (max 500 characters)')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Section::make('Content')
                    ->columns(1)
                    ->columnSpanFull()
                    ->components([
                        RichEditor::make('content')
                            ->label('Post Content')
                            ->required()
                            ->placeholder('Write your post content here... Use the toolbar above to format your content.')
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                            ->extraAttributes(['style' => 'min-height: 400px;']),

                        Toggle::make('is_active')
                            ->label('Publish Post')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Toggle to publish or unpublish this post'),
                    ]),


            ]);
    }
}
