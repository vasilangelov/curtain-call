@if (isset($entry->poster))
    <img src="/{{ $entry->poster }}" class="container-fluid" style="max-width: 300px" alt="{{ $entry->name }}" />
@endif
