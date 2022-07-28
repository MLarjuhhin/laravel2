@php
    /** @var \App\Models\BlogPost $item */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    @if($item->is_published)
                        опубликовано
                    @else
                        Черновик
                    @endif

                </div>
                <div class="card-body">
                    <div class="card-title"></div>
                    <div class="card-subtitle mb-2 text-muted"></div>
                    <ul class="nav nav-tabs" id="myTab"  role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active"  id="maindata-tab" data-bs-toggle="tab" data-bs-target="#maindata" type="button" role="tab" aria-controls="maindata" aria-selected="true">Основные данные</a>
                        </li>
                        <li class="nav-item" role="presentation">
{{--                            <a class="nav-link " data-toggle="tab" href="#addeddata" role="tablist">Доп. данные</a>--}}
                            <a class="nav-link "  id="addeddata-tab" data-bs-toggle="tab" data-bs-target="#addeddata" type="button" role="tab" aria-controls="maindata" aria-selected="true">Доп. данные</a>

                        </li>
                    </ul>
                    <br>
                    <div class="tab-content"  id="myTabContent">
{{--                        <div class="tab-pane active" id="maindata" role="tabpanel">main</div>--}}
{{--                        <div class="tab-pane " id="addeddata" role="tabpanel">addeddata</div>--}}

                        <div class="tab-pane fade show active" id="maindata" role="tabpanel" aria-labelledby="maindata-tab">

                          <div class="form-group">
                              <label for="title">Заголовок</label>
                              <input type="text" name="title" value="{{$item->title}}" id="title" class="form-control" >
                          </div>
                            <br>
                            <div class="form-group">
                                <label for="content_row">Статья</label>
                                <textarea name="content_row" id="content_row" class="form-control" rows="10">
                                    {{old('content_row',$item->content_row)}}
                                </textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="addeddata" role="tabpanel" aria-labelledby="addeddata-tab">
{{--                            Второй таб--}}
                            <div class="form-group">
                                <label for="category_id">Категория</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($cateoryList as $category)
                                        <option value="{{$category->id}}"
                                                @if($category->id==$item->category_id) selected @endif>
                                            {{$category->id_title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" class="form-control" id="slug" value="{{$item->slug}}">
                            </div>

                            <div class="form-group">
                                <label for="excerpt">Выдержка</label>
                                <textarea name="excerpt" class="form-control" id="excerpt" rows="3" >
                                    {{old('excerpt',$item->excerpt)}}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <input type="hidden" value="0" name="is_published">
                                <input type="checkbox" name="is_published" class="form-check-input" value="1"
                                @if($item->is_published)
                                    checked="checked"
                                        @endif
                                >
                                <label for="form-check-label" for="is_published">Опубликованно</label>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
