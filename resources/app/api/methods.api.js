import BaseApi from "./base.api"
import Http from "@services/http";

export default class MethodsApi extends BaseApi {
    static get entity() {
        return 'methods'
    }
}
