@extends('layouts.app')

@section('content')

    <div class="jumbotron">
        <div class="container p-5">
            <h1 class="display-1">Dashboard</h1>

            <table class="table table-bordered">
        <thead>
            <tr>
                <th width="50px">No</th>
                <th>Twitter Id</th>
                <th>Message</th>
                <th>Images</th>
                <th>Favorite</th>
                <th>Retweet</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($data))
                @foreach($data as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['id'] }}</td>
                        <td>{{ $value['text'] }}</td>
                        <td>
                            @if(!empty($value['extended_entities']['media']))
                                @foreach($value['extended_entities']['media'] as $v)
                                    <img src="{{ $v['media_url_https'] }}" style="width:100px;">
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $value['favorite_count'] }}</td>
                        <td>{{ $value['retweet_count'] }}</td>
                        <!-- <td>{{ $value['user']['profile_image_url'] }}</td> -->
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">There are no data.</td>
                </tr>
            @endif
        </tbody>
    </table>
        </div>
    </div>

@endsection
