<x-guest-layout>

    <a href="{{ route('dashboard') }}" class="flex items-center justify-end">
        <x-primary-button>
            {{ __('Retour') }}
        </x-primary-button>
    </a>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-red-900">
                    {{ __("Non Authorized !") }}
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
