@extends('.articles.layout')


    <title>@lang('Articles List')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->



<body>
<a href="{{ URL::previous() }}" ></i>
    <button> @lang('common.back')</button>
</a>

<form action="{{route('comment.store')}}" method="POST">
    @csrf
<table>


        <thead>
        <tr>
            <th>@lang('common.id')</th>
            <th>@lang('common.title-article')</th>
            <th>@lang('common.summary-article')</th>
            <th>@lang('common.content-article')</th>
            <th>@lang('common.images-article')</th>

        </tr>
        </thead>

    <tr>

        <td>{{$article->id}}</td>
        <td>{{$article->title}}</td>
        <td>{{$article->summary}}</td>
        <td>{{$article->content}}</td>
        <td><img src="{{ asset('images/'.$article->image_name) }}" height="200px" width="250px" alt="image"></td>

    </tr>
</table>

    <h3>@lang('comment.comment-article')</h3>
    <input type="hidden" name="id" value="{{$article->id}}">
    <textarea name="comment_content" cols="50" rows="10">@lang('comment.write.comment')</textarea>
    <input type="submit" value="Send comment">


    @foreach($article->comments as $comment)
        <div>

        <ul>

            <li>@lang('comment.comment') {{$comment->comment_content}}</li>
            <li>@lang('comment.comment.add') {{$comment->created_at}}</li>
            <li><a href={{ route('comment.delete', $comment['id']) }}>@lang('common.delete')</a></li>

        </ul>
        </div>
    @endforeach


</form>
</body>


