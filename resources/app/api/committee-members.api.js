import BaseApi from "./base.api"

export default class CommitteeMembersApi extends BaseApi {
    static get entity() {
        return 'committee-members'
    }
}
