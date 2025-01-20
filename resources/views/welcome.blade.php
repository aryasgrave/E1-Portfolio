<x-guest-layout>
    <section class="introduction">
        <div class="introduction__container">
            <h1 class="introduction__title">
                @foreach ($users as $user)
                    {{ $user->username }}
                @endforeach
            </h1>

            <p class="introduction__text">
                @foreach ($users as $user)
                    {{ $user->introduction }}
                @endforeach
            </p>
        </div>
    </section>

    <section class="projects">
        <div class="projects__container">
            <div class="projects__items">
                @foreach ($projects as $project)
                    <a href="{{ $project->link }}" class="projects__item">
                        <div class="projects__item-content">
                            <div class="projects__item-media">
                                <img src="{{ asset($project->photo) }}" alt="{{ $project->name }}">
                            </div>

                            <span class="projects__item-title">{{ $project->name }}</span>

                            <div class="proects__items-tags">
                                @foreach ($project->tags as $tag)
                                    <span class="projects__item-tag">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-guest-layout>
