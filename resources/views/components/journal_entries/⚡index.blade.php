<?php
use Livewire\Attributes\Computed;
use Livewire\LivewireWithoutUrlPagination;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\JournalEntry;
new class extends Component
{
    public $results = '';
    public $search = '';
    public function delete_journal_entry($id){
        JournalEntry::find($id)->delete();
        session()->flash('delete_journal_entry_message', 'Journal Entry deleted successfuly');
        return redirect('/journal_entries');
    }
    public function results(){
        if(isset($this->search)){
            $results = DB::table('journal_entries')
                ->join('accounts', 'journal_entries.account_id', '=', 'accounts.id')
                ->join('transactions', 'journal_entries.transaction_id', '=', 'transactions.id')
                ->select('journal_entries.id as id', 'journal_entries.amount as amount', 
                'journal_entries.direction as direction', 'accounts.name as account_name', 
                'transactions.description as transaction_description', 'transactions.date_of_transaction as transaction_date')
                ->where('journal_entries.id', 'LIKE', "%{$this->search}%")
                ->orWhere('journal_entries.amount', 'LIKE', "%{$this->search}%")
                ->orWhere('journal_entries.direction', 'LIKE', "%{$this->search}%")
                ->orWhere('accounts.name', 'LIKE', "%{$this->search}%")
                ->orWhere('transactions.description', 'LIKE', "%{$this->search}%")
                ->orWhere('transactions.date_of_transaction', 'LIKE', "%{$this->search}%")
                ->orderBy('journal_entries.id','DESC')->paginate(9);
        }
        else {
            $results = DB::table('journal_entries')
                ->join('accounts', 'journal_entries.account_id', '=', 'accounts.id')
                ->join('transactions', 'journal_entries.transaction_id', '=', 'transactions.id')
                ->select('journal_entries.id as id', 'journal_entries.amount as amount', 
                'journal_entries.direction as direction', 'accounts.name as account_name', 
                'transactions.description as transaction_description', 'transactions.date_of_transaction as transaction_date')
            ->orderBy('journal_entries.id','DESC')->paginate(9);
        }
        return $results;
    }
};
?>
<div class="mt-2">
    <div class="card">
        <div class="card-body">
            <form autocomplete="off" id="search_form">
                <div class="input-group input-group-sm mb-3 mt-3">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm bg-success-subtle" placeholder="Search Journal Entries here..." >
                </div>
            </form>
            <table class="table table-sm table-secondary table-hover journal_entries_table">
                <caption>Journal Entries</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Account</th>
                        <th>Transaction</th>
                        <th>Transaction Date</th>
                        <th>Amount</th>
                        <th>Direction</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($this->results()->isNotEmpty())
                        @foreach($this->results() as $journal_entry)
                        <tr>
                            <td>{{$journal_entry->id}}</td>
                            <td>{{$journal_entry->account_name}}</td>
                            <td>{{$journal_entry->transaction_description}}</td>
                            <td>{{date('l jS F Y', strtotime($journal_entry->transaction_date))}}</td>
                            <td>{{$journal_entry->amount}}</td>
                            <td>{{$journal_entry->direction}}</td>
                            <td id="action_buttons">
                                {{-- <button type="button" wire:click="edit_account({{ $account->id }})" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit_account_modal" id="edit_button">Edit</button>&nbsp --}}
                                <button type="button" wire:click="delete_journal_entry({{ $journal_entry->id }})" wire:confirm="Are you sure you want to delete Journal Entry?" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach    
                    @else
                        <tr>
                            <td colspan="7" class="text-center">No Journal Entry found!</td>
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

