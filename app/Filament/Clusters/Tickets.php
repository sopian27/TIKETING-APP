<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;

class Tickets extends Cluster
{
    protected static ?string $navigationLabel = 'Pengaduan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
}
