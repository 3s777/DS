var targets = document.querySelectorAll('input[type=radio][name="target"]');
targets.forEach(target => target.addEventListener('change',
    function() {
        document.querySelectorAll('.collectible-target__fields').forEach(function(el) {
            el.style.display = 'none';
        });

        if(target.value === 'sale') {
            document.querySelectorAll('.collectible-target__sale').forEach(function(el) {
                el.style.display = 'block';
            });
        }

        if(target.value === 'auction') {
            document.querySelectorAll('.collectible-target__auction').forEach(function(el) {
                el.style.display = 'block';
            });
        }

        console.log(target.value);
    }
));

async function setKit(mediaValue) {
    try {
        const media = mediaValue ?? null
        const response = await axios.post('{{ route('collectibles.get.media') }}', {
            media: media,
            model: 'Game'
        });
        console.log(response.data);
        const kit = document.getElementById('kit')
        kit.innerHTML = response.data;
        return response.data.result;
    } catch (err) {

        console.log(err);

    }
}

const mediaSelect = document.getElementById('media-select');

if(mediaSelect.value !== '') {
    window.addEventListener("load", (event) => {
        setKit(mediaSelect.value);
    });
}

mediaSelect.addEventListener('change', async function() {
    try {
        const media = this.value ?? null
        const response = await axios.post('{{ route('collectibles.get.media') }}', {
            media: media,
            model: 'Game'
        });
        console.log(response.data);
        const kit = document.getElementById('kit')
        kit.innerHTML = response.data;
        return response.data.result;
    } catch (err) {

        console.log(err);

    }
});
