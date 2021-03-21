(function ($) {
  var $newdiv1 = $("<div id='object1'><form method='POST'><input name='date' type='date'/> <input type='submit' name='submit' value='delay'/></div>"),
    newdiv2 = document.createElement("div"),
    existingdiv1 = document.getElementById("foo");
  $("a.delay").click(function (e) {
    e.preventDefault();
    $("a.delay").hide();
    $("a.delay").parent().append($newdiv1, [newdiv2, existingdiv1]);
    // $('#datepick').datepicker('show');
  });
})(jQuery);
