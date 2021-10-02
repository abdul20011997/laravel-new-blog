@extends('frontlayout')
@section('title',$title)
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="row">
            @if(count($data) > 0)
            @for($i=0;$i<count($data);$i++)
            <div class="col-md-3" style="margin:30px;">
            <a href="{{'./singlepost/'.$data[$i]['id']}}">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" style="height:250px;" src="{{"./storage/images/post/thumb/".$data[$i]['thumbnail']}}" alt="Card image cap">
                    <div class="card-body">
                        <h1>{{$data[$i]['title']}}</h1>
                    </div>
                </div>
            </a>
            </div>
            @endfor
            {{$data->links()}}
            @else
            <h1 style="margin:30px;">No Posts</h1>
            @endif
        </div>
    </div>
    @include('sidebar')
</div>
@endsection