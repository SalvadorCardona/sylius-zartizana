import { components, paths } from '@/schema/app-api-schema'
import { Fetcher } from 'openapi-typescript-fetch'
import StorageService from '@/modules/shared/services/StorageService'
import { Token } from '@/modules/user/services/UserService'

export interface Hydra<T> {
    'hydra:member': T[]
    'hydra:totalItems'?: number
    'hydra:view'?: {
        '@id'?: string
        '@type'?: string
        'hydra:first'?: string
        'hydra:last'?: string
        'hydra:previous'?: string
        'hydra:next'?: string
    }
    'hydra:search'?: {
        '@type'?: string
        'hydra:template'?: string
        'hydra:variableRepresentation'?: string
        'hydra:mapping'?: {
            '@type'?: string
            variable?: string
            property?: string | null
            required?: boolean
        }[]
    }
}

export type ApiSchemas = components['schemas']

export default class FetcherService {
    // eslint-disable-next-line vue/max-len
    // eslint-disable-next-line @typescript-eslint/explicit-module-boundary-types
    public static get() {
        const headers = {
            accept: 'application/json',
            'Content-Type': 'application/json',
            Authorization: '',
        }

        const fetcher = Fetcher.for<paths>()
        const token = StorageService.get<Token>('user')

        if (token) {
            headers.Authorization = 'Bearer ' + token.token
        }

        fetcher.configure({
            baseUrl: process.env.API_ENDPOINT,
            init: {
                headers: headers,
            },
            use: [], // middlewares
        })

        return fetcher
    }
}
