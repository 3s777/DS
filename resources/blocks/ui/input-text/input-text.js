const inputs = document.querySelectorAll('.input-text__field');
inputs.forEach(el => {

})

inputs.forEach(el => {
    el.addEventListener('blur', e => {
        if(e.target && e.target.value) {
            e.target.classList.add('input-text__field_filled');
        } else {
            e.target.classList.remove('input-text__field_filled');
        }
    })
})

function debounce(func, delay)
{
    let timeout;
    return function () {
        const context = this;
        const args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), delay);
    };
}

