<?php

namespace App\Http\Livewire\Agenda;

use Livewire\Component;

class Modal extends Component
{
    public $type = "";
    
    protected $listeners = ['modalOpened'];

    public function render()
    {
        return view('livewire.agenda.modal', ["type" => $this->type]);
    }

    public function modalOpened($type)
    {
        $this->type = $type;
        $this->render();
    }

    public function close()
    {
        $this->emit('modalClosed');
    }
}
