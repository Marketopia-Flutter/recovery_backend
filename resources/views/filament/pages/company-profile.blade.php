<x-filament-panels::page>
    <form wire:submit="save" class="space-y-6">
        {{ $this->form }}

        <div class="border-t border-gray-200 pt-6 mt-6">
            <x-filament-panels::form.actions :actions="$this->getFormActions()"
                :full-width="$this->hasFullWidthFormActions()" />
        </div>
    </form>
</x-filament-panels::page>