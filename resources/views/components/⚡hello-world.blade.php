<?php

use Livewire\Component;

new class extends Component
{
    public $count=1;
    public function increment($by){
        $this->count += $by;
    }
    public function decrement($by){
        $this->count -= $by;
    }
};
?>

{{-- <div class="container p-5">
    <p class="bg-dark text-light">The current time is {{time()}}</p>
    <button wire:click="$refresh" class="btn btn-sm btn-success">Refresh</button>
</div> --}}
<div class="container p-2">
    <p>Count:{{$count}}</p>
    <button class="btn btn-success" wire:click=increment(2)>+2</button>
    <button class="btn btn-success" wire:click=decrement(2)>-2</button>
</div>