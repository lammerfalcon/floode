import { NuxtAuthHandler } from '#auth'
import TwitchProvider from 'next-auth/providers/twitch';
import GithubProvider from 'next-auth/providers/github'

export default NuxtAuthHandler({
    providers: [
        TwitchProvider({
            clientId: 'j2pdx4a8mydwdzbn48f3536ktgn72i',
            clientSecret: '9ncfze6ms65m57yyclrw9on89afwe6'
        })
    ]
})
