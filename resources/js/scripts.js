window.debounce = function(func, delay) {
    let timeout;
    return function () {
        const context = this;
        const args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), delay);
    };
}

window.myClass = class MyClass {
    constructor(asyncUrl) {
        this.asyncUrl = asyncUrl;
    }

    searchTerms = null;

    fromUrl(url) {
        return fetch(url)
            .then(response => {
                return response.json()
            })
            .then(json => {
                return json
            })
    }
}
