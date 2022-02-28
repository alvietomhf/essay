<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow menu-border" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header"><img src="{{ asset('assets/images/logo/logo-ma.png') }}" style="width: 14%;height: 14%;object-fit: scale-down;" alt="branding logo"><span style="font-weight: 900; font-size:17px" data-i18n="Admin Panels"> MA KANJENG SEPUH</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Admin Panels"></i>
            </li>
            @role('admin')
            <li class=" nav-item {{ request()->is('admin/dashboard') ? ' active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            @else
            @php
            $data = \App\Models\Season::with(['clasSubjects' => function ($q) {
                                    $q->with([
                                        'clas',
                                        'subject',
                                        'exams',
                                    ])
                                    ->withCount(['exams']);
                                }])
                                ->withCount(['clasSubjects'])
                                ->get();
            @endphp
            @foreach ($data as $key => $value)
            @if ($value->clas_subjects_count)
            <li class=" nav-item"><a href="javascript:void(0);"><span class="menu-title text-bold-700" data-i18n="Templates">TP. {{ $value->name }}</span></a>
                <ul class="menu-content">
                    @foreach ($value->clasSubjects as $key => $value)
                    <li><a class="menu-item" href="javascript:void(0);"><i class="fa fa-square" style="color: {{ $value->color }}"></i><span class="text-bold-700" data-i18n="Vertical"> {{ $value->clas->name }} - {{ $value->subject->name == 'Teknologi Informasi & Komunikasi' ? 'TIK' : $value->subject->name }}</span></a>
                        <ul class="menu-content">
                            @foreach ($value->exams as $key1 => $value2)
                            @if ($value->exams_count)
                            <li><a class="menu-item" href="{{ route('ujian.show', [$value->id, $value2->slug]) }}"><i class="fa fa-tasks" aria-hidden="true" style="color: #339966"></i><span class="text-bold-700" data-i18n="Classic Menu"> {{ $value2->title }}</span></a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endif  
            @endforeach
            @endrole
        </ul>
    </div>
</div>