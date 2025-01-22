<x-app-layout>
    <section class="introduction">
        <div class="introduction__container">

            <span class="introduction__title">
                @foreach ($users as $user)
                    {!! $user->username !!}
                @endforeach
            </span>

            <div class="introduction__topbuttons">
                <a href="{{ url('/') }}" class="btn-solid--gradient">
                    <button type="button">
                        <i class="fa-solid fa-arrow-left"></i> Back to homepage?
                    </button>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();"
                        class="btn-solid--gradient">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>

            <div class="introduction__actions">
                <a href="{{ route('projects.create') }}" class="btn-solid--gradient">New project</a>
            </div>
        </div>
    </section>

    <section class="projects">
        <div class="projects__container">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Tags</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>
                            <ul class="projects__tags">
                                @foreach ($project->tags as $tag)
                                    <li>&#8226; {{ $tag->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <div class="projects__edit">
                                <a href="{{ route('projects.edit', $project->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="projects__delete">
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this project?');">
                                    @csrf
                                    @method('DELETE')

                                    <label for="project_name_confirmation">
                                        Type name to confirm
                                    </label>
                                    <input name="project_name_confirmation" id="project_name_confirmation"
                                        placeholder="{{ $project->name }}" required>

                                    <button type="submit">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
</x-app-layout>
