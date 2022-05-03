import { createStore, Store, useStore as baseUseStore } from 'vuex'
import { InjectionKey } from 'vue'
import UserService from '@/modules/user/services/UserService'

export interface IRootState {
    userService: UserService
}

export const key: InjectionKey<Store<IRootState>> = Symbol()

export enum Actions {
    APP_LOAD = 'APP_LOAD',
}

export const store = createStore<IRootState>({
    state: {
        userService: new UserService(),
    },
    actions: {
        [Actions.APP_LOAD]: ({ dispatch }): void => {},
    },
})

export function useStore(): Store<IRootState> {
    return baseUseStore(key)
}
