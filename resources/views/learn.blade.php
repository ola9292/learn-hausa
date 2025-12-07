@extends('layout.default')


@section('content')
        <div class="container py-4">
                <h1>What do you want to learn?</h1>
                <form action="/learn" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                                <input type="text" name="prompt" class="form-control" placeholder="Teach me greetings in hausa" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Send</button>
                        </div>
                </form>
        </div>
@endsection