@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form>
                    x 좌표 : <input type = "number" id = "x_cord" step = "0.01"><br/>
                    y 좌표 : <input type = "number" id = "y_cord" step = "0.01"><br/><br/>
                    <input type = "button" id = "go" value = "찾기">
                </form>
                <br/><br/><br/>
            </div>

            <div id = "result">

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script>
        $("#go").click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/search/location/calc') }}",
                type: 'POST',
                data: {
                    x_cord : $('#x_cord').val(),
                    y_cord : $('#y_cord').val()
                },
                dataType:'json',
                success:function(data) {
                    $('#result').html('');
                    if (data.result.length > 0) {
                        for (var i = 0; i < data.result.length; i++) {
                            $('#result').append(data.result[i] + "<br/>");
                        }
                    } else {
                        $('#result').html("선택한 위치에 해당하는 고양이가 없습니다.");
                    }
                }

            })
        })
    </script>
@endsection
