@php
    /** @var \App\Models\BlogCategoty $item */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="'maindata" role="tab">Основные данные</a>
                    </li>
                </ul>
                <br>
                <table>
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" value="{{old('title',$item->title)}}" id="title" class="form-control" minlength="5" required>
                        </div>
                        <div class="form-group">
                            <label for="slug">Индетификатор</label>
                            <input type="text" name="slug" value="{{old('slug',$item->slug)}}" id="slug" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Родитель</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                @foreach($cateoryList as $categoryOption)
                                    <option value="{{$categoryOption->id}}"
                                            @if($categoryOption->id==$item->parent_id) selected @endif>
{{--                                        {{$categoryOption->id}}. {{$categoryOption->title}}--}}
                                        {{$categoryOption->id_title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <tr class="form-group">
                        <label for="description">Описание</label>

                        <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{old('description',$item->description )}}</textarea>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
