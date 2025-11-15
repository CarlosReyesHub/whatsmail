export const errorHandlerMixin = {
    methods: {
        $handleErrorResponse(error) {
            if (error.response != undefined) {
                if (
                    error.response.status == 419 ||
                    error.response.status == 422 ||
                    error.response.status == 401 ||
                    error.response.status == 409
                ) {
                    this.$showToast(error.response.data.message, "error", 3000);
                   
                } else if (error.response.status == 404) {
                    this.$showToast(error.response.data.message, "error", 3000);
                } else if (error.response.status == 403) {
                    this.$showToast(error.response.data.message, "error", 3000);
                } else {
                    this.$showToast(
                        "A system error occurred, check your WhatsApp and internet connection.",
                        "error",
                        3000
                    );
                }
            } else {
                this.$showToast(
                    "A system error occurred, check your WhatsApp and internet connection.",
                    "error",
                    3000
                );
            }
        },
        $handleSuccessResponse(message) {
            this.$showToast(
                "A system error occurred, check your WhatsApp and internet connection.",
                "error",
                3000
            );
        },
    },
};
