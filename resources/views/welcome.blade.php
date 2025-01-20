<x-guest-layout>
    <section class="introduction">
        <div class="introduction__container">
            <span class="introduction__title">
                @foreach ($users as $user)
                    {!! $user->username !!}
                @endforeach
            </span>

            <p class="introduction__text">
                @foreach ($users as $user)
                    {{ $user->introduction }}
                @endforeach
            </p>
        </div>
    </section>

    <section class="search">
        <div class="search__container">
            <form action="{{ route('welcome') }}" method="GET">
                <input type="text" name="search" class="search__bar" placeholder="Search projects..."
                    value="{{ request('search') }}" />

                <select name="tag" class="search__filters">
                    <option value="">All Tags</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="search__button">Filter</button>
            </form>
        </div>
    </section>

    <section class="projects">
        <div class="projects__container">
            <div class="projects__items">
                @forelse ($projects as $project)
                    <a href="{{ $project->link }}" class="projects__item">
                        <div class="projects__item-content">
                            <div class="projects__item-media">
                                <img src="{{ asset($project->photo) }}" alt="{{ $project->name }}">
                            </div>
                            <span class="projects__item-title">{{ $project->name }}</span>
                            <p class="projects__item-description">
                                {{ $project->description }}
                            </p>
                            <div class="projects__item-tags">
                                @foreach ($project->tags as $tag)
                                    <span class="projects__item-tag  ">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="projects__no-results">No projects found.</p>
                @endforelse
            </div>
        </div>
    </section>

</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Submit form on "Enter" key press in the search field
        document.querySelector('.projects__search').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });

        // Submit form automatically when a tag is selected
        document.querySelector('.projects__filter').addEventListener('change', function() {
            this.form.submit();
        });
    });
</script>
