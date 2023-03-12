@extends('.articles.layout')

<title>@lang('articles.title')</title>


<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">


<body>
<form action="{{ route('logout') }}" method="post">
    @csrf

    <button type="submit" style="float: right">Logout</button>
</form>
<h2 style="text-align: center">@lang('articles.admin.panel.articles')</h2>

<a href="{{'/articles/add'}}">
    <button>@lang('common.add')</button>
</a>

<div>


    <select name="perPage" onchange="location = this.value">
        <option value=""></option>
        <option value="{{'/articles'}}?perPage=3&sort={{request('sort')}}">3</option>
        <option value="{{'/articles'}}?perPage=5&sort={{request('sort')}}">5</option>
        <option value="{{'/articles'}}?perPage=10&sort={{request('sort')}}">10</option>
        <option value="{{'/articles'}}?perPage=25&sort={{request('sort')}}">25</option>
        <option value="{{'/articles'}}?perPage=50&sort={{request('sort')}}">50</option>
        <option value="{{'/articles'}}?perPage=100&sort={{request('sort')}}">100</option>
    </select>
</div>


<table>
    <thead>
    <tr>
        <th>


            @if(request('sort') === 'desc')
                <a class="header" href="{{'/articles'}}?sort=asc&perPage={{request('perPage')}}&sortBy=id">@lang('common.id')<i
                        class="fa-solid fa-circle-chevron-down fa-color"></i></a>
            @else
                <a class="header" href="{{'/articles'}}?sort=desc&perPage={{request('perPage')}}&sortBy=id">@lang('common.id')<i
                        class="fa-solid fa-circle-chevron-up fa-color"></i></a>
            @endif

        </th>
        <th>
            @if(request('sort') === 'desc')
                <a class="header"
                   href="{{'/articles'}}?sort=asc&perPage={{request('perPage')}}&sortBy=title"> @lang('common.title-article')<i
                        class="fa-solid fa-circle-chevron-down fa-color"></i></a>
            @else
                <a class="header"
                   href="{{'/articles'}}?sort=desc&perPage={{request('perPage')}}&sortBy=title"> @lang('common.title-article')<i
                        class="fa-solid fa-circle-chevron-up fa-color"></i></a>
            @endif
        </th>
        <th>
            @if(request('sort') === 'desc')
                <a class="header"
                   href="{{'/articles'}}?sort=asc&perPage={{request('perPage')}}&sortBy=summary">@lang('common.summary-article')
                    <i class="fa-solid fa-circle-chevron-down fa-color"></i></a>
            @else
                <a class="header"
                   href="{{'/articles'}}?sort=desc&perPage={{request('perPage')}}&sortBy=summary"> @lang('common.summary-article')<i
                        class="fa-solid fa-circle-chevron-up fa-color"></i></a>
            @endif
        </th>
        <th>
            @if(request('sort') === 'desc')
                <a class="header"
                   href="{{'/articles'}}?sort=asc&perPage={{request('perPage')}}&sortBy=content">@lang('common.content-article')
                    <i class="fa-solid fa-circle-chevron-down fa-color"></i></a>
            @else
                <a class="header"
                   href="{{'/articles'}}?sort=desc&perPage={{request('perPage')}}&sortBy=content"> @lang('common.content-article')<i
                        class="fa-solid fa-circle-chevron-up fa-color"></i></a>
            @endif</th>
        <th>
            @if(request('sort') === 'desc')
                <a class="header"
                   href="{{'/articles'}}?sort=asc&perPage={{request('perPage')}}&sortBy=created_at">@lang('articles.created_at-article')
                    <i class="fa-solid fa-circle-chevron-down fa-color"></i></a>
            @else
                <a class="header"
                   href="{{'/articles'}}?sort=desc&perPage={{request('perPage')}}&sortBy=created_at"> @lang('articles.created_at-article')
                    <i
                        class="fa-solid fa-circle-chevron-up fa-color"></i></a>
            @endif</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>


    @foreach($articles as $article)

        <a href="{{'/articles/'}}">
            <tr>

                <td>{{$article->id}}</td>
                <td>{{$article->title}}</td>
                <td>{{$article->summary}}</td>
                <td>{{$article->content}}</td>
                <td>{{$article->created_at}}</td>

                <td><a href={{"articles/edit/".$article['id']}}>@lang('common.edit')</a></td>

                @csrf
                @method("GET")
                <td><a href={{"articles/delete/".$article['id']}}>@lang('common.delete')</a></td>
                <td><a href={{"articles/".$article['id']}}>@lang('common.show-article')</a></td>

                @endforeach
            </tr>

</table>

{{ $articles->appends(request()->query())->links() }}
</body>


