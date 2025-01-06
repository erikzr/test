// skip-warning.js
window.addEventListener('load', function() {
    const originalFetch = window.fetch;
    window.fetch = function() {
        let args = arguments;
        if (args[1] === undefined) {
            args[1] = {};
        }
        if (args[1].headers === undefined) {
            args[1].headers = {};
        }
        args[1].headers['ngrok-skip-browser-warning'] = 'true';
        return originalFetch.apply(this, args);
    };
});