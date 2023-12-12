import BaseApi from "./base.api"
import Http from "@services/http";

export default class ArbitratorsApi extends BaseApi {
    static get entity() {
        return 'arbitrators'
    }

    static async upload(model) {
        return await Http.post(`${this.entity}/upload`, model)
    }

    static async addWorkExperience(model) {
        return await Http.post(`${this.entity}/add-work-experience/${model.arbitrator_id}`, model)
    }

    static async deleteWorkExperience(data = {}) {
        return await Http.post(`${this.entity}/delete-work-experience/${data.arbitrator}`, data)
    }

    static async addReading(model) {
        return await Http.post(`${this.entity}/add-reading/${model.arbitrator_id}`, model)
    }

    static async deleteReading(model) {
        return await Http.post(`${this.entity}/delete-reading/${model.arbitrator_id}`, model)
    }
}
