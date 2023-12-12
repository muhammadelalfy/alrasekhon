import BaseApi from "./base.api"
import Http from "@services/http";

export default class AdvertisementsApi extends BaseApi {
    static get entity() {
        return 'advertisements'
    }

    static async upload(model) {
        return await Http.post(`${this.entity}/upload`, model)
    }
}
