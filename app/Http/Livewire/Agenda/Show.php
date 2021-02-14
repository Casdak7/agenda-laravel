<?php

namespace App\Http\Livewire\Agenda;

use Livewire\Component;
use App\Models\Contact;

class Show extends Component
{   
    public $search_query = "";
    public $search = "";

    public function render()
    {   
        $list = Contact::where("name",'like','%'.$this->search_query.'%')->orderBy("name")->paginate(10);

        return view('livewire.agenda.show', ["list" => $list]);
    }

    public function search()
    {
        if(strlen($this->search) >= 3){
            $this->search_query = $this->search;
            $this->render();
        } else {
            $this->emit("search_error");
        }
    }

    public function clearSearch()
    {
        $this->search_query = "";
        $this->render();
    }
}
