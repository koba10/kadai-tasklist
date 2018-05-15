@extends('layouts.app')

@section('content')

    <h1>メッセージ一覧</h1>

    @if (count($tasks) > 0)
        <ul>
             @foreach ($messages as $message)
                <li>{!! link_to_route('messages.show', $message->id, ['id' => $message->id]) !!} : {{ $message->content }}</li>
            @endforeach
        </ul>
    @endif
{!! link_to_route('tasks.create', '新規メッセージの投稿') !!}
</@endsection>