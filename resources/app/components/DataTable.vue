<template>
    <table
        :id="id"
        class="table-data dt-responsive table w-100 table-borderless"
    >
        <slot></slot>
    </table>
</template>

<script>
import "datatables.net-bs5";
import "datatables.net-responsive-bs5";
import "jszip";
// import pdfMake from "pdfmake";
// npm i --save-dev @types/pdfmake
import pdfMake from "pdfmake/build/pdfmake";
// import pdfFonts from "pdfmake/build/vfs_fonts";
import * as pdfFonts from 'pdfmake/build/vfs_fonts';
import "datatables.net-buttons-bs5";
import "datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css";
import "datatables.net-buttons/js/buttons.colVis";
import "datatables.net-buttons/js/buttons.flash";
import "datatables.net-buttons/js/buttons.html5";
import "datatables.net-buttons/js/buttons.print";
import "datatables.net/js/jquery.dataTables.min.js";
import "datatables.net-bs5/js/dataTables.bootstrap5.min.js";
import "datatables.net-bs5/css/dataTables.bootstrap5.min.css";
import "datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css";
import "datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js";
pdfMake.vfs = pdfFonts.pdfMake.vfs;


import tableConfig from "@/mixins/tableConfig.vue";

export default {
    name: "DataTable",
    mixins: [tableConfig],
    props: {
        id: {
            type: String,
            default: "main-table",
        },
    },
    mounted() {
        var table = $('#example').DataTable(this.dataTableConfig);
        $(`#${this.id}`).DataTable(this.dataTableConfig);
        $('[data-bs-toggle="tooltip"]').tooltip({
            trigger: "hover",
        });
        $('[data-bs-toggle="tooltip"]').on("click", function () {
            $(this).tooltip("hide");
        });
        // Add event listener for opening and closing details for tooltip trigger
        $(".table-data tbody").on("click", "td.dtr-control", function () {
            var tr = $(this).closest("tr");
            var row = table.row(tr);

            if (!row.child.isShown()) {
                $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger: "hover",
                });
            }
        });
    },
};
</script>

<style lang="scss">
table {
    &.dataTable {
        margin-bottom: 15px !important;
    }
}
</style>
