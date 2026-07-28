<?php

use Livewire\Component;
use App\Models\Account;
new class extends Component
{
    public $account_name = '';
    public $head = '';
    public $normal_balance = '';
    public function save_account(){
        Account::create([
            'name' => str_replace(['And','To','Of','For', 'A', 'The'],['and', 'to', 'of', 'for', 'a', 'the'],ucwords(strtolower($this->account_name))),
            'head' => $this->head,
            'normal_balance' => $this->normal_balance
        ]);
        session()->flash('save_account_message', 'Account created successfuly');
        return redirect('/accounts');
    }
};
?>

<!-- Add Account Modal -->
    <div wire:ignore class="modal fade" id="add_account_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="add_account_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h6 class="modal-title" id="add_account_modal_label">Add Account</h6>
                    <button type="button" class="btn-close btn-sm bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" wire:submit="save_account">
                        <div class="row mt-2">
                            <div class="col col-sm">
                                <label for="">Account Name/Title</label>
                                <input type="text" class="form-control form-control-sm bg-success-subtle" wire:model="account_name" id="account_name" placeholder="Name/Title of Account...">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col col-sm">
                                <label for="">Head</label>
                                <select wire:model="head" id="head" class="form-select form-select-sm bg-success-subtle">
                                    <option value="" disabled selected>Select an account head...</option>
                                    <option value="Asset">Asset</option>
                                    <option value="Liability">Liability</option>
                                    <option value="Equity">Equity</option>
                                    <option value="Income">Income</option>
                                    <option value="Expense">Expense</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="col col-sm">
                                <label for="">Normal Balance</label>
                                <select wire:model="normal_balance" id="normal_balance" class="form-select form-select-sm bg-success-subtle">
                                    <option value="" disabled selected>Select normal balance...</option>
                                    <option value="Debit">Debit</option>
                                    <option value="Credit">Credit</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col col-sm">
                                <input type="submit" class="btn btn-sm btn-success" id="save_account_button" value="Save">
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
<!-- Add Account Modal ends here -->
