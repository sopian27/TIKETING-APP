<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Filament\Panel;
use Illuminate\Support\Facades\Route;

class Laporan extends Page
{
    protected string $view = 'filament.pages.laporan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Laporan';
}
