/*
 * <%= domainPrefix %>.<%= _.classify(widgetName) %>
 */
<% if(jsFramework == 'plain') { %>
(function() {
    // Place your plublic-facing JavaScript here
}).call(this);
<% } else if(jsFramework == 'jquery') { %>
(function ($) {
    $(function () {
        // Place your plublic-facing JavaScript here
    });
}(jQuery));
<% } else if(jsFramework == 'angularjs') { %>
angular.module('<%= domainPrefix %>.controllers').controller('<%= _.classify(widgetName) %>Ctrl',function($scope){
    // Place your plublic-facing JavaScript here
});
<% } else if(jsFramework == 'module') { %>
$(function () {
    // in case using https://github.com/acatl/jquery.module
    window.<%= domainPrefix %> = window.<%= domainPrefix %> || {};
    window.<%= domainPrefix %>.<%= _.classify(widgetName) %> = function (api, element, options) {
        // Place your plublic-facing JavaScript here
    };
});
<% } else if(jsFramework == 'none') { %>
// Place your plublic-facing JavaScript here
<% } %>