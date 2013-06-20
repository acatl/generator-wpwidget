/*
 * <%= domainPrefix %>.<%= _.classify(widgetName) %>Admin
 */
<% if(jsFramework == 'plain') { %>
(function() {
    // Place your admin-facing JavaScript here
}).call(this);
<% } else if(jsFramework == 'jquery') { %>
(function ($) {
    $(function () {
        // Place your admin-facing JavaScript here
    });
}(jQuery));
<% } else if(jsFramework == 'angularjs') { %>
angular.module('<%= domainPrefix %>.controllers').controller('<%= _.classify(widgetName) %>AdminCtrl',function($scope){
    // Place your admin-facing JavaScript here
});
<% } else if(jsFramework == 'module') { %>
$(function () {
    // in case using https://github.com/acatl/jquery.module
    window.<%= domainPrefix %> = window.<%= domainPrefix %> || {};
    window.<%= domainPrefix %>.<%= _.classify(widgetName) %>Admin = function (api, element, options) {
        // Place your admin-facing JavaScript here
    };
});
<% } else if(jsFramework == 'none') { %>
// Place your admin-facing JavaScript here
<% } %>