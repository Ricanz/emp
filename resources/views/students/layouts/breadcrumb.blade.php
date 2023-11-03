<div class="container">
    <ul class="col-lg-12 no-gutter breadcrumb">
        <li> <a href="/home">Halaman Utama </a></li>
        @if(!empty($breadcrumbs))
            @foreach($breadcrumbs as $key => $item)
                <li> <a href="{{$item}}"> {{$key}}</a> </li>
            @endforeach
        @endif
    </ul>
</div>