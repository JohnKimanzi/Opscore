<template>
    <div class="card">
        <div class="row card-body">
            <div class="col-lg-12">
                <form
                    v-loading="loading"
                    @submit.prevent="createAnnounce"
                    method="POST"
                >
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label"
                                    >Title<span class="text-danger"
                                        >*</span
                                    ></label
                                >
                                <input
                                    v-model="title"
                                    class="form-control"
                                    required
                                    name="title"
                                    autocomplete="title"
                                    type="text"
                                    autofocus
                                    id="title"
                                />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label"
                                    >Body<span class="text-danger"
                                        >*</span
                                    ></label
                                >
                                <input
                                    v-model="body"
                                    class="form-control"
                                    required
                                    name="body"
                                    autocomplete="body"
                                    type="text"
                                    autofocus
                                    id="body"
                                />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label"
                                    >Channel Name</label
                                >
                                <select
                                    v-model="channel"
                                    class="form-control"
                                    required
                                    name="channel_id"
                                >
                                    <option
                                        :value="channel.id"
                                        v-for="(channel, index) in channelData"
                                        :key="index"
                                    >
                                        {{ channel.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button
                                        @click="createAnnounce"
                                        class="
                                            btn btn-success
                                            submit-btn
                                            col-12"
                                        type="submit"
                                    >
                                        Create Announcement
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
    name: "create-announce",
    props: {
        channels: Array,
    },
    data() {
        return {
            loading: false,
            channelData: this.channels,
            title: null,
            body: null,
        };
    },
    methods: {
        createAnnounce() {
            event.preventDefault();
            this.loading = true;
            const config = {
                headers: {},
            };
            const formData = new FormData();

            formData.append("title", this.title);
            formData.append("body", this.body);
            formData.append("channel_id", this.channel);
                axios.post("/announcements", formData, config).then((resp) => {
            this.loading = false;
            if (resp.data.status) {
              this.$message.success(resp.data.message);

              setTimeout(function () {
                window.location.href = "/announcements";
              }, 1000);
            } else {
              this.$message.error(resp.data.message);
            }
          });
        },
    },
};
</script>
