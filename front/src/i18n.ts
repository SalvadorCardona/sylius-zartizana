import { createI18n } from 'vue-i18n'
import translation from './../../translations/messages+intl-icu.fr.json'

export default createI18n({
    locale: 'fr',
    messages: {
        fr: translation,
    },
})
