<template>
    <BaseTemplate>
        <div v-if="!userService.token">
            <input v-model="loginRequest.email" type="text" class="app-input"/>
            <input v-model="loginRequest.password" type="text" class="app-input"/>
            <button class="app-btn" @click="() => userService.connection(loginRequest)">Se connecter</button>
        </div>
        <div v-else>
            Vous êtes connecté
            <div>
                {{ userService.user }}
            </div>
        </div>
    </BaseTemplate>
</template>

<script lang="ts" setup>
import UserService, {LoginRequest} from '@/modules/user/services/UserService'
import {useStore} from '@/store'
import BaseTemplate from '@/modules/shared/Pages/BaseTemplate.vue'

const userService: UserService = useStore().state.userService
const loginRequest: LoginRequest = {email: '', password: ''}
</script>
