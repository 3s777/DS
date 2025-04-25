 window.debounce = function(func, delay) {
    let timeout;
    return function () {
        const context = this;
        const args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), delay);
    };
}

 tippy('[data-tippy-content]', {
     theme: 'light',
     trigger: 'click'
 });
