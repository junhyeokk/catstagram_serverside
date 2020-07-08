@extends('layouts.app')

@section('content')

    <div class="articles">
        <table>
            <th>제목</th>
            <th>작성자</th>
            @foreach ($rows as $row)
                <tr>
                    <td>
                        <a href="{{ url('/article') }}/{{ $row->id }}">
                            {{ $row->title }}
                        </a>
                    </td>
                    <td>
                        {{ $row->writer }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{ $rows->links() }}

@endsection
