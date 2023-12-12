import BaseApi from "./base.api"
import Http from "@services/http";

export default class CompetitionsApi extends BaseApi {
    static get entity() {
        return 'competitions'
    }

    static async addUpdatePlace(model) {
        return await Http.post(`${this.entity}/add-update-place/${model.id}`, model)
    }

    static async addUpdateStages(model) {
        return await Http.post(`${this.entity}/add-update-stages/${model.id}`, model)
    }


    static async addUpdateCondition(model) {
        return await Http.post(`${this.entity}/add-update-condition/${model.id}`, model)
    }

    static async addUpdateAdvertisement(model) {
        return await Http.post(`${this.entity}/add-update-advertisement/${model.id}`, model)
    }

    static async addUpdateConcertHonoring(params={}) {
        let competition_id = params.competition_id
        return await Http.post(`${this.entity}/add-update-concert-honoring/${competition_id}`, params)

    }

    static async addUpdatePrizes(model) {
        return await Http.post(`${this.entity}/add-update-prizes/${model.competition_id}`, model)
    }
    static async updateCompetitionLevel(params={}) {
        let competition_id = params.competition_id
        return await Http.post(`${this.entity}/update-competition-level/${competition_id}`, params)
    }
}
