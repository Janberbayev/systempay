@extends('layout.app')

@section('content')

    <section class="section-creative" style="padding: 40px 0; min-height: calc(100vh - 200px);">
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <x-dashboard-sidebar />

                <!-- Main Content Area -->
                <div class="col-lg-9 col-md-8">
                    <div class="card-creative p-4">
                        <h1 class="fw-black mb-4" style="color: var(--text-primary); font-size: 2rem;">
                            Мои сделки
                        </h1>

                        @if($deals->count() > 0)
                            <div class="dashboard-items">
                                @foreach($deals as $deal)
{{--                                    @php--}}
{{--                                        $isClient = auth()->id() === $deal->client_id;--}}
{{--                                        $isContractor = auth()->id() === $deal->contractor_id;--}}
{{--                                        if ($isClient) {--}}
{{--                                            $statusText = 'Запросили договор от потенциального Исполнителя';--}}
{{--                                        } elseif ($isContractor) {--}}
{{--                                            $statusText = 'Заказчик запросил договор';--}}
{{--                                        } else {--}}
{{--                                            $statusText = 'Неизвестный статус';--}}
{{--                                        }--}}
{{--                                    @endphp--}}
                                    <div class="dashboard-item mb-3 p-3" style="border: 1px solid var(--border-color); border-radius: 12px;">
                                        <div class="d-flex justify-content-between align-items-start gap-2">
                                            <div class="min-w-0">
                                                <a href="{{ route('show-deal', $deal) }}" class="text-decoration-none" style="color: inherit;">
                                                    <h5 class="fw-bold mb-2" style="color: var(--text-primary);">{{ $deal->project->title ?? 'Сделка #' . $deal->id }}</h5>
                                                </a>
                                                <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                                    Статус: <span class="badge bg-info">{{ $deal->status_text }}</span>
                                                </p>
                                            </div>
                                            <small class="text-muted flex-shrink-0">{{ $deal->created_at->format('d.m.Y') }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="dashboard-message">
                                <p class="text-muted mb-3" style="font-size: 1rem;">
                                    У вас пока нет активных сделок.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .dashboard-message {
            padding: 20px 0;
        }
    </style>

@endsection
