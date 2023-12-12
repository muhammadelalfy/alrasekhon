import BaseApi from "./base.api"
import Http from "@services/http";

export default class ContestantsApi extends BaseApi {
    static get entity() {
        return 'contestants'
    }

    static async upload(model) {
        return await Http.post(`${this.entity}/upload`, model)
    }
}
