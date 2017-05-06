(function ($, Drupal, settings) {
 
  "use strict";
 
  Drupal.behaviors.Crutch = { //the name of our behavior
    attach: function (context, settings) {
      function strip_tags(input, allowed) { //the strip_tags function that cuts unnecessary tags on regular expression and returns clean text. Important! The input parameter works correctly only string data type.
        allowed = (((allowed || '') + '')
          .toLowerCase()
          .match(/<[a-z][a-z0-9]*>/g) || [])
          .join('');
        var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
          commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
        return input.replace(commentsAndPhpTags, '')
          .replace(tags, function($0, $1) {
            return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
          });
      }
      $(document).bind('ajaxSuccess.Crutch', function() { //run the main code only after Ajax has successfully downloaded your node
        var value = $(".ui-dialog-title"); //matching the popup title class
 
        if (value.length && !value.hasClass('do-once')) { //if there is no do-once class,
          var text = strip_tags($(value).text()); //then run the strip_tags() function
          $(value).text(text);
          value.addClass('do-once');
        }
        $(this).unbind('ajaxSuccess.Crutch');
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
