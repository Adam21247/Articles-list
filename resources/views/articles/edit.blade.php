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
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">

                    <form>
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    </form>

                    <div id="imagePreview">
                        <td><img src="{{ asset('images/'.$article->image_name) }}" height="100px" width="150px"
                                 alt="image"></td>
                    </div>


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


                    <button type="submit">@lang('edit.update')</button>


                </div>
            </div>
        </form>
    </form>
</div>





