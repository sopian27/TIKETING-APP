<x-filament::page>
    <x-filament::section>
        <p class="text-gray-600 dark:text-gray-300 mb-4">
            Silakan klik tombol di bawah untuk mendownload laporan.
        </p>
        <br/>
        <x-filament::button 
            :href="route('admin.laporan.download')"
            icon="heroicon-o-arrow-down-tray"
            tag="a"
            color="primary">
            Download Laporan
        </x-filament::button>
    </x-filament::section>
</x-filament::page>