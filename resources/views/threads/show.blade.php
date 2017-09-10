@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                <a href="#"> {{$thread->creator->name}} </a> posted:
                {{ $thread->title }}
                </div>

                <div class="panel-body">
                    {{$thread->body}}
                </div>
            </div>
            
            @foreach($replies as $reply)
                @include('threads.reply')
            @endforeach

            {{$replies->links()}}

            @if(auth()->check())

            <form action="{{ $thread->path(). '/replies'}}" method="POST">
            {{csrf_field()}}
                <textarea name="body" id=body"" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
            <button type="submit" class="btn btn-default">Post</button>
            </form>

    @else
    <p class="text-center">Please <a href="{{route('login')}}">sign in</a></p>
    @endif

        
    </div>
    <div class="col-md-4">
            <div class="panel panel-default">
                

                <div class="panel-body">
                    <p>This thread was published {{$thread->created_at->diffForHumans()}}
                    by <a href="#">{{$thread->creator->name}}</a> 
                    and currently has {{ $thread->replies()->count()}} {{ str_plural('comment',$thread->replies()->count())}}.
                    </p> 
                </div>
            </div>
            </div>
    </div>
</div>
@endsection
