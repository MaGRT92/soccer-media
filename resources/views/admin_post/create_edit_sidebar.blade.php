<div class="w3-card-4 w3-margin-top w3-round">
    <div class="w3-container w3-teal">
        <h2>Tags</h2>
    </div>

    <div class="w3-container w3-padding-12 w3-margin-top">
        <form method="POST" action="{{ route('admin_tag.store') }}">
            {{ csrf_field() }}
            <div class="w3-row-padding">
                <div class="w3-col m7">
                    <input type="text" class="w3-input w3-border" name="tag_name"  />
                </div>
                <div class="w3-col m5">
                    <input type="submit" class="w3-btn w3-blue-grey" value="Add New Tag" style="margin-top: 2px;" />
                </div>
            </div>
        </form>
    </div>

    <div class="w3-container w3-padding-12">
        <div id="choosed_tags_list" class="w3-row w3-margin-bottom">
            {!! $choosed_tags_list or '' !!}
        </div>
        <div class="w3-center">
            <button id="btn_show_tags_modal" class="w3-button w3-blue-grey">Choose Tags</button>
        </div>
    </div>

    <div id="tags_modal" class="w3-modal">
        <div class="w3-modal-content w3-animate-right">
            <header class="w3-container w3-teal"> 
                <span onclick="document.getElementById('tags_modal').style.display = 'none'" 
                      class="w3-button w3-display-topright">&times;</span>
                <h2>Choose Tag</h2>
            </header>
            <div class="w3-container">
                <ul id="admin_tags_list" class="w3-ul w3-padding">
                    {!! $tags_list !!}
                </ul>
            </div>
            <footer class="w3-container w3-teal w3-padding">
                <input type="button" id="btn_add_tags_to_form" class="w3-btn w3-white w3-right" value="OK" />
            </footer>
        </div>
    </div>
</div>