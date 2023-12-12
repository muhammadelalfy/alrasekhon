export default {
    data: function () {
        return {
            submitFormDisabled: false,
            formErrors: {}
        }
    },

    methods: {
        clearInput(fieldName) {
            delete this.formErrors[fieldName];
            this.submitFormDisabled = Object.keys(this.formErrors).length > 0;
        },
        clearErrors() {
            this.formErrors = [];
            this.submitFormDisabled = false;
        },

        resetForm(data) {
            Object.keys(data).forEach(function (key) {
                if (typeof data[key] === 'object') {
                    let nestedObject = data[key]
                    Object.keys(nestedObject).forEach(function (nestedKeys) {
                        nestedObject[nestedKeys] = '';
                    });
                } else {
                    data[key] = '';
                }
            });
        },
        fillForm(data, model) {
            Object.keys(data).forEach(function (key) {
                data[key] = model[key];
            });
        },
        //do After add (for bootstrap modal)
        afterModalAddActions(form, grid, data) {
            this.resetForm(form);
            this.addToGrid(grid, data)
        },
        addToGrid(grid, data) {
            let length = grid.length
            if (length >= 10)
            {
                grid.splice(19, 1);
            }
            if (data.length > 1) {
                for (let i = 0; i < data.length; i++) {
                    grid.unshift(data[i])
                }
            } else if(data.length === 1) {
                grid.unshift(data[0])
            }
            else {
                grid.unshift(data)
            }

        },
        //do After add (for bootstrap modal)
        afterModalUpdateActions(form, grid, data, id) {

            this.updateGrid(grid, data, id)
            this.resetForm(form);
        },
        updateGrid(grid, data, id) {
            let objIndex = grid.findIndex((obj => obj.id === id));
            grid[objIndex] = data;
        },
        confirmBox(message = '', confirmBtn = '') {
            return this.$swal.fire({
                customClass: {
                    confirmButton: 'btn btn-success m-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                title: 'Are you sure?',
                text: message + " !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: confirmBtn + '!',
                cancelButtonText: 'No!',
                reverseButtons: true
            })
        }
    }
}
