import fetcher, { ApiSchemas } from '@/modules/shared/services/FetcherService'
import { ApiResponse } from 'openapi-typescript-fetch'
import StorageService from '@/modules/shared/services/StorageService'
import jwtDecode, { JwtPayload } from 'jwt-decode'
import FetcherService from '@/modules/shared/services/FetcherService'

export interface Token {
    token: string
    customer: string
}
export interface LoginRequest {
    email: string
    password: string
}

export const userKey = 'user'

export default class UserService {
    public token: Token | null = StorageService.get<Token>(userKey)

    public get user(): JwtPayload | null {
        return this.token
            ? jwtDecode<JwtPayload>(this.token.token as string)
            : null
    }

    public isLogged(): boolean {
        if (!this.token) return false

        if (!this.user?.exp) return false

        return Date.now() <= this.user?.exp * 1000
    }

    public connection(loginRequest: LoginRequest): Promise<ApiResponse<Token>> {
        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-ignore
        return (
            FetcherService.get()
                // eslint-disable-next-line @typescript-eslint/ban-ts-comment
                // @ts-ignore
                .path('/api/v2/shop/authentication-token')
                // eslint-disable-next-line @typescript-eslint/ban-ts-comment
                // @ts-ignore
                .method('post')
                .create()(loginRequest)
                .then((response) => {
                    this.token = response.data
                    StorageService.set(userKey, this.token)
                    return response
                })
        )
    }

    public logout(): void {
        StorageService.remove(userKey)
    }
}
