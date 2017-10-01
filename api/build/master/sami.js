
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href=".html">[Global Namespace]</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Attire" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Attire.html">Attire</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Attire" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Attire.html">Attire</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Attire_Exceptions" >                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Attire/Exceptions.html">Exceptions</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Attire_Exceptions_Environment" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Attire/Exceptions/Environment.html">Environment</a>                    </div>                </li>                            <li data-name="class:Attire_Exceptions_Library" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Attire/Exceptions/Library.html">Library</a>                    </div>                </li>                            <li data-name="class:Attire_Exceptions_Manager" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Attire/Exceptions/Manager.html">Manager</a>                    </div>                </li>                            <li data-name="class:Attire_Exceptions_Theme" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Attire/Exceptions/Theme.html">Theme</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Attire_Traits" >                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Attire/Traits.html">Traits</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Attire_Traits_Extractor" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Attire/Traits/Extractor.html">Extractor</a>                    </div>                </li>                            <li data-name="class:Attire_Traits_FileKit" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Attire/Traits/FileKit.html">FileKit</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Attire_AssetManager" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Attire/AssetManager.html">AssetManager</a>                    </div>                </li>                            <li data-name="class:Attire_Environment" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Attire/Environment.html">Environment</a>                    </div>                </li>                            <li data-name="class:Attire_ExtensionManager" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Attire/ExtensionManager.html">ExtensionManager</a>                    </div>                </li>                            <li data-name="class:Attire_Lexer" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Attire/Lexer.html">Lexer</a>                    </div>                </li>                            <li data-name="class:Attire_Loader" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Attire/Loader.html">Loader</a>                    </div>                </li>                            <li data-name="class:Attire_Theme" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Attire/Theme.html">Theme</a>                    </div>                </li>                            <li data-name="class:Attire_Views" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Attire/Views.html">Views</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": ".html", "name": "", "doc": "Namespace "},{"type": "Namespace", "link": "Attire.html", "name": "Attire", "doc": "Namespace Attire"},{"type": "Namespace", "link": "Attire/Exceptions.html", "name": "Attire\\Exceptions", "doc": "Namespace Attire\\Exceptions"},{"type": "Namespace", "link": "Attire/Traits.html", "name": "Attire\\Traits", "doc": "Namespace Attire\\Traits"},
            
            {"type": "Class",  "link": "Attire.html", "name": "Attire", "doc": "&quot;Attire Library.&quot;"},
                                                        {"type": "Method", "fromName": "Attire", "fromLink": "Attire.html", "link": "Attire.html#method___construct", "name": "Attire::__construct", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "Attire", "fromLink": "Attire.html", "link": "Attire.html#method_render", "name": "Attire::render", "doc": "&quot;Render a template.&quot;"},
            
            {"type": "Class", "fromName": "Attire", "fromLink": "Attire.html", "link": "Attire/AssetManager.html", "name": "Attire\\AssetManager", "doc": "&quot;Attire Asset Manager Class&quot;"},
                                                        {"type": "Method", "fromName": "Attire\\AssetManager", "fromLink": "Attire/AssetManager.html", "link": "Attire/AssetManager.html#method_initialize", "name": "Attire\\AssetManager::initialize", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "Attire\\AssetManager", "fromLink": "Attire/AssetManager.html", "link": "Attire/AssetManager.html#method_setNamespace", "name": "Attire\\AssetManager::setNamespace", "doc": "&quot;Set namespace.&quot;"},
                    {"type": "Method", "fromName": "Attire\\AssetManager", "fromLink": "Attire/AssetManager.html", "link": "Attire/AssetManager.html#method_setManifest", "name": "Attire\\AssetManager::setManifest", "doc": "&quot;Set manifest.&quot;"},
                    {"type": "Method", "fromName": "Attire\\AssetManager", "fromLink": "Attire/AssetManager.html", "link": "Attire/AssetManager.html#method_debug", "name": "Attire\\AssetManager::debug", "doc": "&quot;Set debug flag.&quot;"},
                    {"type": "Method", "fromName": "Attire\\AssetManager", "fromLink": "Attire/AssetManager.html", "link": "Attire/AssetManager.html#method_addAsset", "name": "Attire\\AssetManager::addAsset", "doc": "&quot;Add an asset to the manager.&quot;"},
                    {"type": "Method", "fromName": "Attire\\AssetManager", "fromLink": "Attire/AssetManager.html", "link": "Attire/AssetManager.html#method_setAutoload", "name": "Attire\\AssetManager::setAutoload", "doc": "&quot;Asset autoloader setter.&quot;"},
                    {"type": "Method", "fromName": "Attire\\AssetManager", "fromLink": "Attire/AssetManager.html", "link": "Attire/AssetManager.html#method_getAutoload", "name": "Attire\\AssetManager::getAutoload", "doc": "&quot;Get the autoloader.&quot;"},
                    {"type": "Method", "fromName": "Attire\\AssetManager", "fromLink": "Attire/AssetManager.html", "link": "Attire/AssetManager.html#method_getGlobals", "name": "Attire\\AssetManager::getGlobals", "doc": "&quot;Get the manag globals.&quot;"},
                    {"type": "Method", "fromName": "Attire\\AssetManager", "fromLink": "Attire/AssetManager.html", "link": "Attire/AssetManager.html#method_getFunctions", "name": "Attire\\AssetManager::getFunctions", "doc": "&quot;Get the manager functions.&quot;"},
            
            {"type": "Class", "fromName": "Attire", "fromLink": "Attire.html", "link": "Attire/Environment.html", "name": "Attire\\Environment", "doc": "&quot;Attire Environment Class&quot;"},
                                                        {"type": "Method", "fromName": "Attire\\Environment", "fromLink": "Attire/Environment.html", "link": "Attire/Environment.html#method___construct", "name": "Attire\\Environment::__construct", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Environment", "fromLink": "Attire/Environment.html", "link": "Attire/Environment.html#method_setValidLexer", "name": "Attire\\Environment::setValidLexer", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Environment", "fromLink": "Attire/Environment.html", "link": "Attire/Environment.html#method_loadTheme", "name": "Attire\\Environment::loadTheme", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "Attire\\Exceptions", "fromLink": "Attire/Exceptions.html", "link": "Attire/Exceptions/Environment.html", "name": "Attire\\Exceptions\\Environment", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "Attire\\Exceptions", "fromLink": "Attire/Exceptions.html", "link": "Attire/Exceptions/Library.html", "name": "Attire\\Exceptions\\Library", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "Attire\\Exceptions", "fromLink": "Attire/Exceptions.html", "link": "Attire/Exceptions/Manager.html", "name": "Attire\\Exceptions\\Manager", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "Attire\\Exceptions", "fromLink": "Attire/Exceptions.html", "link": "Attire/Exceptions/Theme.html", "name": "Attire\\Exceptions\\Theme", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "Attire", "fromLink": "Attire.html", "link": "Attire/ExtensionManager.html", "name": "Attire\\ExtensionManager", "doc": "&quot;Attire Extension Manager Class&quot;"},
                                                        {"type": "Method", "fromName": "Attire\\ExtensionManager", "fromLink": "Attire/ExtensionManager.html", "link": "Attire/ExtensionManager.html#method_initialize", "name": "Attire\\ExtensionManager::initialize", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "Attire\\ExtensionManager", "fromLink": "Attire/ExtensionManager.html", "link": "Attire/ExtensionManager.html#method_getFilters", "name": "Attire\\ExtensionManager::getFilters", "doc": "&quot;Get filters.&quot;"},
                    {"type": "Method", "fromName": "Attire\\ExtensionManager", "fromLink": "Attire/ExtensionManager.html", "link": "Attire/ExtensionManager.html#method_getGlobals", "name": "Attire\\ExtensionManager::getGlobals", "doc": "&quot;Get Global variables.&quot;"},
                    {"type": "Method", "fromName": "Attire\\ExtensionManager", "fromLink": "Attire/ExtensionManager.html", "link": "Attire/ExtensionManager.html#method_getFunctions", "name": "Attire\\ExtensionManager::getFunctions", "doc": "&quot;Get functions.&quot;"},
                    {"type": "Method", "fromName": "Attire\\ExtensionManager", "fromLink": "Attire/ExtensionManager.html", "link": "Attire/ExtensionManager.html#method_getName", "name": "Attire\\ExtensionManager::getName", "doc": "&quot;Get extension manager name.&quot;"},
                    {"type": "Method", "fromName": "Attire\\ExtensionManager", "fromLink": "Attire/ExtensionManager.html", "link": "Attire/ExtensionManager.html#method_addFilter", "name": "Attire\\ExtensionManager::addFilter", "doc": "&quot;Add a filter.&quot;"},
                    {"type": "Method", "fromName": "Attire\\ExtensionManager", "fromLink": "Attire/ExtensionManager.html", "link": "Attire/ExtensionManager.html#method_addGlobal", "name": "Attire\\ExtensionManager::addGlobal", "doc": "&quot;Add a global variable.&quot;"},
                    {"type": "Method", "fromName": "Attire\\ExtensionManager", "fromLink": "Attire/ExtensionManager.html", "link": "Attire/ExtensionManager.html#method_addFunction", "name": "Attire\\ExtensionManager::addFunction", "doc": "&quot;Add a function.&quot;"},
                    {"type": "Method", "fromName": "Attire\\ExtensionManager", "fromLink": "Attire/ExtensionManager.html", "link": "Attire/ExtensionManager.html#method_addFilters", "name": "Attire\\ExtensionManager::addFilters", "doc": "&quot;Add multiple filters.&quot;"},
                    {"type": "Method", "fromName": "Attire\\ExtensionManager", "fromLink": "Attire/ExtensionManager.html", "link": "Attire/ExtensionManager.html#method_addGlobals", "name": "Attire\\ExtensionManager::addGlobals", "doc": "&quot;Add multiple global variables.&quot;"},
                    {"type": "Method", "fromName": "Attire\\ExtensionManager", "fromLink": "Attire/ExtensionManager.html", "link": "Attire/ExtensionManager.html#method_addFunctions", "name": "Attire\\ExtensionManager::addFunctions", "doc": "&quot;Add multiple functions.&quot;"},
            
            {"type": "Class", "fromName": "Attire", "fromLink": "Attire.html", "link": "Attire/Lexer.html", "name": "Attire\\Lexer", "doc": "&quot;Attire Lexer Class&quot;"},
                                                        {"type": "Method", "fromName": "Attire\\Lexer", "fromLink": "Attire/Lexer.html", "link": "Attire/Lexer.html#method___construct", "name": "Attire\\Lexer::__construct", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Lexer", "fromLink": "Attire/Lexer.html", "link": "Attire/Lexer.html#method_initialize", "name": "Attire\\Lexer::initialize", "doc": "&quot;Initialize&quot;"},
                    {"type": "Method", "fromName": "Attire\\Lexer", "fromLink": "Attire/Lexer.html", "link": "Attire/Lexer.html#method_isValid", "name": "Attire\\Lexer::isValid", "doc": "&quot;Checks if is valid the declaration of arguments&quot;"},
            
            {"type": "Class", "fromName": "Attire", "fromLink": "Attire.html", "link": "Attire/Loader.html", "name": "Attire\\Loader", "doc": "&quot;Attire Loader Class&quot;"},
                                                        {"type": "Method", "fromName": "Attire\\Loader", "fromLink": "Attire/Loader.html", "link": "Attire/Loader.html#method___construct", "name": "Attire\\Loader::__construct", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Loader", "fromLink": "Attire/Loader.html", "link": "Attire/Loader.html#method_setRootPath", "name": "Attire\\Loader::setRootPath", "doc": "&quot;Get the root path.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Loader", "fromLink": "Attire/Loader.html", "link": "Attire/Loader.html#method_getRootPath", "name": "Attire\\Loader::getRootPath", "doc": "&quot;Get the root path.&quot;"},
            
            {"type": "Class", "fromName": "Attire", "fromLink": "Attire.html", "link": "Attire/Theme.html", "name": "Attire\\Theme", "doc": "&quot;Attire Theme Class&quot;"},
                                                        {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method___construct", "name": "Attire\\Theme::__construct", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_getNamespace", "name": "Attire\\Theme::getNamespace", "doc": "&quot;Get Namespace.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_getMainThemePath", "name": "Attire\\Theme::getMainThemePath", "doc": "&quot;Get main theme path.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_getName", "name": "Attire\\Theme::getName", "doc": "&quot;Get theme name.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_setName", "name": "Attire\\Theme::setName", "doc": "&quot;Set the theme name.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_setPath", "name": "Attire\\Theme::setPath", "doc": "&quot;Set theme default path (without name).&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_getPath", "name": "Attire\\Theme::getPath", "doc": "&quot;Get theme default path.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_setTemplate", "name": "Attire\\Theme::setTemplate", "doc": "&quot;Set the master template.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_getTemplate", "name": "Attire\\Theme::getTemplate", "doc": "&quot;Get the current template.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_setLayout", "name": "Attire\\Theme::setLayout", "doc": "&quot;Set a new layout.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_getLayout", "name": "Attire\\Theme::getLayout", "doc": "&quot;Get the current layout.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_disable", "name": "Attire\\Theme::disable", "doc": "&quot;Disable the theme.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Theme", "fromLink": "Attire/Theme.html", "link": "Attire/Theme.html#method_isDisabled", "name": "Attire\\Theme::isDisabled", "doc": "&quot;Check if the theme is disabled.&quot;"},
            
            {"type": "Trait", "fromName": "Attire\\Traits", "fromLink": "Attire/Traits.html", "link": "Attire/Traits/Extractor.html", "name": "Attire\\Traits\\Extractor", "doc": "&quot;Attire Extractor Trait&quot;"},
                    
            {"type": "Trait", "fromName": "Attire\\Traits", "fromLink": "Attire/Traits.html", "link": "Attire/Traits/FileKit.html", "name": "Attire\\Traits\\FileKit", "doc": "&quot;Attire Filekit Trait&quot;"},
                                                        {"type": "Method", "fromName": "Attire\\Traits\\FileKit", "fromLink": "Attire/Traits/FileKit.html", "link": "Attire/Traits/FileKit.html#method_rtrim", "name": "Attire\\Traits\\FileKit::rtrim", "doc": "&quot;Right trim a file path.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Traits\\FileKit", "fromLink": "Attire/Traits/FileKit.html", "link": "Attire/Traits/FileKit.html#method_haveExtension", "name": "Attire\\Traits\\FileKit::haveExtension", "doc": "&quot;Check if file have extension.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Traits\\FileKit", "fromLink": "Attire/Traits/FileKit.html", "link": "Attire/Traits/FileKit.html#method_isValidFileExtension", "name": "Attire\\Traits\\FileKit::isValidFileExtension", "doc": "&quot;Check if the file have a valid extension.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Traits\\FileKit", "fromLink": "Attire/Traits/FileKit.html", "link": "Attire/Traits/FileKit.html#method_setFileExtension", "name": "Attire\\Traits\\FileKit::setFileExtension", "doc": "&quot;Set a new file extension.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Traits\\FileKit", "fromLink": "Attire/Traits/FileKit.html", "link": "Attire/Traits/FileKit.html#method_getFileExtension", "name": "Attire\\Traits\\FileKit::getFileExtension", "doc": "&quot;Get current file extension.&quot;"},
            
            {"type": "Class", "fromName": "Attire", "fromLink": "Attire.html", "link": "Attire/Views.html", "name": "Attire\\Views", "doc": "&quot;Attire Views Class&quot;"},
                                                        {"type": "Method", "fromName": "Attire\\Views", "fromLink": "Attire/Views.html", "link": "Attire/Views.html#method___construct", "name": "Attire\\Views::__construct", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Views", "fromLink": "Attire/Views.html", "link": "Attire/Views.html#method_getStored", "name": "Attire\\Views::getStored", "doc": "&quot;Get stored views.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Views", "fromLink": "Attire/Views.html", "link": "Attire/Views.html#method_add", "name": "Attire\\Views::add", "doc": "&quot;Add a view.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Views", "fromLink": "Attire/Views.html", "link": "Attire/Views.html#method_parse", "name": "Attire\\Views::parse", "doc": "&quot;Parse a view with Attire preferences.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Views", "fromLink": "Attire/Views.html", "link": "Attire/Views.html#method_remove", "name": "Attire\\Views::remove", "doc": "&quot;Remove specific view.&quot;"},
                    {"type": "Method", "fromName": "Attire\\Views", "fromLink": "Attire/Views.html", "link": "Attire/Views.html#method_reset", "name": "Attire\\Views::reset", "doc": "&quot;Clear all the stored views.&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


