(function() {
    // This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
    // e.g. just plyr.setup(); and leave it at that if you have no need for events
    var instances = plyr.setup({
        // Output to console
        debug: true
    });

    // Get an element
    function get(selector) {
        return document.querySelector(selector);
    }

    // Custom event handler (just for demo)
    function on(element, type, callback) {
        if (!(element instanceof HTMLElement)) {
            element = get(element);
        }
        // element.addEventListener(type, callback, false);
    }

    // Loop through each instance
    instances.forEach(function(instance) {
        // Play
        on('.js-play', 'click', function() {
            instance.play();
        });

        // Pause
        on('.js-pause', 'click', function() {
            instance.pause();
        });

        // Stop
        on('.js-stop', 'click', function() {
            instance.stop();
        });

        // Rewind
        on('.js-rewind', 'click', function() {
            instance.rewind();
        });

        // Forward
        on('.js-forward', 'click', function() {
            instance.forward();
        });
    });
})();