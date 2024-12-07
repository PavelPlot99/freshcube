import axios from '../core/http'

export const generateUrl = (options) => {
    const { url: replaceUrl, queryParams = [] } = options
    const params =  Object.entries(queryParams)

    if (params.length === 0) {
        return replaceUrl
    }

    return params.reduce((acc, [key, value]) => acc.replace(new RegExp(`:${key}`, 'g'), value), replaceUrl)
}

export class BaseApiService {
    constructor() {
        this.instance = axios
    }

    async buildRequest(options, { isData = true } = {}) {
        const url = generateUrl(options)

        const request = await this.instance({
            ...options,
            url,
        })

        return isData ? request?.data : request
    }
}