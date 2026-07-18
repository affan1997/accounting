<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <style>
        #add_account_form{
            display: none;
        }
        .btn-sm{
            padding: 3px;
            font-size: 13px;
            /* border-radius: 6px; */
        }
        
        #action_buttons{
            display:flex;
            flex-wrap:nowrap;
        }
 
        
    </style>
</head>
<body>
    <div class="container p-5">
        <h4>Accounts</h4>
        <button class="btn btn-sm btn-dark" id="add_button">Add Account</button>
        <div class="mt-2">
            <form action="{{ route('accounts.store') }}" method="POST" id="add_account_form" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col col-sm">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Type title of account...">
                    </div>
                    <div class="col col-sm">
                        <label class="form-label">Head</label>
                        <select name="head" id="head" class="form-select form-select-sm">
                            <option value="" disabled selected>Select an account head...</option>
                            <option value="Asset">Asset</option>
                            <option value="Liability">Liability</option>
                            <option value="Equity">Equity</option>
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>
                    <div class="col col-sm">
                        <label class="form-label">Normal Balance</label>
                        <select class="form-select form-select-sm" name="normal_balance" id="normal_balance">
                            <option value="" disabled selected>Select normal balance...</option>
                            <option value="Debit">Debit</option>
                            <option value="Credit">Credit</option>
                        </select>
                    </div>
                    <div class="col col-sm mt-4">
                        <button type="submit" class="btn btn-dark btn-sm mt-2" id="submit_button">submit</button>
                    </div>
                </div>
            </form>
        </div>
        <form action="{{ route('accounts.search') }}" method="GET" autocomplete="off" id="search_form">
            <div class="input-group input-group-sm mb-3 mt-3">
                <input type="text" name="search" class="form-control form-control-sm bg-success-subtle" placeholder="Search accounts here..."  >
                <button type="submit" class="btn btn-sm btn-secondary">Search</button>
                <a href="{{route('accounts.index')}}" class="btn btn-sm btn-dark" onclick="localStorage.clear()">Remove filter</a>    
            </div>
        </form>
        <div class="mt-2">
            <table class="table table-sm">
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
                    @if ($accounts->count() > 0)
                        @foreach($accounts as $account)
                        <tr>
                            <td>{{$account->id}}</td>
                            <td>{{$account->name}}</td>
                            <td>{{$account->head}}</td>
                            <td>{{$account->normal_balance}}</td>
                            <td id="action_buttons">
                                <a href="{{ route('accounts.edit',$account->id) }}" class="btn btn-sm btn-primary" id="edit_button">Edit</a>&nbsp
                                <form action="{{ route('accounts.destroy',$account->id) }}" method="POST" id="delete_form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm bg-danger" id="delete_button">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach    
                    @else
                        <p>Account not found</p>
                    @endif
                    
                </tbody>
            </table>
            <div class="mt-3">
                {{ $accounts->links() }}
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
    <script>
       $(document).ready(function(){
            $('#add_button').click(function(){
            $('#add_account_form').show();
            });
       }) ;
       document.getElementById("search_form").onsubmit = function(){
        const search = document.querySelector('input[name="search"]').value;
        localStorage.setItem('search',search);
       };
       window.onload = function(){
        const savedSearch = localStorage.getItem('search');
        if(savedSearch){
            document.querySelector('input[name="search"]').value = savedSearch;
        }
       };
    </script>
</body>
</html>