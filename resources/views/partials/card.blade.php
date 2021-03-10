<div class="row">
    @foreach ($albums as $item)
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('img/'.$item->photos->url)}}" class="card-img-top" alt="">
                <div class="card-body">
                <h5 class="card-title">{{$item->name}}</h5>
                <p class="card-text">{{$item->author}}</p>
                <form action="/albums/{{$item->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
                <a class="btn btn-success" href="/albums/{{$item->id}}/edit">Edit</a>
                </div>
            </div>
        </div>
        @if ($loop->iteration % 3 == 0)
            </div>
            <div class="row">           
        @endif
    @endforeach
</div>