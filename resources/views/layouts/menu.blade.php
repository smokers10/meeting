<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i> Profile </a>
            </li>
            @if (Auth::user()->jabatan == 'admin')
                <li>
                    <a href="{{ route('user-index') }}"><i class="fa fa-users fa-fw"></i> Users </a>
                </li>
            @endif
            <li>
                <a href="{{ route('project-index')."?page=1" }}"><i class="fa fa-star fa-fw"></i> Project </a>
            </li>
            <li>
                <a href="{{ route('mom-index') }}"><i class="fa fa-th-list fa-fw"></i> MoM </a>
            </li>
            @if (Auth::user()->jabatan == 'admin')
                <li>
                    <a href="{{ route('result-index') }}"><i class="fa fa-cogs fa-fw"></i> Results </a>
                </li>
            @endif
        </ul>
    </div>
</div>
