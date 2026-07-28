<?php

use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Account;
new class extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $results = '';
    public $search = '';
    public $account_id = '';
    public $account_name = '';
    public $head = '';
    public $normal_balance = '';
    public function delete_account($id){
        Account::find($id)->delete();
        session()->flash('delete_account_message', 'Account deleted successfully');
        return redirect('/accounts');
    }
    public function results(){
        if(isset($this->search)){
            $results = Account::where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('head', 'LIKE', "%{$this->search}%")
            ->orWhere('normal_balance', 'LIKE', "%{$this->search}%")
            ->orderBy('id','DESC')->paginate(9);
        }
        else {
            $results = Account::orderBy('id','DESC')->paginate(9);
        }
        return $results;
    }
    public function resetInput(){
        $this->account_id = '';
        $this->account_name = '';
        $this->head = '';
        $this->normal_balance = '';
    }
    public function edit_account($id){
        $account = Account::findOrFail($id);
        $this->account_id = $account->id;
        $this->account_name = $account->name;
        $this->head = $account->head;
        $this->normal_balance = $account->normal_balance; 
    }
    public function update_account(){
        if($this->account_id){
                $account = Account::find($this->account_id);
                $account->update([
                'name' => str_replace(['And','To','Of','For', 'A'],['and', 'to', 'of', 'for', 'a'],ucwords(strtolower($this->account_name))),
                'head' => $this->head,
                'normal_balance' => $this->normal_balance
            ]);
            $this->resetInput();
        }
        session()->flash('update_account_message', 'Account updated successfuly');
        return redirect('/accounts');
    }
};
?>

<div class="mt-2">
    <!-- Edit Modal -->
        <div wire:ignore class="modal fade" id="edit_account_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="edit_account_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h6 class="modal-title" id="edit_account_modal_label">Edit Account</h6>
                    <button type="button" class="btn-close btn-sm bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" wire:submit="update_account">
                        <div class="row mt-2">
                            <div class="col col-sm">
                                <label for="">Account Name/Title</label>
                                <input type="text" class="form-control form-control-sm bg-success-subtle" wire:model="account_name" value="{{ $this->account_name }}">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col col-sm">
                                <label for="">Head</label>
                                <select wire:model="head" id="" class="form-select form-select-sm bg-success-subtle">
                                    <option value="" {{ $this->head == '' ? 'selected':'' }}>Select an account head...</option>
                                    <option value="Asset" {{ $this->head == 'Asset' ? 'selected':'' }}>Asset</option>
                                    <option value="Liability" {{ $this->head == 'Liability' ? 'selected':'' }}>Liability</option>
                                    <option value="Equity" {{ $this->head == 'Equity' ? 'selected':'' }}>Equity</option>
                                    <option value="Income" {{ $this->head == 'Income' ? 'selected':'' }}>Income</option>
                                    <option value="Expense" {{ $this->head == 'Expense' ? 'selected':'' }}>Expense</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col col-sm">
                                <label for="">Normal Balance</label>
                                <select wire:model="normal_balance" id="" class="form-select form-select-sm bg-success-subtle">
                                    <option value="" {{ $this->normal_balance == '' ? 'selected':'' }}>Select normal balance...</option>
                                    <option value="Debit" {{ $this->normal_balance == 'Debit' ? 'selected':'' }}>Debit</option>
                                    <option value="Credit" {{ $this->normal_balance == 'Credit' ? 'selected':'' }}>Credit</option>
                                </select>
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
    <!-- Edit Modal ends here -->
    <div class="card">
        <div class="card-body">
            <form autocomplete="off" id="search_form">
                <div class="input-group input-group-sm mb-3 mt-3">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm bg-success-subtle" placeholder="Search Accounts here..." >
                </div>
            </form>
            <table class="table table-sm table-secondary table-hover accounts_table">
                <caption>List of Accounts</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Head</th>
                        <th>Normal Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($this->results()->isNotEmpty())
                        @foreach($this->results() as $account)
                        <tr>
                            <td>{{$account->id}}</td>
                            <td>{{$account->name}}</td>
                            <td>{{$account->head}}</td>
                            <td>{{$account->normal_balance}}</td>
                            <td id="action_buttons">
                                <button type="button" wire:click="edit_account({{ $account->id }})" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit_account_modal" id="edit_button">Edit</button>&nbsp
                                <button type="button" wire:click="delete_account({{ $account->id }})" wire:confirm="Are you sure you want to delete account?" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach    
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No Account found!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-3">
                {{ $this->results()->links(data: ['scrollTo' => false]) }}
            </div>
        </div>
    </div>
</div>