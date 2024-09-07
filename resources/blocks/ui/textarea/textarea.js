const inputs = document.querySelectorAll('.textarea__field');

inputs.forEach(el => {
    el.addEventListener('blur', e => {
        if(e.target.value) {
            e.target.classList.add('textarea__field_filled');
        } else {
            e.target.classList.remove('textarea__field_filled');
        }
    })
})
