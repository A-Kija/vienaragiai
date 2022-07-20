@if($allCount && $allCount > $perPage)

<nav class="m-3">
  <ul class="pagination">
    <li class="page-item @if($pageNow == 1) disabled @endif"><a class="page-link" @if($pageNow != 1) href="{{route('front-index', ['page' => $pageNow - 1] + $prevQuery)}}" @endif>Previous</a></li>
    @foreach(range(1, ceil($allCount / $perPage)) as $page)
      <li class="page-item @if($pageNow == $page) active @endif"><a class="page-link" @if($pageNow != $page)href="{{route('front-index', ['page' => $page] + $prevQuery)}}"@endif>{{$page}}</a></li>
    @endforeach
    <li class="page-item @if($pageNow == ceil($allCount / $perPage)) disabled @endif"><a class="page-link" @if($pageNow != ceil($allCount / $perPage)) href="{{route('front-index', ['page' => $pageNow + 1] + $prevQuery)}}" @endif>Next</a></li>
  </ul>
</nav>

@endif