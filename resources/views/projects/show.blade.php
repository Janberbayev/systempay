@extends('layout.app')

@section('content')

    <section id="roles" class="section-creative" style="background: white; padding-top: 30px;">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{session('success')}}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-8 mx-auto">
                    <div class="mb-3">
                        <a href="{{ route('list-ads') }}" class="text-decoration-none" style="color: var(--text-muted); font-weight: 500;">
                            <i class="bi bi-arrow-left me-1"></i> Назад
                        </a>
                    </div>
                    <div class="role-card-creative h-100 p-4 p-md-5 mt-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h1 class="fw-black mb-2" style="font-size: 1.8rem; color: var(--text-primary);">
                                    {{ $project->title }}
                                </h1>
                                <div class="d-flex flex-wrap align-items-center gap-2 text-muted small">
                                    <span>
                                        <i class="bi bi-geo-alt me-1"></i>
                                        {{ $project->region->name ?? 'Регион не указан' }}
                                        @if($project->city)
                                            · {{ $project->city->name }}
                                        @endif
                                    </span>
                                    <span>•</span>
                                    <span>
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ $project->created_at->format('d.m.Y') }}
                                    </span>
                                    @if($project->user)
                                        <span>•</span>
                                        <span>
                                            <i class="bi bi-person me-1"></i>
                                            Автор: {{ $project->user->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if(method_exists($project, 'statusLabel'))
                                @php($status = $project->statusLabel())
                                <span class="badge bg-{{ $status['color'] ?? 'secondary' }} px-3 py-2">
                                    {!! $status['icon'] ?? '' !!} {{ $status['label'] ?? '' }}
                                </span>
                            @endif
                        </div>

                        <hr class="my-4">

                        <div class="mb-4">
                            <h5 class="fw-bold mb-2" style="color: var(--text-primary);">Описание</h5>
                            <p style="color: var(--text-secondary); line-height: 1.8; white-space: pre-line;">
                                {{ $project->description }}
                            </p>
                        </div>

                        <div class="row g-3 mb-4">
                            @if(!empty($project->budget))
                                <div class="col-md-4">
                                    <div class="p-3 rounded-3" style="background: rgba(59,130,246,0.06);">
                                        <div class="text-muted small mb-1">Бюджет</div>
                                        <div class="fw-bold" style="color: var(--text-primary);">
                                            {{ number_format($project->budget, 0, '.', ' ') }} ₸
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(!empty($project->deadline))
                                <div class="col-md-4">
                                    <div class="p-3 rounded-3" style="background: rgba(16,185,129,0.06);">
                                        <div class="text-muted small mb-1">Дедлайн</div>
                                        <div class="fw-bold" style="color: var(--text-primary);">
                                            {{ \Carbon\Carbon::parse($project->deadline)->format('d.m.Y') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end align-items-center flex-wrap gap-3 mt-4">
                            @if(auth()->check() && $project->user_id === auth()->id())
                                <a href="{{ route('edit-project', $project) }}" class="btn btn-creative">
                                    <i class="bi bi-pencil-square me-2"></i>Редактировать
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

