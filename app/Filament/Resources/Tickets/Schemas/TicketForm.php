<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;

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
                TextInput::make('subject')
                    ->required(),
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
                        'progress' => 'Processing',
                        'finish' => 'Finish',
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
