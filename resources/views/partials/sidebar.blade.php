<div id="archive_list" class="well" >
    <h3 class="">Archive</h3>
    <hr>
    @foreach($archives as $archive)
    <a href="/?month={{ $archive['month']}}&year={{ $archive['year'] }}" class="larger_text">{{ $archive['year'] . ' ' . $archive['month'] }}</a>
    @endforeach()
</div>

<div id="tags_list" class="well" >
    <h3 class="">Tags</h3>
    <hr>
    @foreach($tags as $tag)
    <a href="{{ route('post.index_tag', ['tag' => $tag] ) }}" class="label label-success larger_text">{{ $tag }}</a>
    @endforeach()
</div>
