jQuery(document).ready(function($){
    const searchForm  = $('#atlasis-search-form');
    const searchInput = $('#atlasis-search-query');
    const articleList = $('#atlasis-article-list');

    if (!searchForm.length || !searchInput.length || !articleList.length) return;

    searchForm.on('submit', function(e){
        e.preventDefault();

        const query = searchInput.val().trim();
        if (query === '') { 
            articleList.html('<p>Please enter a search term.</p>');
            return;
        }

        articleList.html('<p class="loading-message">Searching for articles...</p>');

        $.ajax({
            url: atlasis_ajax.ajax_url,
            type: 'POST',
            data: { 
                action: 'atlasis_search', 
                query: query, 
                nonce: atlasis_ajax.nonce 
            },
            success: function(response){
                if (response && response.success) {
                    articleList.html(response.data.html);
                } else {
                    articleList.html('<p class="error-message">No results found.</p>');
                }
            },
            error: function(){
                articleList.html('<p class="error-message">An unexpected error occurred.</p>');
            }
        });
    });
});
