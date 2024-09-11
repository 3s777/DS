window.asyncSelectSearch = class AsyncSelectSearch {
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

    async asyncSearch(choices, dependedData = null) {
        const url = new URL(this.asyncUrl)

        const query = this.searchTerms.value ?? null

        // console.log(dependedData);

        if (query !== null && query.length) {
            url.searchParams.append('query', query)
        }

        if(dependedData !== null) {
            for (const key in dependedData) {
                url.searchParams.append('depended['+key+']', dependedData[key])
                // console.log(`${key} – ${dependedData[key]}`)
            }

        }

        const options = await this.fromUrl(url.toString())

        const response = await axios.post(url.toString(), {
            query: query,
            depended: {'user_id': 11}
        });

        console.log(options);
        console.log(response);

        let result = options;

        if(options.result) {
            result = options.result
        }

        choices.setChoices(result, 'value', 'label', true)
    }
}
