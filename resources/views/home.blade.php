@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <br/>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @else
                        <div>
                            <a href = "{{ route('search_by_location') }}">지도에서 고양이 찾기</a>
                        </div>
                        <br/>
                        <div>
                            <a href = "{{ route('search_by_image') }}">사진으로 고양이 찾기</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
