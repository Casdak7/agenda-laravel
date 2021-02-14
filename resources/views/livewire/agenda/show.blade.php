<div>
    <div class="m-4 flex justify-end">
        <div class="mr-2 my-auto">
          <a href="{{route('contact.create')}}" class="bg-green-100 text-green-600 px-6 rounded-full">Criar novo Contato</a>
        </div>
        @if(strlen($search_query) > 0)
        <div class="mr-2 my-auto">
          <button wire:click="clearSearch()" class="bg-blue-100 text-blue-600 px-6 rounded-full">Limpar Resultados</button>
        </div>
        @endif
        <div>
          <x-jet-input id="search" type="text" class="mt-1 block" wire:model.defer="search" wire:keydown.enter="search()" autocomplete="search" placeholder="Aperte Enter" min-width="3"/>
          <x-jet-action-message on="search_error">
            {{ __('Digite 3 ou mais caracteres.') }}
          </x-jet-action-message>
        </div>
    </div>
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class="px-4 py-2">Nome</th>
            <th class="px-4 py-2">Contatos</th>
            <th class="px-4 py-2">Endereço</th>
            <th class="px-4 py-2">Data de Nascimento</th>
            <th class="px-4 py-2">Ações</th>     
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $item)
            <tr @if($loop->even)class="bg-grey"@endif>
                <td class="border px-4 py-2">{{ $item->name }}</td>       
                <td class="border px-4 py-2">
                  @foreach($item->contactInformations as $info)
                    {{$info->information}} - {{$info->informationType->name}} <br>
                  @endforeach
                </td>       
                <td class="border px-4 py-2">{{ $item->address }}</td>       
                <td class="border px-4 py-2">{{ $item->birthdate->format("d/m/Y") }}</td>       
                <td class="border px-4 py-2"> 
                  <a href="{{route('contact.edit', $item)}}" class="bg-yellow-100 text-yellow-600 px-6 rounded-full">Editar</a>
                </td>       
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="m-2">
        {{ $list->links() }}
    </div>
</div>