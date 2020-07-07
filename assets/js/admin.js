(function ($) {
    $(document).ready(function () {
    $('<div class="dynamic__item delete__count">x</div>').appendTo($(".dynamic").last());
    let i;
    $('#add__count').click(function (e) {
        e.preventDefault();
        i = $('.count__list .dynamic').length;
        if (i < 4) {
            $(".dynamic .delete__count").remove();
            i++;
            $('<div class="dynamic" style="display: flex"><div class="dynamic__item number_item">' + i + ' </div> ' +
                '<div class="dynamic__item"><label>Count</label> ' +
                '<input class="count" min="1" type="number" name="count_' + i + '" required/></div>' +
                '<div class="dynamic__item"><label>Title</label> ' +
                '<input  class="title" type="text" name="title_' + i + '" required/></div>' +
                '<div class="dynamic__item"><label>Description</label> ' +
                '<textarea name="desc_' + i + '" size="25" cols="40" rows="2"/></textarea></div>' +
                '<div class="dynamic__item delete__count">x</div></div>'
            ).fadeIn('slow').appendTo('.count__list');
        }
    });

    $(".count__list").on('click', '.delete__count', function () {
        console.log(this);
        $(this).parents('.dynamic').remove();
        i = $('.count__list .dynamic').length;
        if(i>1)
            $('<div class="dynamic__item delete__count">x</div>').appendTo($(".dynamic").last());
    });
});
})(jQuery);