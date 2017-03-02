/*
 * Functionality for the Gear Toolbar.
 */

var gearToolbar = {

    toolbar : null,

    //--------------------------------------------------------------------

    init : function()
    {
        this.toolbar = document.getElementById('gear-toolbar');

        gearToolbar.createListeners();
        gearToolbar.setToolbarState();
    },

    //--------------------------------------------------------------------

    createListeners : function()
    {
        var buttons = [].slice.call(document.querySelectorAll('#gear-toolbar .gear-toolbar-label a'));

        for (var i=0; i < buttons.length; i++)
        {
            buttons[i].addEventListener('click', gearToolbar.showTab, true);
        }
    },

    //--------------------------------------------------------------------

    showTab: function()
    {
        // Get the target tab, if any
        var tab = this.getAttribute('data-tab');

        // Check our current state.
        var state = document.getElementById(tab).style.display;

        if (tab == undefined) return true;

        // Hide all tabs
        var tabs = document.querySelectorAll('#gear-toolbar .tab');

        for (var i=0; i < tabs.length; i++)
        {
            tabs[i].style.display = 'none';
        }

        // Mark all labels as inactive
        var labels = document.querySelectorAll('#gear-toolbar .gear-toolbar-label');

        for (var i=0; i < labels.length; i++)
        {
            gearToolbar.removeClass(labels[i], 'active');
        }

        // Show/hide the selected tab
        if (state != 'block')
        {
            document.getElementById(tab).style.display = 'block';
            gearToolbar.addClass(this.parentNode, 'active');
        }
    },

    //--------------------------------------------------------------------

    addClass : function(el, className)
    {
        if (el.classList)
        {
            el.classList.add(className);
        }
        else
        {
            el.className += ' ' + className;
        }
    },

    //--------------------------------------------------------------------

    removeClass : function(el, className)
    {
        if (el.classList)
        {
            el.classList.remove(className);
        }
        else
        {
            el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
        }

    },

    //--------------------------------------------------------------------

    /**
     * Toggle display of a data table
     * @param obj
     */
    toggleDataTable : function(obj)
    {
        if (typeof obj == 'string')
        {
            obj = document.getElementById(obj + '_table');
        }

        if (obj)
        {
            obj.style.display = obj.style.display == 'none' ? 'block' : 'none';
        }
    },

    //--------------------------------------------------------------------

    /**
     *   Toggle tool bar from full to icon and icon to full
     */
    toggleToolbar : function()
    {
        var elementToolbarIcon = document.getElementById('gear-toolbar-icon');
        var elementToolbar = document.getElementById('gear-toolbar');
        var open = elementToolbar.style.display != 'none';

        elementToolbarIcon.style.display = open == true ? 'inline-block' : 'none';
        elementToolbar.style.display  = open == false ? 'inline-block' : 'none';

        // Remember it for other page loads on this site
        gearToolbar.createCookie('gear-toolbar-state', '', -1);
        gearToolbar.createCookie('gear-toolbar-state', open == true ? 'minimized' : 'open' , 365);
    },

    //--------------------------------------------------------------------

    /**
     * Sets the initial state of the toolbar (open or minimized) when
     * the page is first loaded to allow it to remember the state between refreshes.
     */
    setToolbarState: function()
    {
        var open = gearToolbar.readCookie('gear-toolbar-state');
        var elementToolbarIcon = document.getElementById('gear-toolbar-icon');
        var elementToolbar = document.getElementById('gear-toolbar');

        elementToolbarIcon.style.display = open != 'open' ? 'inline-block' : 'none';
        elementToolbar.style.display  = open == 'open' ? 'inline-block' : 'none';
    },

    //--------------------------------------------------------------------

    /**
     * Helper to create a cookie.
     *
     * @param name
     * @param value
     * @param days
     */
    createCookie : function(name,value,days)
    {
        if (days)
        {
            var date = new Date();

            date.setTime(date.getTime()+(days*24*60*60*1000));

            var expires = "; expires="+date.toGMTString();
        }
        else
        {
            var expires = "";
        }

        document.cookie = name+"="+value+expires+"; path=/";
    },

    //--------------------------------------------------------------------

    readCookie : function(name)
    {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');

        for(var i=0;i < ca.length;i++)
        {
            var c = ca[i];
            while (c.charAt(0)==' ')
            {
                c = c.substring(1,c.length);
            }
            if (c.indexOf(nameEQ) == 0)
            {
                return c.substring(nameEQ.length,c.length);
            }
        }
        return null;
    }
};
