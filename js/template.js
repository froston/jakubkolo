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
    function toggleList(list, icon) {
      list.toggleClass('opened');
      list.slideToggle(500);
      var isOpened = list.hasClass('opened')
      icon 
        .removeClass(isOpened ? "fa-arrow-circle-right" : "fa-arrow-circle-down")
        .addClass(isOpened ? "fa-arrow-circle-down" : "fa-arrow-circle-right");
    }
    $("#left-menu > ul.parent > li.active").each(function() {
      var child = $(this).children('ul.child');
      toggleList(child, $(this).children("i.fa"))
      child.children('li.active').each(function() {
        var baby = $(this).children('ul.baby');
        toggleList(baby, $(this).children("i.fa"))
      });
    });
    $("i.arrow").on("click", function(ev) {
      ev.preventDefault();
      var list = $(this).parent().children('ul:first');
      var isOpened = toggleList(list, $(this))
    });
});





