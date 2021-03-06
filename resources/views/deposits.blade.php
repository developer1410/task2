@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Сумма вклада</th>
                        <th scope="col">Процент</th>
                        <th scope="col">Количество текущих начислений</th>
                        <th scope="col">Сумма начислений</th>
                        <th scope="col">Статус депозита</th>
                        <th scope="col">Дата</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            @foreach($row as $col)
                                <td>{{$col}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
