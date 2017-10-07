<ul class="nav nav-tabs pull-left">
    @foreach ($statuses as $key=>$status)
        <li><a href="/{{ $link }}/{{ $key }}" >{{ $status }}（ {{ array_get($qtys, $key, 0) }}）</a></li>
    @endforeach
</ul>