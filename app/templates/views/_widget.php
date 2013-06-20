<!-- This file is used to markup the public-facing widget. -->

<div class="<%= domainPrefix %>-widget <%= _.slugify(widgetName) %>"<% if(jsFramework != 'angularjs' && jsFramework != 'module') { %>>
    <% } else if(jsFramework == 'angularjs') { %>
     ng-controller="<%= domainPrefix %>.<%= _.classify(widgetName) %>Ctrl">
<% } else if(jsFramework == 'module') { %>
     data-module="<%= domainPrefix %>.<%= _.classify(widgetName) %>">
<% } %>
    <pre><%= domainPrefix %>.<%= _.classify(widgetName) %></pre>
</div>