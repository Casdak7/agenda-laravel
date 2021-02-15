<div>
    <x-jet-form-section submit="{{!$updateMode ? 'create' : 'update'}}">
        <x-slot name="title">
            {{ __((!$updateMode ? 'Novo' : 'Editar') . ' Contato') }}
        </x-slot>

        <x-slot name="description">
            {{ __((!$updateMode ? 'Adicionar novo' : 'Editar') . ' contato para a Agenda.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="name" value="{{ __('Nome') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="name" required/>
                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="address" value="{{ __('Endereço') }}" />
                <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="address" autocomplete="address" required/>
                <x-jet-input-error for="address" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="birthdate" value="{{ __('Data de Nascimento') }}" />
                <x-jet-input id="birthdate" type="date" class="mt-1 block w-full" wire:model.defer="birthdate" autocomplete="birthdate" required/>
                <x-jet-input-error for="birthdate" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-2">
                <x-jet-label for="new_information_type" value="{{ __('Novo Tipo de Informação (email, telefone, etc.)') }}" />
                <x-jet-input id="new_information_type" type="text" class="mt-1 block w-full" wire:model.defer="newInformationType" autocomplete="new_information_type" required/>
                <x-jet-input-error for="new_information_type" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-2">
                <x-jet-button class="mr-2 my-auto bg-green-600 text-white" wire:click="addInfoType()" type="button">
                    {{ __('Adicionar Novo Tipo de Informação') }}
                </x-jet-button>
            </div>
            <div class="col-span-6 sm:col-span-2">
                <x-jet-button class="bg-blue-600 text-white" wire:click="addContactInfo()" type="button">
                    {{ __('Adicionar Nova Informação de Contato') }}
                </x-jet-button>
            </div>
            @foreach($contactInfo as $key => $info)
            <div class="col-span-6 sm:col-span-2">
                <x-jet-label for="informationType-{{$key}}" value="{{ __('Tipo de Informação') }}" />
                <select id="informationType-{{$key}}" type="text" class="mt-1 block w-full" wire:model.defer="contactInfo.{{$key}}.information_type_id" autocomplete="informationType" required>
                    @foreach($contactTypes as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="informationType-{{$key}}" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="information-{{$key}}" value="{{ __('Informação') }}" />
                <x-jet-input id="information-{{$key}}" type="text" class="mt-1 block w-full" wire:model.defer="contactInfo.{{$key}}.information" autocomplete="information" required/>
                <x-jet-input-error for="information-{{$key}}" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-1 flex align-middle">
                <x-jet-button class="bg-red-600 text-white" wire:click="removeContactInfo({{$key}})" type="button">
                    {{ __('Remover') }}
                </x-jet-button>
            </div>
            @endforeach
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Contato Salvo.') }}
            </x-jet-action-message>
            <x-jet-action-message class="mr-3" on="info_created">
                {{ __('Novo Tipo de Informação Criada.') }}
            </x-jet-action-message>

            @if($updateMode)
            <x-jet-button class="mr-2 bg-red-600 text-white" wire:click="delete()" type="button">
                {{ __('Deletar') }}
            </x-jet-button>
            <x-jet-button class="mr-2" wire:click="cancel()" type="button">
                {{ __('Cancelar') }}
            </x-jet-button>
            @endif
            <x-jet-button>
                {{ __('Salvar') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>