<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentResource\Pages;
use App\Filament\Resources\ContentResource\RelationManagers;
use App\Models\Content;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return 'المحتوى';
    }

    public static function getModelLabel(): string
    {
        return 'مادة';
    }

    public static function getPluralModelLabel(): string
    {
        return 'المحتوى';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('القسم')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->live(), // Make it live to trigger re-renders
                Forms\Components\TextInput::make('title')
                    ->label('العنوان')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('الوصف المختصر')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('body')
                    ->label('المحتوى (المقال)')
                    ->columnSpanFull(),
                
                // Media Upload - Hidden for articles, FileUpload for video/audio
                Forms\Components\FileUpload::make('media_url')
                    ->label(fn (Forms\Get $get): string => 
                        \App\Models\Category::find($get('category_id'))?->type === 'video' ? 'ملف الفيديو' : 'ملف صوتي'
                    )
                    ->directory('content-media')
                    ->disk('public')
                    ->visible(fn (Forms\Get $get): bool => 
                        in_array(\App\Models\Category::find($get('category_id'))?->type, ['video', 'audio'])
                    )
                    ->maxSize(1024000) // 1GB limit (still depends on PHP ini)
                    ->previewable()
                    ->openable()
                    ->downloadable()
                    ->required(),

                Forms\Components\FileUpload::make('thumbnail')
                    ->label('صورة مصغرة')
                    ->image()
                    ->directory('content-thumbnails')
                    ->disk('public')
                    ->previewable()
                    ->openable()
                    ->downloadable(),
                Forms\Components\Toggle::make('is_featured')
                    ->label('مميز')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('صورة'),
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('القسم')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.type')
                    ->label('النوع')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'article' => 'مقال',
                        'video' => 'فيديو',
                        'audio' => 'صوتي',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'article' => 'info',
                        'video' => 'success',
                        'audio' => 'warning',
                    })
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('مميز')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('تصفية بالقسم')
                    ->relationship('category', 'name'),
                Tables\Filters\Filter::make('is_featured')
                    ->toggle()
                    ->label('المميز فقط')
                    ->query(fn (Builder $query): Builder => $query->where('is_featured', true)),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('تعديل'),
                Tables\Actions\DeleteAction::make()->label('حذف'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('حذف المحدد'),
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
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }
}
