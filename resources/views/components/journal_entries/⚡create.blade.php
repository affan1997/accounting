<?php

use Livewire\Component;
use Illuminate\Support\Facades\DB;
new class extends Component
{
    public $account_id = '';
    public $transaction_id = '';
    public $amount = '';
    public $direction = '';
    public function get_accounts(){
        $accounts = DB::select('select * from accounts');
        return $accounts;
    }
    public function get_transactions(){
        $transactions = DB::select('select * from transactions');
        return $transactions;
    }
    public function save_journal_entry(){
        DB::transaction(function(){
            if($this->direction == 'Debit'){
            DB::table('journal_entries')->insert([
            'account_id' => $this->account_id,
            'transaction_id' => $this->transaction_id,
            'amount' => $this->amount,
            'direction' => 'Debit',
            ]);
        }else if($this->direction = 'Credit'){
            DB::table('journal_entries')->insert([
            'account_id' => $this->account_id,
            'transaction_id' => $this->transaction_id,
            'amount' => $this->amount,
            'direction' => 'Credit',
            ]);
        }
            session()->flash('save_journal_entry_message', 'Double Journal Entry created successfully');
            return redirect('/journal_entries');
        }, attempts:10);
        
    }
};
?>
<!-- Add Journal Entry Modal -->
    <div wire:ignore class="modal fade" id="add_journal_entry_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="add_journal_entry_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h6 class="modal-title" id="add_journal_entry_modal_label">Add Journal Entry</h6>
                    <button type="button" class="btn-close btn-sm bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" wire:submit="save_journal_entry">
                        <div class="row mt-2">
                            <div class="col col-sm">
                                <label for="">Account Name/Title</label>
                                <select wire:model="account_id" name="" id="" class="form-select form-select-sm bg-success-subtle">
                                    <option value="" selected disabled>Select Account...</option>
                                    @foreach ($this->get_accounts() as $account)
                                        <option value="{{ $account->id }}">{{$account->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col col-sm">
                                <label for="">Transaction</label>
                                <select wire:model="transaction_id" id="transaction_id" class="form-select form-select-sm bg-success-subtle">
                                    <option value="" selected disabled>Select Transaction...</option>
                                    @foreach ($this->get_transactions() as $transaction)
                                        <option value="{{ $transaction->id }}">{{$transaction->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col col-sm">
                                <label for="">Amount</label>
                                <input type="number" class="form-control form-control-sm bg-success-subtle" wire:model="amount" id="amount" placeholder="Amount...">
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="col col-sm">
                                <label for="">Direction</label>
                                <select wire:model="direction" id="direction" class="form-select form-select-sm bg-success-subtle">
                                    <option value="" disabled selected>Select direction...</option>
                                    <option value="Debit">Debit</option>
                                    <option value="Credit">Credit</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col col-sm">
                                <input type="submit" class="btn btn-sm btn-success" id="save_journal_entry_button" value="Save">
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
<!-- Add Journal Entry Modal ends here -->
