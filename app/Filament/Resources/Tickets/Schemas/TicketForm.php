<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id')
                    ->label('ID')
                    ->disabled(),
                TextInput::make('ticket_uuid')
                    ->label('Ticket ID')
                    ->disabled(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                Toggle::make('is_spam')
                    ->label('Non Spam?')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')
                    ->default(1)
                    ->helperText('ON = Non Spam, OFF = Spam'),
                TextInput::make('subject')
                    ->required(),
                TextInput::make('spam_confidence')
                    ->label('Spam Confidence')
                    ->disabled(),
                TextInput::make('image_relevant')
                    ->label('Image Relevant')
                    ->disabled(),
                TextInput::make('relevance_score')
                    ->label('Relevance Score')
                    ->disabled(),
                Textarea::make('ml_response')
                    ->label('ML Response (JSON)')
                    ->formatStateUsing(function ($state) {
                        if (empty($state)) {
                            return null;
                        }

                        return json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                    })
                    ->rows(15)
                    ->disabled()
                    ->columnSpanFull(),
                Textarea::make('message')
                    ->label('Pengaduan')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('images')
                    ->label('Images')
                    ->disk('public')
                    ->directory('tickets')
                    ->image()
                    ->multiple()
                    ->downloadable()
                    ->previewable(true)
                    ->disabled(),
                Select::make('status')
                    ->label('Status Ticket')
                    ->options([
                        'pending' => 'Pending',
                        'waiting' => 'Waiting',
                        'processing' => 'Processing',
                        'finish' => 'Finish',
                        'drop' => 'Drop',
                    ])
                    ->rules([
                        function ($attribute, $value, $fail) {
                            $record = request()->route('record');

                            if (!$record) return;

                            $ticket = \App\Models\Ticket::find($record);

                            if ($ticket->status === 'pending' && $value === 'finish') {
                                $fail('Status tidak boleh langsung ke finish.');
                            }
                        }
                    ])
                    ->required()
                    ->native(false), // dropdown filament
                Textarea::make('admin_notes')
                    ->columnSpanFull(),
            ]);
    }
}
