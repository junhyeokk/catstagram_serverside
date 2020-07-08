@extends('layouts.app')

@section('content')

    <div class="article">
        제목 : {{ $row[0]->title }}
        <br/>
        작성자 : {{ $row[0]->writer }}
        <br/>
        고양이 : {{ $row[0]->cat->name }}
        <br/>
        작성일 : {{ $row[0]->created_at }}
        <br/><br/><br/><br/>
        {{ $row[0]->content }}
    </div>

@endsection
