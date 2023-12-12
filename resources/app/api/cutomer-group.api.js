import BaseApi from "./base.api"

export default class CustomerGroupApi extends BaseApi {
    static get entity() {
        return 'customer-groups'
    }
}
