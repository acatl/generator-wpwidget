<!-- This file is used to markup the admin-facing widget. -->

<div class="<%= domainPrefix %>-widget <%= _.slugify(widgetName) %>-admin"<% if(jsFramework != 'angularjs' && jsFramework != 'module') { %>>
    <% } else if(jsFramework == 'angularjs') { %>
     ng-controller="<%= domainPrefix %>.<%= _.classify(widgetName) %>CtrlAdmi">
<% } else if(jsFramework == 'module') { %>
     data-module="<%= domainPrefix %>.<%= _.classify(widgetName) %>Admin">
<% } %>
    <pre><%= domainPrefix %>.<%= _.classify(widgetName) %>Admin</pre>
</div>