<x-app-layout>
    <div class="form form--create">
        <div class="form__container">
            <div class="form__goback">
                <a href="{{ url('/dashboard') }}" class="btn-solid--gradient">
                    <button type="button">
                        <i class="fa-solid fa-arrow-left"></i> Back to dashboard?
                    </button>
                </a>
            </div>

            <span class="form__title">Create new project</span>

            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form__item">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="error">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form__item">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="10">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="error">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form__item">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" accept="image/png, image/jpeg" />
                    @if ($errors->has('photo'))
                        <span class="error">{{ $errors->first('photo') }}</span>
                    @endif
                </div>
                <div class="form__item">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" class="form-control"
                        value="{{ old('link') }}">
                    @if ($errors->has('link'))
                        <span class="error">{{ $errors->first('link') }}</span>
                    @endif
                </div>
                <div class="form__item">
                    <label for="tags">Tags:</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('tags'))
                        <span class="error">{{ $errors->first('tags') }}</span>
                    @endif
                </div>

                <div class="form__button">
                    <button type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
