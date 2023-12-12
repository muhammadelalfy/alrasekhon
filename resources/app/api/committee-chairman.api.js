import BaseApi from "./base.api"

export default class CommitteeChairmanApi extends BaseApi {
    static get entity() {
        return 'committee-chairman'
    }
}
