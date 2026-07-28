<?php
// namespace App\Livewire;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Transaction;

new class extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $results = '';
    public $search = '';
    public $transaction_id = '';
    public $description = '';
    public $date_of_transaction = '';
    public function delete_transaction($id){
        Transaction::find($id)->delete();
        session()->flash('delete_transaction_message', 'Transaction deleted successfuly');
        return redirect('/transactions');
    }
    public function results(){
        if(isset($this->search)){
            $results = Transaction::where('description', 'LIKE', "%{$this->search}%")
            ->orWhere('date_of_transaction', 'LIKE', "%{$this->search}%")
            ->orderBy('id','DESC')->paginate(9);
        }
        else {
            $results = Transaction::orderBy('id','DESC')->paginate(9);
        }
        return $results;
    }
    public function resetInput(){
        $this->transaction_id = '';
        $this->description = '';
        $this->date_of_transaction = '';
    }
    public function edit_transaction($id){
        $transaction = Transaction::findOrFail($id);
        $this->transaction_id = $transaction->id;
        $this->description = $transaction->description;
        $this->date_of_transaction = $transaction->date_of_transaction; 
    }
    public function update_transaction(){
        if($this->transaction_id){
                $transaction = Transaction::find($this->transaction_id);
                $transaction->update([
                'description' => str_replace(['And','To','Of','For', 'A'],['and', 'to', 'of', 'for', 'a'],ucwords(strtolower($this->description))),
                'date_of_transaction' => $this->date_of_transaction,
            ]);
            $this->resetInput();
        }
        session()->flash('update_transaction_message', 'Transaction updated successfuly');
        return redirect('/transactions');
    }
    
    
    
};
?>

<div class="mt-2">
    <!-- Transaction Edit Modal -->
        <div wire:ignore class="modal fade" id="edit_transaction_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="edit_transaction_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h6 class="modal-title" id="edit_transaction_modal_label">Edit Transaction</h6>
                <button type="button" class="btn-close btn-sm bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form autocomplete="off" wire:submit="update_transaction">
                    <div class="row mt-2">
                        <div class="col col-sm">
                            <label for="">Description</label>
                            <input type="text" class="form-control form-control-sm bg-success-subtle" wire:model="description" value="{{ $this->description }}">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col col-sm">
                            <label for="">Date of Transaction</label>
                            <input type="date" class="form-control form-control-sm bg-success-subtle" wire:model="date_of_transaction" value="{{ $this->date_of_transaction }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col col-sm">
                            <input type="submit" class="btn btn-sm btn-success" value="Update">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-dark-subtle">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
    <!-- Transaction Edit Modal ends here -->
    <div class="card">
        <div class="card-body">
            <form autocomplete="off" id="search_form">
                <div class="input-group input-group-sm mb-3 mt-3">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm bg-success-subtle" placeholder="Search transactions here..." >
                    {{-- <button wire:click=search class="btn btn-sm btn-secondary">Search</button> --}}
                    {{-- <a href="" class="btn btn-sm btn-dark" onclick="localStorage.clear()">Remove filter</a>     --}}
                </div>
            </form>
            <table class="table table-sm table-secondary table-hover transactions_table">
                <caption>List of Transactions</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Date of Transaction</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($this->results()->isNotEmpty())
                        @foreach($this->results() as $transaction)
                            <tr>
                                <td>{{$transaction->id}}</td>
                                <td>{{$transaction->description}}</td>
                                <td>{{date('l jS F Y' ,strtotime($transaction->date_of_transaction))}}</td>
                                <td id="action_buttons">
                                    <button type="button"  wire:click="edit_transaction({{ $transaction->id }})" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit_transaction_modal" id="edit_button">Edit</button>&nbsp
                                    <button type="button" wire:click="delete_transaction({{ $transaction->id }})" wire:confirm="Are you sure you want to delete transaction?" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach    
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No Transaction found!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-3">
                {{ $this->results()->links(data: ['scrollTo' => false]) }}
            </div>
        </div>
    </div>
    {{-- <form autocomplete="off" id="search_form">
        <div class="input-group input-group-sm mb-3 mt-3">
            <input type="text" wire:model.live="search" class="form-control form-control-sm bg-success-subtle" placeholder="Search transactions here..." >
        </div>
    </form> --}}
    {{-- <table class="table table-sm table-active transactions_table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Date of Transaction</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($this->results()->isNotEmpty())
                @foreach($this->results() as $transaction)
                <tr>
                    <td>{{$transaction->id}}</td>
                    <td>{{$transaction->description}}</td>
                    <td>{{date('l jS F Y' ,strtotime($transaction->date_of_transaction))}}</td>
                    <td id="action_buttons">
                        <button type="button"  wire:click="edit_transaction({{ $transaction->id }})" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit_transaction_modal" id="edit_button">Edit</button>&nbsp
                        <button type="button" wire:click="delete_transaction({{ $transaction->id }})" wire:confirm="Are you sure you want to delete transaction?" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach    
            @else
            <tr>
                <td colspan="4" class="text-center">No Transaction found</td>
            </tr>
            @endif
                
        </tbody>
        
    </table> --}}
    {{-- <div class="mt-3">
        {{ $this->results()->links(data: ['scrollTo' => false]) }}
    </div> --}}
</div>