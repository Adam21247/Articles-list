
@extends('articles.layout')

<div>

<a href="{{"/articles"}}">
    <button> @lang('common.back')</button>
</a>

<div class="addMember-box">
    <form action="{{route(('articles.create'))}}" method="POST" enctype="multipart/form-data">
        <h1>@lang('add.add-articles')</h1>

        <p></p>
        @csrf



        <input type="text" name="title" placeholder=@lang('add.enter-title')>


        <textarea name="summary" placeholder=@lang('add.enter-summary')></textarea>


        <textarea name="content" placeholder=@lang('add.enter-content')></textarea>



        <button type="submit">@lang('add.add-new-article')</button>



</div>
    <div class="addPicture">
        <input type="file" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
               name="image">
    </div>
    </form>
</div>




