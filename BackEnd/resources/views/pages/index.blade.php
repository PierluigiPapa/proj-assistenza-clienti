@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="d-flex justify-content-center">
            <table class="table mt-5">
                <thead>
                    <tr class="text-center fs-4">
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Username</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Updated_at</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr class="text-center">
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->nome }}</td>
                        <td>{{ $user->cognome }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
                        <td>{{ $user->updated_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</main>

@endsection
