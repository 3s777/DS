const inputs = document.querySelectorAll('.input-text__field');

console.log(inputs);

inputs.forEach(el => {
    console.log(el.defaultValue + 1);
})

inputs.forEach(el => {
    el.addEventListener('blur', e => {
        if(e.target && e.target.value) {
            console.log('sdf');
            e.target.classList.add('input-text__field_filled');
        } else {
            e.target.classList.remove('input-text__field_filled');
        }
    })
})
