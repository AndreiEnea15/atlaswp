jQuery(document).ready(function($) {
    // Get the main container for the filters
    const filterContainer = $('.informaticasite-filters-section');
    
    // Get all the articles once on page load
    const articles = $('#informaticasite-article-list .article-item');

    // Use event delegation on the filter container
    filterContainer.on('click', 'li', function() {
        const clickedFilter = $(this);
        const parentList = clickedFilter.closest('.filter-list');
        const filterValue = clickedFilter.data('filter');

        // Toggle the 'active' class only within the clicked list's group (category or tag)
        parentList.find('li').removeClass('active');
        clickedFilter.addClass('active');

        // Check the active filters from both category and tag lists
        const activeCategoryFilter = $('#category-filters').find('li.active').data('filter');
        const activeTagFilter = $('#tag-filters').find('li.active').data('filter');

        // Filter articles based on both active filters
        articles.each(function() {
            const article = $(this);
            const isCategoryMatch = (activeCategoryFilter === 'all' || article.hasClass(activeCategoryFilter));
            const isTagMatch = (activeTagFilter === 'all' || article.hasClass(activeTagFilter));

            // Show article if it matches both filters, otherwise hide it
            if (isCategoryMatch && isTagMatch) {
                article.removeClass('hidden');
            } else {
                article.addClass('hidden');
            }
        });
    });
});