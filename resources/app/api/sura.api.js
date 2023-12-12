import BaseApi from "./base.api"
import Http from "@services/http";

export default class SuraApi extends BaseApi {
    static get entity() {
        return 'sura'
    }

}
