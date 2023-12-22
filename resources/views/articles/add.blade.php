@extends('articles.layout')

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link
        href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css"
        rel="stylesheet"/>
</head>

<div>

    <a href="{{ URL::previous() }}"></i>
        <button> @lang('common.back')</button>
    </a>

    <div class="addMember-box">
        <form action="{{route(('articles.create'))}}" method="POST" enctype="multipart/form-data">
            <h1>@lang('add.add-articles')</h1>

            @csrf

            <input type="text" name="title" placeholder=@lang('add.enter-title')>


            <select data-placeholder=@lang('add.select-categories') multiple class="chosen-select" name="categories[]"
                    style="width: 100%;">

                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <textarea name="summary" placeholder=@lang('add.enter-summary')></textarea>


            <textarea name="content" placeholder=@lang('add.enter-content')></textarea>


            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">

                        <form>
                            <input type="file" id="addedImage" name="addedImage" accept="image/*" onchange="previewImage(event)">
                        </form>
                        <div id="imagePreview"></div>


                        <button type="submit">@lang('add.add-new-article')</button>
                    </div>

                </div>
            </form>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",
        });
    });
</script>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var imagePreview = document.getElementById('imagePreview');
            var image = new Image();
            image.src = reader.result;
            image.onload = function () {
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                var width = image.width;
                var height = image.height;
                var max_size = 500;
                if (width > height) {
                    if (width > max_size) {
                        height *= max_size / width;
                        width = max_size;
                    }
                } else {
                    if (height > max_size) {
                        width *= max_size / height;
                        height = max_size;
                    }
                }
                canvas.width = width;
                canvas.height = height;
                ctx.drawImage(image, 0, 0, width, height);
                var dataUrl = canvas.toDataURL('image/jpeg');
                imagePreview.innerHTML = '<img src="' + dataUrl + '" width="' + width + '" height="' + height + '">';
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
