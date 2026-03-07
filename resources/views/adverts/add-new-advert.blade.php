@extends('layout.app')

@section('content')

    <section id="roles" class="section-creative" style="background: white;">
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

            <div class="text-center mb-5">
                <h2 class="display-3 fw-black mb-3">Создание объявления</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6 mx-auto">
                    <div class="role-card-creative h-100">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-creative primary me-3" style="width: 64px; height: 64px; font-size: 1.8rem;">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div>
                                <h4 class="fw-black mb-0">Исполнитель</h4>
                                <small class="fw-bold">Для бизнеса и стартапов</small>
                            </div>
                        </div>
                        <p class="mb-4">
                            Размещайте задачи, выбирайте исполнителей по рейтингу и портфолио,
                            контролируйте ход работ через этапы.
                        </p>

                        @if(auth()->user()->can('add ads'))
                            <form method="POST" action="{{route('store-ads')}}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Область</label>
                                    <select 
                                        name="region_id" 
                                        id="region_id" 
                                        class="form-control form-control-lg"
                                        style="border-radius: 12px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary);"
                                    >
                                        <option value="">Выберите область</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                                {{ $region->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Город</label>
                                    <select 
                                        name="city_id" 
                                        id="city_id" 
                                        class="form-control form-control-lg"
                                        style="border-radius: 12px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary);"
                                        disabled
                                    >
                                        <option value="">Сначала выберите область</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Название объявления</label>
                                    <input 
                                        type="text" 
                                        class="form-control form-control-lg" 
                                        name="title" 
                                        value="{{ old('title') }}"
                                        placeholder="Введите название объявления"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Описание</label>
                                    <textarea 
                                        rows="5" 
                                        class="form-control form-control-lg" 
                                        name="content"
                                        placeholder="Опишите ваше объявление..."
                                        required
                                    >{{ old('content') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-creative w-100">
                                    <i class="bi bi-plus-circle me-2"></i>Создать объявление
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const regionSelect = document.getElementById('region_id');
    const citySelect = document.getElementById('city_id');

    if (!regionSelect || !citySelect) return;

    regionSelect.addEventListener('change', function() {
        const regionId = this.value;
        citySelect.innerHTML = '<option value="">Загрузка...</option>';
        citySelect.disabled = true;

        if (!regionId) {
            citySelect.innerHTML = '<option value="">Сначала выберите область</option>';
            citySelect.disabled = true;
            return;
        }

        fetch(`/api/cities/${regionId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка загрузки городов');
                }
                return response.json();
            })
            .then(cities => {
                citySelect.innerHTML = '<option value="">Выберите город</option>';
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
                citySelect.disabled = false;
                
                // Восстанавливаем выбранный город при ошибках валидации
                const oldCityId = @json(old('city_id'));
                if (oldCityId) {
                    citySelect.value = oldCityId;
                }
            })
            .catch(error => {
                console.error('Ошибка загрузки городов:', error);
                citySelect.innerHTML = '<option value="">Ошибка загрузки городов</option>';
                citySelect.disabled = true;
            });
    });

    // Если есть выбранная область при загрузке (например, после ошибки валидации)
    const oldRegionId = @json(old('region_id'));
    if (oldRegionId) {
        regionSelect.value = oldRegionId;
        regionSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush

@endsection

