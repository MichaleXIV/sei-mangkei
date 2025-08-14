<div class="flex justify-between w-full">
    @if ($wizard->hasPreviousStep())
        <x-filament::button
            type="button"
            color="secondary"
            wire:click="previousStep"
            size="lg"
        >
            Previous
        </x-filament::button>
    @else
        <div></div>
    @endif

    <x-filament::button
        type="submit"
        size="lg"
        wire:loading.attr="disabled"
    >
        {{ $wizard->isLastStep() ? 'Submit' : 'Next' }}
    </x-filament::button>
</div>
