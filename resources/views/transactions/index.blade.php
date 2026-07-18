<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <style>
        #transaction_add_form{
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
        .alert{
            /* height: 10; */
        }
        
    </style>
</head>
<body>
    <div class="container p-5" id="main_container">
        <h4>Transactions</h4>
        @if (session()->has('save_transaction_message'))
            <div id="save_transaction_alert" class="alert alert-success" role="alert">{{ session('save_transaction_message') }}</div>
        @endif
        @if (session()->has('update_transaction_message'))
            <div id="update_transaction_alert" class="alert alert-primary" role="alert">{{ session('update_transaction_message') }}</div>
        @endif
        @if (session()->has('delete_transaction_message'))
            <div id="delete_transaction_alert" class="alert alert-danger" role="alert">{{ session('delete_transaction_message') }}</div>
        @endif
        <button class="btn btn-sm btn-dark" id="add_transaction_button" data-bs-toggle="modal" data-bs-target="#add_transaction_modal">Add Transaction</button>
        <livewire:transactions.create/>
        <livewire:transactions.index/>
        
        
    </div>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
    <script>
        $('body').ready(function(){
            $("#save_transaction_alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#save_transaction_alert").slideUp(500);
            });
            $("#update_transaction_alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#update_transaction_alert").slideUp(500);
            });
            $("#delete_transaction_alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#delete_transaction_alert").slideUp(500);
            });
        });
    </script>
</body>
</html>