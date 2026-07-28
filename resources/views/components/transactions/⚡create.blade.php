<?php

use Livewire\Component;
use App\Models\Transaction;
new class extends Component
{
    public $description = '';
    public $date_of_transaction = '';
    public function save_transaction(){
        Transaction::create([
            'description' => str_replace(['And','To','Of','For', 'A', 'The'],['and', 'to', 'of', 'for', 'a', 'the'],ucwords(strtolower($this->description))),
            'date_of_transaction' => $this->date_of_transaction,
        ]);
        session()->flash('save_transaction_message', 'Transaction created successfuly');
        return redirect('/transactions');
    }
};
?>
<!-- Add Transaction Modal -->
        <div wire:ignore class="modal fade" id="add_transaction_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="add_transaction_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h6 class="modal-title" id="add_transaction_modal_label">Add Transaction</h6>
                <button type="button" class="btn-close btn-sm bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form autocomplete="off" wire:submit="save_transaction">
                    <div class="row mt-2">
                        <div class="col col-sm">
                            <label for="">Description</label>
                            <input type="text" class="form-control form-control-sm bg-success-subtle" wire:model="description" placeholder="Description of Transaction...">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col col-sm">
                            <label for="">Date of Transaction</label>
                            <input type="text" class="form-control form-control-sm bg-success-subtle" wire:model="date_of_transaction" onfocus="(this.type='date')" placeholder="Date of Transaction perfomed...">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col col-sm">
                            <input type="submit" class="btn btn-sm btn-success" id="save_transaction_button" value="Save">
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
    <!-- Add Modal ends here -->
{{-- <div class="mt-2" id="transaction_add_form">
    <form  wire:submit="save" autocomplete="off">
        <div class="row">
            <div class="col col-sm">
                <label class="form-label">Description</label>
                <input type="text" wire:model="description" class="form-control form-control-sm"  placeholder="Description of transaction...">
            </div>
            <div class="col col-sm">
                <label class="form-label">Date of Transaction</label>
                <input type="date" wire:model="date_of_transaction" class="form-control form-control-sm">
            </div>
            <div class="col col-sm mt-4">
                <button type="submit" class="btn btn-dark btn-sm mt-2" id="submit_button">submit</button>
            </div>
        </div>
    </form>
</div> --}}