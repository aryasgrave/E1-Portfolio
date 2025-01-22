<x-app-layout>
    <div class="form form--edit">
        <div class="form__container">
            <span class="form__title">Edit Project</span>

            <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form__item">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $project->name) }}">
                    @if ($errors->has('name'))
                        <span class="error">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form__item">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="10">{{ old('description', $project->description) }}</textarea>
                    @if ($errors->has('description'))
                        <span class="error">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form__item">
                    <label for="photo">Photo</label>
                    @if ($project->photo)
                        <div>
                            <img src="{{ asset($project->photo) }}" alt="Project Photo"
                                style="max-width: 150px; margin-bottom: 10px;">
                        </div>
                    @endif
                    <input type="file" name="photo" accept="image/png, image/jpeg" />
                    @if ($errors->has('photo'))
                        <span class="error">{{ $errors->first('photo') }}</span>
                    @endif
                </div>
                <div class="form__item">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" class="form-control"
                        value="{{ old('link', $project->link) }}">
                    @if ($errors->has('link'))
                        <span class="error">{{ $errors->first('link') }}</span>
                    @endif
                </div>
                <div class="form__item">
                    <label for="tags">Tags:</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ collect(old('tags', $project->tags->pluck('id')->toArray()))->contains($tag->id) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('tags'))
                        <span class="error">{{ $errors->first('tags') }}</span>
                    @endif
                </div>

                <div class="form__button">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
