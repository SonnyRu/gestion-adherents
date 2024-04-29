<x-guest-layout>

    <a href="{{ route('dashboard') }}" class="flex items-center justify-end">
        <x-primary-button>
            {{ __('Retour') }}
        </x-primary-button>
    </a>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('Prénom')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Téléphone -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Téléphone')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="phone_number" name="phone_number" :value="old('phone_number')" required autocomplete="phone_number" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Rôle')" />
            <x-text-input id="role" type="radio" name="role" value="president" required autocomplete="role" /><label for="role" class="text-xs">Président</label>
            <x-text-input id="role2" type="radio" name="role" value="secretaire" required autocomplete="role" /><label for="role2" class="text-xs">Secrétaire</label>
            <x-text-input id="role3" type="radio" name="role" value="coach" required autocomplete="role" /><label for="role3" class="text-xs">Coach</label>
            <x-text-input id="role4" type="radio" name="role" value="nageur" required autocomplete="role" checked/><label for="role4" class="text-xs">Nageur</label>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Certificat médical -->
        <div class="input-group mt-4">
            <x-input-label for="certificatMedical" :value="__('Certificat médical')" />
            <x-text-input id="certificatMedical" class="form-control block mt-1 w-full" type="file" name="certificatMedical" required autocomplete="certificatMedical" />
            <x-input-error :messages="$errors->get('certificatMedical')" class="mt-2" />
            
            @if($errors->any())
                <div style="color: #FF0000;">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        
        <!-- Case A cotisé ? -->
        <div class="mt-4">
            <x-text-input id="acotise" type="radio" name="acotise" value="1" required autocomplete="acotise" /><label for="acotise" class="text-xs">J'ai déja cotisé pour le club</label>
            <x-text-input id="acotise2" type="radio" name="acotise" value="0" checked required autocomplete="acotise" /><label for="acotise" class="text-xs">Je n'ai pas cotisé</label>
            <x-input-error :messages="$errors->get('acotise')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Case partage de données -->
        <div class="mt-4">
            <x-text-input id="acceptpartagedonnees" type="radio" name="acceptpartagedonnees" value="1" required autocomplete="acceptpartagedonnees" /><label for="acceptpartagedonnees" class="text-xs">J'accepte de partager mes données avec les adhérents de Lyonpalme</label>
            <x-text-input id="acceptpartagedonnees2" type="radio" name="acceptpartagedonnees" value="0" checked required autocomplete="acceptpartagedonnees" /><label for="acceptpartagedonnees" class="text-xs">Je refuse</label>
            <x-input-error :messages="$errors->get('acceptpartagedonnees')" class="mt-2" />
        </div>

        <!-- Case politique -->
        <div class="mt-4">
            <x-text-input id="acceptpolitique" type="checkbox" name="acceptpolitique" value="1" required autocomplete="acceptpolitique" /><label for="acceptpolitique" class="text-xs">J'accepte la politique de confidentialité</label>
            <x-input-error :messages="$errors->get('acceptpolitique')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Inscrire') }}</x-primary-button>
    
                @if (session('status') === 'profile-registered')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Registered successfully.') }}</p>
                @endif
            </div>
        </div>
    </form>
</x-guest-layout>
