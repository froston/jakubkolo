jQuery(document).ready(function($) {
    //click outside of search form
    $(document).click(function(e) {
        //if clicked element is not the element and parents aren't the div
        if (e.target.id != 'search-form' && $(e.target).parents('#search-form').length == 0) {
          $("#search-form").removeClass("active");
        }
    });
    //click on search button
    $("#search-icon").click(function() {
        $("#search-form").addClass("active");
        return false;
    });
});





