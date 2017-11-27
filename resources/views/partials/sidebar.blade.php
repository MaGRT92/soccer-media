<div id="archive_list" class="well" >
    <h3 class="">Archive</h3>
    <hr>
    @foreach($archives as $archive)
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-sm-12">
            <a href="/?month={{ $archive['month']}}&year={{ $archive['year'] }}" class="larger_text">{{ $archive['year'] . ' ' . $archive['month'] }}</a>
        </div>
    </div>
    @endforeach()
</div>

<div id="tags_list" class="well" >
    <h3 class="">Tags</h3>
    <hr>
    @foreach($tags as $tag)
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-sm-12">
            <a href="{{ route('post.index_tag', ['tag' => $tag] ) }}" class="label label-success larger_text">{{ $tag }}</a>
        </div>
    </div>
    @endforeach()
</div>
