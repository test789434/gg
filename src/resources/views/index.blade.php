<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <title>User subscriptions</title>
</head>
<body>
<div class="container">
    <div class="form">
        @if($errors->any())
            <ul class="errors">
                @foreach ($errors->all() as $error)
                    <li class="errors__item">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if(session()->has('success'))
            <div class="success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="title">
            Available subscriptions
        </div>
        @if($subscriptions->isNotEmpty())
            <form action="{{ route('subscriptions.update') }}" method="POST">
                @csrf
                <div class="list">
                    @foreach($subscriptions as $subscription)
                        <div class="list__item">
                            <input type="checkbox"
                                   name="subscriptions[]"
                                   id="subscription_{{ $subscription->id }}"
                                   value="{{ $subscription->id }}"
                                   @if($currentSubscriptions->contains($subscription->id))
                                    checked
                                   @endif
                            >
                            <label for="subscription_{{ $subscription->id }}">
                                {{ $subscription->title }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <button class="button">Update subscriptions</button>
            </form>
        @else
            <div class="empty">
                There are no available subscriptions now.
            </div>
        @endif
    </div>
</div>

<style>
    body {
        background: #f1f1f1;
        font-family: 'Nunito', sans-serif;
    }

    .container {
        display: flex;
        justify-content: center;
    }

    .form {
        display: flex;
        flex-direction: column;
        padding: 40px;
        background: #eaeaea;
        border-radius: 10px;
    }

    .title {
        font-size: 24px;
        font-weight: bold;
    }

    .list {
        margin: 30px 0;
    }

    .list__item {
        margin-bottom: 7px;
    }

    .list__item:last-of-type {
        margin-bottom: 0;
    }

    .button {
        border: none;
        border-radius: 5px;
        padding: 5px 15px;
        font-size: 16px;
        background-color: #1b75b1;
        color: #f1f1f1;
        cursor: pointer;
        font-family: inherit;
    }

    .empty {
        padding: 30px;
        font-size: 18px;
    }

    .errors {
        padding: 30px;
        background: #f1f1f1;
        border: 1px solid #c4c4c4;
        border-radius: 5px;
        list-style: none;
    }

    .errors__item {
        color: red;
    }

    .success {
        padding: 30px;
        background: #c4dec4;
        border: 1px solid #32983a;
        border-radius: 5px;
        list-style: none;
        color: #32983a;
        margin-bottom: 20px;
    }
</style>
</body>
</html>
