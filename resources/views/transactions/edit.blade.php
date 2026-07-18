<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container p-5">
        <h4>Transaction Edit</h4>
        <a href="{{ route('transactions.index') }}" class="btn btn-dark btn-sm">Back</a>
        {{-- <livewire:transactions.update/> --}}
    </div>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/jquery/jquery.js') }}"></script>    
</body>
</html>