import i18n from "../../lang";

const t = () => i18n;

export default [
    {
        path: "/dashboard",
        name: "dashboard",
        component: () => import("@views/Dashboard.vue"),
        meta: {
            requiresAuth: true,
            title: t("sidebar.dashboard"),
        },
    },
    {
        path: "/edit-profile",
        name: "edit-profile",
        component: () => import("@views/user/EditProfile.vue"),
        meta: {
            requiresAuth: true,
            title: "Edit Profile",
            action: "read",
            module: "User",
        },
    },
    {
        path: "/change-password",
        name: "change-password",
        component: () => import("@views/user/ChangePassword.vue"),
        meta: {
            requiresAuth: true,
            title: "Change Password",
        },
    },
    {
        path: "/users",
        name: "users",
        component: () => import("@views/users/UserIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "sidebar.users",
            action: "read",
            module: "User",
            export: false,
            filter: true,
            addNewBtn: {
                status: true,
                title: "pages.add_user",
                name: "/users/create",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                users: {
                    name: "users",
                    title: "sidebar.users",
                },
            },
        },
    },
    {
        path: "/users/create",
        name: "user-create",
        component: () => import("@views/users/UserForm.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_user",
            action: "create",
            module: "User",
            export: false,
            filter: false,
            parent: "users",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                users: {
                    name: "users",
                    title: "sidebar.users",
                },
                addUser: {
                    name: "user-create",
                    title: "pages.add_user",
                },
            },
        },
    },
    {
        path: "/users/edit/:id?",
        name: "user-edit",
        component: () => import("@views/users/UserForm.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.edit_user",
            action: "update",
            module: "User",
            export: false,
            filter: false,
            parent: "users",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                users: {
                    name: "users",
                    title: "sidebar.users",
                },
                editUser: {
                    name: "user-edit",
                    title: "pages.edit_user",
                },
            },
        },
    },
    {
        path: "/users/view/:id?",
        name: "user-show",
        component: () => import("@views/users/UserView.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.user_details",
            action: "update",
            module: "User",
            export: false,
            filter: false,
            parent: "users",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                users: {
                    name: "users",
                    title: "sidebar.users",
                },
                editUser: {
                    name: "user-show",
                    title: "pages.user_details",
                },
            },
        },
    },
    {
        path: "/roles",
        name: "roles",
        component: () => import("@views/roles/RoleIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "sidebar.roles",
            action: "read",
            module: "Role",
            export: false,
            filter: true,
            addNewBtn: {
                status: true,
                title: "pages.add_role",
                name: "/roles/create",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                roles: {
                    name: "roles",
                    title: "sidebar.roles",
                },
            },
        },
    },
    {
        path: "/roles/create",
        name: "role-create",
        component: () => import("@views/roles/RoleForm.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_role",
            action: "create",
            module: "Role",
            export: false,
            filter: false,
            parent: "roles",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                roles: {
                    name: "roles",
                    title: "sidebar.roles",
                },
                addRole: {
                    name: "role-create",
                    title: "pages.add_role",
                },
            },
        },
    },
    {
        path: "/roles/edit/:id?",
        name: "edit-create",
        component: () => import("@views/roles/RoleForm.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.edit_role",
            action: "update",
            module: "Role",
            export: false,
            filter: false,
            parent: "roles",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                roles: {
                    name: "roles",
                    title: "sidebar.roles",
                },
                editRole: {
                    name: "edit-create",
                    title: "pages.edit_role",
                },
            },
        },
    },
    {
        path: "/contestants",
        name: "contestants",
        component: () => import("@views/contestants/ContestantIndex.vue"),
        children:[
            {
                path: ':id/edit',
                component: () => import("@views/contestants/ContestantForm.vue"),
            }
        ],
        meta: {
            requiresAuth: true,
            title: "sidebar.contestants",
            action: "read",
            module: "Contestants",
            export: false,
            filter: true,
            addNewBtn: {
                status: true,
                title: "pages.add_contestant",
                name: "/contestants/create",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                contestants: {
                    name: "contestants",
                    title: "sidebar.contestants",
                },
            },
        },
    },
    {
        path: "/contestants/create",
        name: "contestant-create",
        component: () => import("@views/contestants/ContestantForm.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_contestant",
            action: "create",
            module: "Contestants",
            export: false,
            filter: false,
            parent: "contestants",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                contestants: {
                    name: "contestants",
                    title: "sidebar.contestants",
                },
                addContestant: {
                    name: "contestant-create",
                    title: "pages.add_contestant",
                },
            },
        },
    },
    {
        path: "/contestants/edit/:id?",
        name: "contestant-edit",
        component: () => import("@views/contestants/ContestantForm.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.edit_contestant",
            action: "update",
            module: "Contestant",
            export: false,
            filter: false,
            parent: "contestants",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                users: {
                    name: "contestants",
                    title: "sidebar.contestants",
                },
                editUser: {
                    name: "contestant-edit",
                    title: "pages.edit_contestant",
                },
            },
        },
    },
    {
        path: "/contestants/view/:id?",
        name: "contestant-show",
        component: () => import("@views/contestants/ContestantView.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.contestant_details",
            action: "update",
            module: "Contestants",
            export: true,
            filter: false,
            parent: "contestants",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                contestants: {
                    name: "contestants",
                    title: "sidebar.contestants",
                },
                showContestant: {
                    name: "contestant-show",
                    title: "pages.contestant_details",
                },
            },
        },
    },

    {
        path: "/arbitrators",
        name: "arbitrators",
        component: () => import("@views/arbitrators/ArbitratorIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "sidebar.arbitrators",
            action: "read",
            module: "Arbitrator",
            export: false,
            filter: true,
            addNewBtn: {
                status: true,
                title: "pages.add_arbitrator",
                name: "/arbitrators/create",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                arbitrators: {
                    name: "arbitrators",
                    title: "sidebar.arbitrators",
                },
            },
        },
    },
    {
        path: "/arbitrators/create",
        name: "arbitrator-create",
        component: () => import("@views/arbitrators/ArbitratorForm.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_arbitrator",
            action: "create",
            module: "Arbitrator",
            export: false,
            filter: false,
            parent: "arbitrators",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                arbitrators: {
                    name: "arbitrators",
                    title: "sidebar.arbitrators",
                },
                addArbitrator: {
                    name: "arbitrator-create",
                    title: "pages.add_arbitrator",
                },
            },
        },
    },
    {
        path: "/arbitrators/view/:id?",
        name: "arbitrator-show",
        component: () => import("@views/arbitrators/ArbitratorView.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.arbitrator_details",
            action: "update",
            module: "Arbitrator",
            export: true,
            filter: false,
            parent: "arbitrators",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                arbitrators: {
                    name: "arbitrators",
                    title: "sidebar.arbitrators",
                },
                showArbitrator: {
                    name: "arbitrator-show",
                    title: "pages.arbitrator_details",
                },
            },
        },
    },
    {
        path: "/arbitrators/edit/:id?",
        name: "arbitrator-edit",
        component: () => import("@views/arbitrators/ArbitratorForm.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.edit_arbitrator",
            action: "update",
            module: "Arbitrator",
            export: false,
            filter: false,
            parent: "arbitrators",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                users: {
                    name: "contestants",
                    title: "sidebar.arbitrators",
                },
                editUser: {
                    name: "arbitrator-edit",
                    title: "pages.edit_arbitrator",
                },
            },
        },
    },
    {
        path: "/competitions",
        name: "competitions",
        component: () => import("@views/competitions/CompetitionIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "sidebar.comp_adv",
            action: "read",
            module: "Competitions",
            export: false,
            filter: false,
            addNewBtn: {
                status: false,
                title: "",
                modal: true,
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitions: {
                    name: "competitions",
                    title: "sidebar.comp_adv",
                },
            },
        },
    },
    {
        path: "/competitions/view/:id?",
        name: "competition-show",
        component: () => import("@views/competitions/competitions/CompetitionView.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.competition_details",
            action: "update",
            module: "Competitions",
            export: false,
            filter: false,
            parent: "competitions",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitions: {
                    name: "competitions",
                    title: "sidebar.comp_adv",
                },
                showCompetition: {
                    name: "competition-show",
                    title: "pages.competition_details",
                },
            },
        },
    },
    {
        path: "/competitions/create/:id?",
        name: "competition-create",
        component: () => import("@views/competitions/competitions/competition-forms/CompetitionTabsIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_competition",
            action: "create",
            module: "Competitions",
            export: false,
            filter: false,
            parent: "competitions",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitions: {
                    name: "competitions",
                    title: "sidebar.comp_adv",
                },
                addCompetition: {
                    name: "competition-create",
                    title: "pages.add_competition",
                },
            },
        },
    },
    {
        path: "/competitions/competition-levels/:id",
        name: "competition-levels",
        component: () => import("@views/competitions/competitions/competition-forms/CompetitionTabsIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_competition",
            action: "read",
            module: "Competitions",
            export: false,
            filter: false,
            parent: "competitions",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitions: {
                    name: "competitions",
                    title: "sidebar.comp_adv",
                },
                addCompetition: {
                    name: "competition-levels",
                    title: "pages.add_competition",
                },
            },
        },
    },


    {
        path: "/competitions/competition-stages/:id",
        name: "competition-stages",
        component: () => import("@views/competitions/competitions/competition-forms/CompetitionTabsIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_competition",
            action: "read",
            module: "Competitions",
            export: false,
            filter: false,
            parent: "competitions",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitions: {
                    name: "competitions",
                    title: "sidebar.comp_adv",
                },
                addCompetition: {
                    name: "competition-stages",
                    title: "pages.add_competition",
                },
            },
        },
    },
    {
        path: "/competitions/honoring-ceremony/:id",
        name: "honoring-ceremony",
        component: () => import("@views/competitions/competitions/competition-forms/CompetitionTabsIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_competition",
            action: "read",
            module: "Competitions",
            export: false,
            filter: false,
            parent: "competitions",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitions: {
                    name: "competitions",
                    title: "sidebar.comp_adv",
                },
                addCompetition: {
                    name: "honoring-ceremony",
                    title: "pages.add_competition",
                },
            },
        },
    },
    {
        path: "/competitions/competition-place/:id",
        name: "competition-place",
        component: () => import("@views/competitions/competitions/competition-forms/CompetitionTabsIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_competition",
            action: "read",
            module: "Competitions",
            export: false,
            filter: false,
            parent: "competitions",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitions: {
                    name: "competitions",
                    title: "sidebar.comp_adv",
                },
                addCompetition: {
                    name: "competition-place",
                    title: "pages.add_competition",
                },
            },
        },
    },
    {
        path: "/competitions/advertising-form/:id",
        name: "advertising-form",
        component: () => import("@views/competitions/competitions/competition-forms/CompetitionTabsIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_competition",
            action: "read",
            module: "Competitions",
            export: false,
            filter: false,
            parent: "competitions",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitions: {
                    name: "competitions",
                    title: "sidebar.comp_adv",
                },
                addCompetition: {
                    name: "advertising-form",
                    title: "pages.add_competition",
                },
            },
        },
    },
    {
        path: "/competitions/competition-prizes/:id",
        name: "competition-prizes",
        component: () => import("@views/competitions/competitions/competition-forms/CompetitionTabsIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_competition",
            action: "read",
            module: "Competitions",
            export: false,
            filter: false,
            parent: "competitions",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitions: {
                    name: "competitions",
                    title: "sidebar.comp_adv",
                },
                addCompetition: {
                    name: "competition-prizes",
                    title: "pages.add_competition",
                },
            },
        },
    },
    {
        path: "/competitions/standards-conditions/:id",
        name: "standards-conditions",
        component: () => import("@views/competitions/competitions/competition-forms/CompetitionTabsIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_competition",
            action: "read",
            module: "Competitions",
            export: false,
            filter: false,
            parent: "competitions",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitions: {
                    name: "competitions",
                    title: "sidebar.comp_adv",
                },
                addCompetition: {
                    name: "standards-conditions",
                    title: "pages.add_competition",
                },
            },
        },
    },
    {
        path: "/competitions/arbitration-committees/:id",
        name: "arbitration-committees",
        component: () => import("@views/competitions/competitions/competition-forms/CompetitionTabsIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "pages.add_competition",
            action: "read",
            module: "Competitions",
            export: false,
            filter: false,
            parent: "competitions",
            addNewBtn: {
                status: false,
                name: "",
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitions: {
                    name: "competitions",
                    title: "sidebar.comp_adv",
                },
                addCompetition: {
                    name: "arbitration-committees",
                    title: "pages.add_competition",
                },
            },
        },
    },
    {
        path: "/settings/competition-types",
        name: "competition-types",
        component: () =>
            import(
                "@views/settings/competition-types/CompetitionTypeIndex.vue"
            ),
        meta: {
            requiresAuth: true,
            title: "sidebar.competition_types",
            action: "read",
            module: "CompetitionType",
            parent: "settings",
            export: false,
            filter: true,
            addNewBtn: {
                status: true,
                title: "pages.add_type",
                modal: true,
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                competitionTypes: {
                    name: "competition-types",
                    title: "sidebar.competition_types",
                },
            },
        },
    },
    {
        path: "/settings/contestant-levels",
        name: "contestant-levels",
        component: () => import("@views/settings/contestant-levels/ContestantLevelIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "sidebar.contestants_levels",
            action: "read",
            module: "ContestantLevel",
            parent: "settings",
            export: false,
            filter: true,
            addNewBtn: {
                status: true,
                title: "pages.add_level",
                modal: true,
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                contestantLevels: {
                    name: "contestant-levels",
                    title: "sidebar.contestants_levels",
                },
            },
        },
    },
    {
        path: "/settings/arbitrator-levels",
        name: "arbitrator-levels",
        component: () =>
            import(
                "@views/settings/arbitrator-levels/ArbitratorLevelIndex.vue"
                ),
        meta: {
            requiresAuth: true,
            title: "sidebar.arbitrators_levels",
            action: "read",
            module: "ArbitratorLevel",
            parent: "settings",
            export: false,
            filter: true,
            addNewBtn: {
                status: true,
                title: "pages.add_level",
                modal: true,
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                arbitratorLevels: {
                    name: "arbitrator-levels",
                    title: "sidebar.arbitrators_levels",
                },
            },
        },
    },
    {
        path: "/settings/samples",
        name: "samples",
        component: () =>
            import(
                "@views/settings/samples/SampleIndex.vue"
            ),
        meta: {
            requiresAuth: true,
            title: "sidebar.contract_forms",
            action: "read",
            module: "Sample",
            parent: "settings",
            export: false,
            filter: true,
            addNewBtn: {
                status: true,
                title: "pages.add_contract",
                modal: true,
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                sample: {
                    name: "samples",
                    title: "sidebar.contract_forms",
                },
            },
        },
    },
    {
        path:"/settings/samples/files/store",
        name: 'fileStore'
    },
    {
        path: "/settings/stages",
        name: "stages",
        component: () => import("@views/settings/stages/StageIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "sidebar.competition_stages",
            action: "read",
            module: "Stage",
            parent: "settings",
            export: false,
            filter: true,
            addNewBtn: {
                status: true,
                title: "pages.add_stage",
                modal: true,
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                stages: {
                    name: "stages",
                    title: "sidebar.competition_stages",
                },
            },
        },
    },
    // {
    //     path: "/settings/competition-levels2",
    //     name: "competition-levels2",
    //     component: () =>
    //         import(
    //             "@views/settings/competition-levels/CompetitionLevelIndex.vue"
    //         ),
    //     meta: {
    //         requiresAuth: true,
    //         title: "sidebar.competition_levels",
    //         action: "read",
    //         module: "CompetitionLevel",
    //         parent: "settings",
    //         export: false,
    //         filter: true,
    //         addNewBtn: {
    //             status: true,
    //             title: "pages.add_level",
    //             modal: true,
    //         },
    //         breadcrumb: {
    //             dashboard: {
    //                 name: "dashboard",
    //                 title: "sidebar.dashboard",
    //             },
    //             competitionLevels: {
    //                 name: "competition-levels2",
    //                 title: "sidebar.competition_levels",
    //             },
    //         },
    //     },
    // },
    // {
    //     path: "/settings/arbitration-bands",
    //     name: "arbitration-bands",
    //     component: () =>
    //         import(
    //             "@views/settings/arbitration-bands/ArbitrationBandIndex.vue"
    //         ),
    //     meta: {
    //         requiresAuth: true,
    //         title: "sidebar.arbitration_bands",
    //         action: "read",
    //         module: "ArbitrationBand",
    //         parent: "settings",
    //         export: false,
    //         filter: true,
    //         addNewBtn: {
    //             status: true,
    //             title: "pages.add_arbitration_band",
    //             modal: true,
    //         },
    //         breadcrumb: {
    //             dashboard: {
    //                 name: "dashboard",
    //                 title: "sidebar.dashboard",
    //             },
    //             arbitrationBands: {
    //                 name: "arbitration-bands",
    //                 title: "sidebar.arbitration_bands",
    //             },
    //         },
    //     },
    // },
    // {
    //     path: "/settings/arbitration-types",
    //     name: "arbitration-types",
    //     component: () =>
    //         import(
    //             "@views/settings/arbitration-types/ArbitrationTypeIndex.vue"
    //         ),
    //     meta: {
    //         requiresAuth: true,
    //         title: "sidebar.arbitration_types",
    //         action: "read",
    //         module: "ArbitrationType",
    //         parent: "settings",
    //         export: false,
    //         filter: true,
    //         addNewBtn: {
    //             status: true,
    //             title: "pages.add_arbitration_type",
    //             modal: true,
    //         },
    //         breadcrumb: {
    //             dashboard: {
    //                 name: "dashboard",
    //                 title: "sidebar.dashboard",
    //             },
    //             arbitrationTypes: {
    //                 name: "arbitration-types",
    //                 title: "sidebar.arbitration_types",
    //             },
    //         },
    //     },
    // },

    {
        path: "/settings/places",
        name: "places",
        component: () => import("@views/settings/location/LocationIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "sidebar.places",
            action: "read",
            module: "Country",
            parent: "settings",
            export: false,
            filter: false,
            addNewBtn: {
                status: false,
                title: "",
                modal: true,
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                places: {
                    name: "places",
                    title: "sidebar.places",
                },
            },
        },
    },
    {
        path: "/settings/logs",
        name: "logs",
        component: () => import("@views/settings/logs/LogIndex.vue"),
        meta: {
            requiresAuth: true,
            title: t("sidebar.logs"),
            action: "read",
            module: "ActivityLog",
            parent: "settings",
        },
    },
    {
        path: "/settings/general",
        name: "general_settings",
        component: () => import("@views/settings/general/GeneralSettingsIndex.vue"),
        meta: {
            requiresAuth: true,
            title: "sidebar.general_settings",
            action: "read",
            module: "GeneralSettings",
            parent: "settings",
            export: false,
            filter: false,
            addNewBtn: {
                status: false,
                title: "",
                modal: true,
            },
            breadcrumb: {
                dashboard: {
                    name: "dashboard",
                    title: "sidebar.dashboard",
                },
                generalSettings: {
                    name: "general_settings",
                    title: "sidebar.general_settings",
                },
            },
        },
    },
];
