@extends('.articles.layout')


<a href="{{ URL::previous() }}"></i>
    <button> @lang('common.back')</button>
</a>

<div class="editMember-box">
    <h1>@lang('edit.update-data')</h1>

    <form action="{{route('articles.update')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{$article['id']}}">
        <input type="text" name="title" value="{{$article['title']}}"><br>
        <textarea type="text" name="summary">{{$article['summary']}} </textarea>
        <textarea type="text" name="content">{{$article['content']}} </textarea>
        <form method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">

                    <form>
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    </form>

                    <div id="imagePreview"></div>
        <div><td><img src="{{ asset('images/'.$article->image_name) }}" height="100px" width="150px" alt="image"></td></div>

        <button type="submit">@lang('edit.update')</button>


                </div>
            </div>
        </form>
    </form>
</div>





