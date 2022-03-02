@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="card mb-2">
                <h5 class="card-body">
                    <h5class="cart-title">
                    {{$article->title}}
                </h5>
                <div class="card-subtitle">
                    {{$article->created_at->diffForHumans()}}
                    Category: <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">
                    {{$article->body}}
                </p>
                <a class="btn btn-warning"
                   href="{{url("/articles/delete/$article->id")}}"
                >
                   Delete
                </a>
                <ul class="list-group mt-3">
                    <li class="list-group-item active">
                        <b>Comments ({{count($article->comments)}})</b>
                    </li>
                    @foreach($article->comments as $comment)
                        <li class="list-group-item">
                            <a href="{{url("/comments/delete/$comment->id")}}" class="btn-close float-end">

                            </a>
                            {{$comment->content}}
                            <div class="small mt-2">
                                By {{$comment->user->name}}
                                <span class="text-secondary">{{$comment->created_at->diffForHumans()}}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @auth
                <form method="post" action="{{url("/comments/add")}}">
                    @csrf
                    <input type="hidden" value="{{$article->id}}" name="article_id" />
                    <input type="hidden" value="{{$article->id}}" name="article_id" />
                    <textarea name="content" class="form-control mb-2" placeholder="new comment"></textarea>
                    <input type="submit" value="Add Comment" class="btn btn-primary">

                </form>
                @endauth
            </div>

    </div>

@endsection
