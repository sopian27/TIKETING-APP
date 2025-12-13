<?php

namespace App\Filament\Resources\Tickets\Pages\Auth;

use App\Filament\Resources\Tickets\TicketResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class Login extends Page
{
    use InteractsWithRecord;

    protected static string $resource = TicketResource::class;

    protected string $view = 'filament.resources.tickets.pages.auth.login';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}
