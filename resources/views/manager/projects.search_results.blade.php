@if ($projects->isEmpty())
<p>Aucun projet correspondant à votre recherche.</p>
@else
<ul>
    @foreach ($projects as $project)
    <li>{{ $project->name }}</li>
    @endforeach
</ul>
@endif