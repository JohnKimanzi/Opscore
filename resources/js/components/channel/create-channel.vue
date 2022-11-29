<template>
    <div class="card">
        <div class="row card-body">
            <div class="col-lg-12">
                <form
                    v-loading="loading"
                    @submit.prevent="createChannel"
                    method="POST"
                >
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label"
                                    >Name<span class="text-danger"
                                        >*</span
                                    ></label
                                >
                                <input
                                    v-model="name"
                                    class="form-control"
                                    required
                                    name="name"
                                    autocomplete="name"
                                    type="text"
                                    autofocus
                                    id="name"
                                />
                            </div>
                        </div>
                          <div class="col-12">
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button
                                        @click="createChannel"
                                        class="
                                            btn btn-success
                                            submit-btn
                                            col-12"
                                        type="submit"
                                    >
                                        Create Channel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "create-channel",
    data() {
        return {
            loading: false,
            channelData: this.channels,
            name: null,
            body: null,
        };
    },
    methods: {
        createChannel() {
            event.preventDefault();
            this.loading = true;
            const config = {
                headers: {},
            };
            const formData = new FormData();

            formData.append("name", this.name);
                axios.post("/channels", formData, config).then((resp) => {
            this.loading = false;
            if (resp.data.status) {
              this.$message.success(resp.data.message);

              setTimeout(function () {
                window.location.href = "/channels";
              }, 1000);
            } else {
              this.$message.error(resp.data.message);
            }
          });
        },
    },
};
</script>
