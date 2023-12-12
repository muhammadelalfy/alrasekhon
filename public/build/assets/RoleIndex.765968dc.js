import{$ as T}from"./jquery.f931fcee.js";import{u as w}from"./vue-toastification.f8d70964.js";import{R as b}from"./role.api.5a5c0e9b.js";import"./vue.7bf2bcd0.js";import{_ as F}from"./app.ca0dd7db.js";import{a5 as n,o as s,c as p,a as e,X as i,R as l,Q as u,U as a,F as g,W as m,a8 as y}from"./@vue.ab32a142.js";import"./axios.04e16fa0.js";import"./lodash.4aca12d0.js";import"./vue-router.2be6d445.js";import"./js-cookie.31874410.js";import"./pinia.a7a730fe.js";import"./nprogress.e46cbde5.js";import"./element-plus.f4fb2d76.js";import"./lodash-es.2e433212.js";import"./@vueuse.4ac49989.js";import"./@element-plus.6e503c7c.js";import"./@ctrl.82a509e0.js";import"./dayjs.d96dc93a.js";import"./async-validator.1c690774.js";import"./memoize-one.4ee5c96d.js";import"./escape-html.e5dfadb9.js";import"./normalize-wheel-es.8aeb3683.js";import"./@floating-ui.eae1f4bb.js";import"./vue-i18n.0ab86f4b.js";import"./@intlify.20ef3030.js";import"./js-base64.79f56a98.js";import"./pinia-plugin-persistedstate.f4ca662e.js";import"./vue-sweetalert2.891f877f.js";import"./@fortawesome.c9809c2b.js";import"./datatables.net-bs5.e18c8d11.js";import"./datatables.net.c69c83a2.js";import"./datatables.net-responsive-bs5.449cdb0d.js";import"./datatables.net-responsive.2a10a1b3.js";import"./jszip.2c79a5b0.js";import"./pdfmake.45c49c34.js";import"./datatables.net-buttons-bs5.1ab1a926.js";import"./datatables.net-buttons.5f6c1075.js";import"./@vueup.fdb4c0f7.js";import"./quill.2b7d1cee.js";import"./quill-delta.565c40c2.js";import"./fast-diff.40237be0.js";import"./lodash.clonedeep.14434a6c.js";import"./lodash.isequal.30baf809.js";const I={name:"role-index",components:{},data(){return{statusAction:{status:!1},roles:[],role:{},filters:{page:1,embed:"permissions"},permissions:[],pagination:{}}},created(){this.getRoles()},methods:{getRoles(t=1){this.filters.page=t,b.list(this.filters).then(({data:r})=>{this.roles=r.data,this.pagination=r.meta}).catch(r=>{console.log(r)})},delRole(t,r){b.delete(t).then(f=>{this.roles.splice(r,1),w().success(f.data.message)})},viewPermissions(t){this.permissions=t,T("#viewPermissions").modal("show")},toggle(t={}){b.changeStatus(t).then(r=>{w().success(r.data.message)})}}},N={id:"formFilter",class:"collapse multi-collapse"},V=e("th",null,"#",-1),q={class:"btn-list d-inline-flex"},A={class:"badge bg-success m-1"};function M(t,r,f,L,d,c){const R=n("filters"),k=n("card"),P=n("form-switcher"),h=n("font-awesome-icon"),_=n("router-link"),$=n("delete-button"),C=n("DataTable"),E=n("modal"),x=n("spinner"),B=n("pagination"),S=n("Card");return s(),p(g,null,[e("div",N,[i(k,null,{body:l(()=>[i(R,{model:d.filters,onSubmit:c.getRoles},null,8,["model","onSubmit"])]),_:1})]),d.roles.length?(s(),u(S,{key:0,class:"pt-3"},{default:l(()=>[i(C,{id:"new-edit"},{default:l(()=>[e("thead",null,[e("tr",null,[V,e("th",null,m(t.$t("pages.role")),1),e("th",null,m(t.$t("pages.status")),1),e("th",null,m(t.$t("global.actions")),1)])]),e("tbody",null,[(s(!0),p(g,null,y(d.roles,(o,v)=>(s(),p("tr",{key:o.id},[e("td",null,m(v+1),1),e("td",null,m(o.name),1),e("td",null,[i(P,{id:"status",model:o,name:"status",errors:t.formErrors,onClearErrors:t.clearInput,onToggle:D=>c.toggle(o)},null,8,["model","errors","onClearErrors","onToggle"])]),e("td",null,[e("div",q,[a(` <button\r
                                    type="button"\r
                                    class="btn btn-light-babyblue text-white me-1"\r
                                    data-bs-toggle="tooltip"\r
                                    data-bs-placement="top"\r
                                    :title="$t('forms.view')"\r
                                    @click="\r
                                        viewPermissions(role.permissions_names)\r
                                    "\r
                                >\r
                                    <font-awesome-icon icon="fa-solid fa-eye" />\r
                                </button> `),i(_,{to:`/roles/edit/${o.id}`,class:"btn btn-light-babyblue text-white me-1","data-bs-toggle":"tooltip","data-bs-placement":"top",title:t.$t("forms.view")},{default:l(()=>[i(h,{icon:"fa-solid fa-eye"})]),_:2},1032,["to","title"]),t.hasPermission("update","Role")?(s(),u(_,{key:0,to:`/roles/edit/${o.id}`,id:"bEdit",class:"btn btn-light-secondary text-white me-1","data-bs-toggle":"tooltip","data-bs-placement":"top",title:t.$t("forms.edit")},{default:l(()=>[i(h,{icon:"fa-solid fa-pen-to-square"})]),_:2},1032,["to","title"])):a("v-if",!0),t.hasPermission("delete","Role")?(s(),u($,{key:1,onDelModel:D=>c.delRole(o,v)},null,8,["onDelModel"])):a("v-if",!0)])])]))),128))])]),_:1}),i(E,{showButton:!1,title:"pages.permissions",id:"viewPermissions"},{body:l(()=>[(s(!0),p(g,null,y(d.permissions,o=>(s(),p("span",A,m(o),1))),256))]),_:1}),this.$store.loaderStore.loading?(s(),u(x,{key:0})):a("v-if",!0),i(B,{pagination:d.pagination,onPaginate:c.getRoles},null,8,["pagination","onPaginate"])]),_:1})):a("v-if",!0),a(` <div class="row">\r
        <div class="col-lg-12">\r
            <div class="card custom-card">\r
                <div class="card-header rounded-bottom-0 my-3">\r
                    <div class="card-body">\r
                        <filters @submit="getRoles" :model="filters"></filters>\r
                        <div class="table-responsive">\r
                            <table\r
                                class="table table-bordered border text-nowrap mb-0"\r
                                id="new-edit"\r
                                v-if="roles.length"\r
                            >\r
                                <thead>\r
                                    <tr>\r
                                        <th>{{ $t("global.name") }}</th>\r
                                        <th>{{ $t("pages.permissions") }}</th>\r
                                        <th name="bstable-actions">\r
                                            {{ $t("global.actions") }}\r
                                        </th>\r
                                    </tr>\r
                                </thead>\r
                                <tbody>\r
                                    <tr\r
                                        v-for="(role, index) in roles"\r
                                        :key="role.id"\r
                                    >\r
                                        <td>{{ role.name }}</td>\r
                                        <td>\r
                                            <button\r
                                                class="btn btn-sm btn-babyblue text-white"\r
                                                @click="\r
                                                    viewPermissions(\r
                                                        role.permissions_names\r
                                                    )\r
                                                "\r
                                            >\r
                                                <i class="fa fa-eye"></i>\r
                                            </button>\r
                                        </td>\r
                                        <td name="bstable-actions">\r
                                            <div class="btn-list">\r
                                                <router-link\r
                                                    v-if="\r
                                                        hasPermission(\r
                                                            'update',\r
                                                            'Role'\r
                                                        )\r
                                                    "\r
                                                    :to="\`/roles/edit/\${role.id}\`"\r
                                                    id="bEdit"\r
                                                    type="button"\r
                                                    class="btn btn-sm btn-babyblue text-white m-1"\r
                                                >\r
                                                    <span\r
                                                        class="fa fa-edit"\r
                                                    ></span>\r
                                                </router-link>\r
                                                <delete-button\r
                                                    v-if="\r
                                                        hasPermission(\r
                                                            'delete',\r
                                                            'Role'\r
                                                        )\r
                                                    "\r
                                                    @del-model="\r
                                                        delRole(role, index)\r
                                                    "\r
                                                />\r
                                            </div>\r
                                        </td>\r
                                    </tr>\r
                                </tbody>\r
                            </table>\r
                        </div>\r
                        <modal\r
                            :showButton="false"\r
                            title="pages.permissions"\r
                            id="viewPermissions"\r
                        >\r
                            <template v-slot:body>\r
                                <span\r
                                    v-for="permission in permissions"\r
                                    class="badge bg-success m-1"\r
                                >\r
                                    {{ permission }}\r
                                </span>\r
                            </template>\r
                        </modal>\r
                        <spinner\r
                            v-if="this.$store.loaderStore.loading"\r
                        ></spinner>\r
                        <pagination\r
                            :pagination="pagination"\r
                            @paginate="getRoles"\r
                        />\r
                    </div>\r
                </div>\r
            </div>\r
        </div>\r
    </div> `)],64)}const St=F(I,[["render",M],["__file","E:/Roqay/Rasekhon/rasekhon/resources/app/views/roles/RoleIndex.vue"]]);export{St as default};
