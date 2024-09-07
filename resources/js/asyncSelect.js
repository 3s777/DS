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

    async asyncSearch(choices) {
        const url = new URL(this.asyncUrl)

        const query = this.searchTerms.value ?? null

        if (query !== null && query.length) {
            url.searchParams.append('query', query)
        }

        const options = await this.fromUrl(url.toString())

        let result = options;

        if(options.result) {
            result = options.result
        }

        choices.setChoices(result, 'value', 'label', true)
    }
}
