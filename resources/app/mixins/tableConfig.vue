<!-- eslint-disable no-undef -->
<script>
export default {
    name: "TableConfig",
    data: function () {
        return {
            dataTableConfig: {
                ordering: false,
                order: [],
                language: {
                    searchPlaceholder: this.$t("global.search"),
                    search: "",
                    zeroRecords: this.$t("datatable.zeroRecords"),
                    info: this.$t("datatable.info"),
                    infoEmpty: this.$t("datatable.infoEmpty"),
                    // lengthMenu: this.$t("datatable.lengthMenu"),
                    paginate: {
                        first: this.$t("pagination.first"),
                        last: this.$t("pagination.last"),
                        next: this.$t("pagination.next"),
                        previous: this.$t("pagination.prev"),
                    },
                    buttons: {
                        pageLength: this.$t("datatable.lengthMenu"),
                    },
                },
                dom: '<"px-3 mb-3"<B>>rtip',
                buttons: [
                    { extend: "copy", text: this.$t("datatable.copy") },
                    { extend: "csv" },
                    { extend: "pdf" },
                    {
                        extend: "print",
                        text: this.$t("datatable.print"),
                        key: {
                            key: "p",
                        },
                    },
                    {
                        extend: "colvis",
                        text: this.$t("datatable.colvis"),
                    },
                    // "pageLength",
                ],
                lengthChange: false,
                searching: false,
                paging: false,
                info: false,
                // lengthMenu: [
                //   [10, 25, 50, -1],
                //   [
                //     this.$t("datatable.rows10"),
                //     this.$t("datatable.rows25"),
                //     this.$t("datatable.rows50"),
                //     this.$t("datatable.rowsAll"),
                //   ],
                // ],
            },
        };
    },
};
</script>
