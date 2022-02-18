<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow menu-border" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @role('admin')
            <li class=" nav-item {{ request()->is('admin/dashboard') ? ' active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            @else
            @php
            $data = \App\Models\ClasSubject::where('user_id', auth()->user()->id)->with(['clas', 'subject'])->get();
            @endphp
            @foreach ($data as $key => $value)
            <li class=" nav-item"><a href="{{ route('kelas-mapel.show', [$value->id]) }}"><i class="fa fa-square" style="color: {{ $value->color ?? '#339966' }}"></i><span class="menu-kelas" data-i18n="Kelas">{{ $value->clas->name }} - {{ $value->subject->name == 'Teknologi Informasi & Komunikasi' ? 'TIK' : $value->subject->name }}</span></a>
            </li>    
            @endforeach
            @endrole
        </ul>
    </div>
</div>