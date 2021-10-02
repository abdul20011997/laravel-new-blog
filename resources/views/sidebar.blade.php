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
                    <a class="list-group-item" style="color:blue;font-size:16px;">{{$recent_posts[$i]['title']}}</a>
                    @endfor
                    @endif
                </ul>

            </div>
            <div class="card" style="margin-top:10px;">
                <div class="card-header" style="font-weight:bold;font-size:19px;">
                    Popular Posts
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" style="color:blue;font-size:16px;">Cras justo odio</li>
                    <li class="list-group-item" style="color:blue;font-size:16px;">Dapibus ac facilisis in</li>
                    <li class="list-group-item" style="color:blue;font-size:16px;">Vestibulum at eros</li>
                </ul>
                
            </div>
    </div>