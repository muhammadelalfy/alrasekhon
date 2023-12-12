import BaseApi from "./base.api"
import Http from "@services/http";

export default class JuzApi extends BaseApi {
    static get entity() {
        return 'juz'
    }

}
