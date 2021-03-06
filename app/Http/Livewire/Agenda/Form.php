<?php

namespace App\Http\Livewire\Agenda;

use App\Models\Contact;
use App\Models\ContactInformation;
use App\Models\InformationType;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    public $name, $address, $birthdate;

    // Determina se formulário está criando ou editando
    public $updateMode = false;

    //Modelo para atualização do contato
    public $contact, $contactTypes, $contactInfo;

    //Novo tipo de informação
    public $newInformationType;

    protected $rules = [
        'name' => 'required',
        'contactInfo.*.information' => ['required', 'string', 'max:255'],
        'contactInfo.*.information_type_id' => ['required', 'integer'],
    ];

    public function mount()
    {
        $this->contactTypes = InformationType::all();
        $this->contactInfo = [];
        
        if($this->contact != null){
            $this->edit($this->contact);
            $this->contactInfo = $this->contact->contactInformations->toArray();
        }
    }

    /**
     * Função para retornar dados do modelo atual mais rápidamente.
     */
    public function getData()
    {
        $data = [
            "name" => $this->name,
            "address" => $this->address,
            "birthdate" => $this->birthdate,
            "user_id" => Auth::id(),
        ];

        return $data;
    }

    public function setData(Contact $contact)
    {
        $this->name = $contact->name;
        $this->address = $contact->address;
        $this->birthdate = $contact->birthdate->format('Y-m-d');
    }

    /**
     * Limpa os dados do formulário
     */
    public function clearData()
    {
        $this->name = "";
        $this->address = "";
        $this->birthdate = "";
        $this->contact = "";
    }

    public function render()
    {
        return view('livewire.agenda.form');
    }

    public function create()
    {
        $this->validate();

        $this->contact = Contact::create($this->getData());
        
        //Cria cada uma das informações associadas ao contato recém criado
        foreach ($this->contactInfo as $key => $info) {
            ContactInformation::create(array_merge($info, ["contact_id" => $this->contact->id]));
        }

        session()->flash('success', "Contato salvo com sucesso");

        return redirect(route("dashboard"));
    }

    public function edit(Contact $contact)
    {
        $this->updateMode = true;
        $this->setData($contact);
    }
    
    public function update()
    {   
        $this->validate();
        $this->contact->update($this->getData());

        //Salva as informações existentes e cria as novas informações de contato
        foreach ($this->contactInfo as $key => $info) {
            if(isset($info["id"])){
                $info = ContactInformation::find($info["id"]);
                $info->save();
            }else{
                ContactInformation::create(array_merge($info, ["contact_id" => $this->contact->id]));
            }
        }

        //Coleção para facilitar comparações
        $contactInfoCollection = collect($this->contactInfo)->pluck('id');

        //Deleta as informações que foram removidas
        foreach($this->contact->contactInformations as $info){
            if(!$contactInfoCollection->contains($info->id)){
                $info->delete();
            }
        }

        $this->updateMode = false;
        session()->flash('success', "Contato salvo com sucesso");
        return redirect(route("dashboard"));
    }

    public function delete()
    {
        $this->contact->delete();
        $this->updateMode = false;
        session()->flash('success', "Contato excluído com sucesso");
        return redirect(route("dashboard"));
    }

    public function cancel()
    {
        $this->updateMode = false;
        return redirect(route("dashboard"));
    }

    public function addContactInfo()
    {
        $newContactInformation = new ContactInformation();
        $newContactInformation->information_type_id = 1;
        $this->contactInfo[] = $newContactInformation;
    }

    public function removeContactInfo($key)
    {
        unset($this->contactInfo[$key]);
    }

    public function addInfoType()
    {
        $informationType = InformationType::create(["name" => $this->newInformationType]);
        
        $this->newInformationType = "";

        $this->contactTypes->push($informationType);

        $this->emit("info_created");
    }
}
