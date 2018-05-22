@extends('layouts.app')

@section('content')

            @if (Auth::user()->id == $user->id)
                  {!! Form::open(['route' => 'tasklists.store']) !!}
                      <div class="form-group">
                          {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                          {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                      </div>
                  {!! Form::close() !!}
            @endif
            @if (count($tasklists) > 0)
                @include('tasklists.tasklists', ['tasklists' => $tasklists])
            @endif
            
    <h1>id = {{ $tasklists->id }} のタスク詳細ページ</h1>
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $tasklists->id }}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{ $tasklists->title }}</td>
        </tr>
        <tr>
            <th>タスク</th>
            <td>{{ $tasklists->content }}</td>
        </tr>
    </table>

 {!! link_to_route('tasklists.edit', 'このタスク編集', ['id' => $tasklists->id], ['class' => 'btn btn-default']) !!}

  {!! Form::model($tasklists, ['route' => ['tasklists.destroy', $tasklists->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection