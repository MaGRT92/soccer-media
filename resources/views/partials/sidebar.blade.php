<div id="archive_list" class="w3-bar-block w3-text-blue" >
    <h3 class="w3-green w3-padding w3-center">Archive</h3>
    @foreach($archives as $archive)
    <a href="/?month={{ $archive['month']}}&year={{ $archive['year'] }}" class="w3-bar-item w3-button w3-hover-text-white">{{ $archive['year'] . ' ' . $archive['month'] }}</a>
    @endforeach()
</div>

<div id="tags_list" class="w3-bar-block w3-text-blue" >
    <h3 class="w3-green w3-padding w3-center">Tags</h3>
    @foreach($tags as $tag)
    <a href="{{ route('tag.index', ['tag' => $tag] ) }}" class="w3-bar-item w3-button w3-hover-text-white">{{ $tag }}</a>
    @endforeach()
</div>
