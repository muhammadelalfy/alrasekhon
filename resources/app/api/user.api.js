import BaseApi from "./base.api"
import Http from "@services/http"

export default class UserApi extends BaseApi {

    static get entity() {
        return 'users'
    }

    static async me(params = {}) {
        return await Http.get('me', params)
    }

    static async changePassword(params = {}) {
        return await Http.post('change-password', params)
    }
    static async upload(model) {
        return await Http.post(`${this.entity}/upload`, model)
    }
    static async updateStep(model) {
        return await Http.post(`${this.entity}/update-step/${model.id}`, model)
    }
}
