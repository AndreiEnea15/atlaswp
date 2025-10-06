jQuery(document).ready(function($){
    const searchForm = $('#atlaswp-search-form');
    const searchInput = $('#atlaswp-search-query');
    const articleList = $('#atlaswp-article-list');

    searchForm.on('submit', function(e){
        e.preventDefault();
        const query = searchInput.val().trim();
        if(query===''){ window.location.reload(); return; }

        articleList.html('<p class="loading-message">Searching for articles...</p>');

        $.ajax({
            url: atlaswp_ajax.ajax_url,
            type: 'POST',
            data: { action:'atlaswp_search', query:query, nonce:atlaswp_ajax.nonce },
            success:function(response){ 
                if(response.success){ articleList.html(response.data.html); }
                else{ articleList.html('<p class="error-message">An error occurred. Please try again.</p>'); }
            },
            error:function(){ articleList.html('<p class="error-message">An unexpected error occurred.</p>'); }
        });
    });
});
