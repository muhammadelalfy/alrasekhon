import BaseApi from "./base.api"
import Http from "@services/http";

export default class CityApi extends BaseApi {
    static get entity() {
        return 'city'
    }
    static async listCitiesById(params = {}) {
        return await Http.get(`${this.entity}`, params)
    }
}
