<nav class="navbar navbar-expand-sm navbar-light">
    <h2>
        <a class="navbar-brand text-white" href="{{ action('IndexController@index') }}">QandA</a>
    </h2>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="menu" class="collapse navbar-collapse">
        <ul class="navbar-nav">
            @foreach ($menu as $href => $title)
            <li class="nav-item">
                <a href="{{ $href }}" class="nav-link">{{ $title }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</nav>
