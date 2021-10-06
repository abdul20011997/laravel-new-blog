<div class="col-md-3">
            <div class="card" style="margin-top:10px;">
                <div class="card-header" style="font-weight:bold;font-size:19px;">
                    Search
                </div>
                <div class="card-body">
                <form action="/blog">
                <input type="text" name="query" class="form-control" style="width:72%;display:inline-block;vertical-align:middle;">
                <button type="submit" style="display:inline-block;" class="btn btn-success">search</button>
                </form>    
            </div>
                
            </div>
            <div class="card" style="margin-top:10px;">
                <div class="card-header" style="font-weight:bold;font-size:19px;">
                    Recent Posts
                </div>
                <ul class="list-group list-group-flush">
                    @if($recent_posts)
                    @for($i=0;$i<count($recent_posts);$i++)
                    <a href="{{url('singlepost',$recent_posts[$i]['id'])}}" class="list-group-item" style="color:blue;font-size:16px;cursor:pointer;">{{$recent_posts[$i]['title']}}</a>
                    @endfor
                    @endif
                </ul>

            </div>
            <div class="card" style="margin-top:10px;">
                <div class="card-header" style="font-weight:bold;font-size:19px;">
                    Popular Posts
                </div>
                <ul class="list-group list-group-flush">
                @if($popular_posts)
                    @for($i=0;$i<count($popular_posts);$i++)
                    <a href="{{url('singlepost',$popular_posts[$i]['id'])}}" class="list-group-item" style="color:blue;font-size:16px;cursor:pointer;">{{$popular_posts[$i]['title']}}<span class="badge badge-secondary ml-2">{{$popular_posts[$i]['views']}}</span></a>
                    @endfor
                    @endif
                </ul>
                
            </div>
    </div>