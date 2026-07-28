{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container p-5">
        <h4>Accout Edit</h4>
        <a href="{{ route('accounts.index') }}" class="btn btn-dark btn-sm">Back</a>
        <div class="mt-2">
            <form action="{{route('accounts.update',$account->id)}}" method="POST">
                @csrf()
                @method('PUT')
                <div class="row">
                    <div class="col col-sm">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-control-sm" id="name" placeholder="Type title of account..." value="{{ $account->name }}">
                    </div>
                    <div class="col col-sm">
                        <label for="" class="form-label">Type:</label>
                        <select name="head" id="" class="form-select form-select-sm">
                            <option value="">Select an account head...</option>
                            <option value="Asset" {{ $account->head == 'Asset' ? 'selected':'' }}>Asset</option>
                            <option value="Liability" {{ $account->head == 'Liability' ? 'selected':'' }}>Liability</option>
                            <option value="Equity" {{ $account->head == 'Equity' ? 'selected':'' }}>Equity</option>
                            <option value="Income" {{ $account->head == 'Income' ? 'selected':'' }}>Income</option>
                            <option value="Expense" {{ $account->head == 'Expense' ? 'selected':'' }}>Expense</option>
                        </select>
                    </div>
                    <div class="col col-sm">
                        <label for="" class="form-label">Normal Balance</label>
                        <select name="normal_balance" class="form-select form-select-sm" id="">
                            <option value="">Select normal balance...</option>
                            <option value="Debit" {{ $account->normal_balance == 'Debit' ? 'selected':'' }}>Debit</option>
                            <option value="Credit" {{ $account->normal_balance == 'Credit' ? 'selected':''}}>Credit</option>
                        </select>
                    </div>
                    <div class="col col-sm mt-4">
                        <button type="submit" class="btn btn-sm btn-dark mt-2">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html> --}}