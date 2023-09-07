<div class="container text-center">
    {{-- Dynamic Section --}}
    @if ($project->exists)
        {{-- Edit section --}}
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
            @method('PUT')
        @else
            {{-- Create section --}}
            <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
    @endif

    {{-- Token --}}
    @csrf

    <div class="row justify-content-center">
        <h1 class="my-3">
            @if ($project->exists)
                {{-- Edit section --}}
                Modifica
            @else
                {{-- Create section --}}
                Crea nuovo progetto
            @endif
        </h1>

        {{-- Name --}}
        <div class="mb-3 col-12 text-start">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name"
                class="form-control bg-dark  @error('name') is-invalid @elseif (old('name')) is-valid @enderror"
                value="{{ old('name', $project->name) }}" autofocus required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-3 col-12 text-start">
            <label class="form-label" for="description">Descrizione</label>
            <textarea type="text" id="description" name="description" class="form-control bg-dark">{{ old('description', $project->description) }}</textarea>
        </div>

        {{-- Relation Type --}}
        <div class="mb-3 col-12 text-start">
            <label class="form-label bg-dark" for="type">Tipologia</label>
            <select name="type_id" id="type">
                @foreach ($types as $type)
                    <option value="">{{ $type->label }}</option>
                @endforeach
            </select>
        </div>

        {{-- Thumb --}}
        <div class="col-10 text-start">
            <div class="mb-3">
                <label class="form-label" for="thumb">Immagine</label>
                <input type="file" id="thumb" name="thumb"
                    class="form-control bg-dark @error('thumb') is-invalid @elseif (old('thumb')) is-valid @enderror"
                    value="{{ old('thumb', $project->thumb) }}" required>
                @error('thumb')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

        </div>
        <div class="col-2">
            <div>
                <img src="{{ $project->thumb ? asset('storage/' . $project->thumb) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
                    alt="" id="thumbnail-preview" class="img-fluid">

            </div>
        </div>

        {{-- Link github --}}
        <div class="mb-3 col-12 text-start">
            <label class="form-label" for="url">Github</label>
            <input type="url" id="url" name="url"
                class="form-control bg-dark @error('url') is-invalid @elseif (old('url')) is-valid @enderror"
                value="{{ old('url', $project->url) }}" required>
            @error('url')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

    </div>
    <button class="btn btn-outline-success">
        @if ($project->exists)
            {{-- Edit section --}}
            Salva
        @else
            {{-- Create section --}}
            Crea
        @endif
    </button>
    </form>
</div>
