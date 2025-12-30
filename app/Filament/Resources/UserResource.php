<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return 'المستخدمين';
    }

    public static function getModelLabel(): string
    {
        return 'مستخدم';
    }

    public static function getPluralModelLabel(): string
    {
        return 'المستخدمين';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معلومات المستخدم')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->label('كلمة المرور')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->maxLength(255)
                            ->helperText('اتركها فارغة للحفاظ على كلمة المرور الحالية عند التعديل'),
                    ])->columns(2),

                Forms\Components\Section::make('حقول تطبيق التعافي')
                    ->schema([
                        Forms\Components\FileUpload::make('avatar')
                            ->label('الصورة الشخصية')
                            ->image()
                            ->directory('avatars')
                            ->imageEditor(),
                        Forms\Components\DateTimePicker::make('clean_date')
                            ->label('تاريخ التعافي (بداية العداد)')
                            ->helperText('التاريخ الذي بدأ فيه المستخدم عداد التعافي الحالي'),
                        Forms\Components\TextInput::make('fcm_token')
                            ->label('رمز FCM')
                            ->maxLength(255)
                            ->helperText('رمز خدمة Firebase للإشعارات'),
                        Forms\Components\Toggle::make('is_guest')
                            ->label('مستخدم زائر')
                            ->helperText('المستخدمين الزوار مجهولي الهوية'),
                        Forms\Components\Toggle::make('is_admin')
                            ->label('مدير نظام')
                            ->helperText('مدراء النظام يمكنهم دخول لوحة التحكم'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('الصورة')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('البريد الإلكتروني')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_admin')
                    ->boolean()
                    ->label('مسؤول')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_guest')
                    ->boolean()
                    ->label('زائر')
                    ->sortable(),
                Tables\Columns\TextColumn::make('clean_date')
                    ->label('بداية العداد')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('streak_days')
                    ->label('أيام التعافي')
                    ->state(function (User $record): int {
                        return $record->streak_days ?? 0;
                    })
                    ->badge()
                    ->color('success')
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('clean_date', $direction === 'asc' ? 'desc' : 'asc');
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_admin')
                    ->toggle()
                    ->label('المدراء فقط')
                    ->query(fn (Builder $query): Builder => $query->where('is_admin', true)),
                Tables\Filters\Filter::make('is_guest')
                    ->toggle()
                    ->label('الزوار فقط')
                    ->query(fn (Builder $query): Builder => $query->where('is_guest', true)),
                Tables\Filters\Filter::make('active_streak')
                    ->toggle()
                    ->label('عداد نشط')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('clean_date')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('عرض'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
