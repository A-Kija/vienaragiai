<div class="card mb-4">
    <div class="card-header">Sort Filter Search</div>
    <div class="card-body">
        <form class="delete" action="{{route('front-index')}}" method="get">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>What sort do you want?</label>
                            <select class="form-control" name="sort">
                                <option value="default" @if($sort=='default' ) selected @endif>Default sort</option>
                                <option value="color-asc" @if($sort=='color-asc' ) selected @endif>Color A-Z</option>
                                <option value="color-desc" @if($sort=='color-desc' ) selected @endif>Color Z-A</option>
                                <option value="animal-asc" @if($sort=='animal-asc' ) selected @endif>Animal A-Z</option>
                                <option value="animal-desc" @if($sort=='animal-desc' ) selected @endif>Animal Z-A</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-outline-warning mt-4">Sort!</button>
                        
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>What color?</label>
                            <select class="form-control" name="color_id">
                                @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-outline-success mt-4" type="submit">Filter!</button>
                    </div>
                    <div class="col-4">
                    </div>
                    <div class="col-1">
                    <a class="btn btn-outline-success mt-4" href="{{route('front-index')}}">Clear!</a>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
