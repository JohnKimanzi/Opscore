<template>
    <div class="card">
        <div class="row card-subscribable_id">
            <div class="col-lg-12">
                <form
                    v-loading="loading"
                    @submit.prevent="createSubscribe"
                    method="POST"
                >
                    <div class="row">
                         <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label"
                                    >Sub Type</label
                                >
                                <select
                                    v-model="subscription"
                                    class="form-control"
                                    required
                                    name="subscribable_type"
                                >
                                    <option
                                        :value="subscription.id"
                                        v-for="(subscription, index) in subscriptionData"
                                        :key="index"
                                    >
                                        {{ subscription.subscribable_type }}
                                    </option>
                                </select>
                            </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label"
                                    >Sub Name</label
                                >
                                <select
                                    v-model="subscription"
                                    class="form-control"
                                    required
                                    name="subscribable_id"
                                >
                                    <option
                                        :value="subscription.id"
                                        v-for="(subscription, index) in subscriptionData"
                                        :key="index"
                                    >
                                        {{ subscription.subscribable_id }}
                                    </option>
                                </select>
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
                                        @click="createSubscribe"
                                        class="
                                            btn btn-success
                                            submit-btn
                                            col-12"
                                        type="submit"
                                    >
                                        Add Subscription
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
    name: "create-subscribe",
    props: {
        subscriptions: Array,
        channels: Array,
    },
    data() {
        return {
            loading: false,
            channelData: this.channels,
            subscriptionData: this.subscriptions,
        };
    },
    methods: {
        createSubscribe() {
            event.preventDefault();
            this.loading = true;
            const config = {
                headers: {},
            };
            const formData = new FormData();

            formData.append("subscribable_type", this.subscription);
            formData.append("subscribable_id", this.subscription);
            formData.append("channel_id", this.channel);
                axios.post("/subscriptions", formData, config).then((resp) => {
            this.loading = false;
            if (resp.data.status) {
              this.$message.success(resp.data.message);

              setTimeout(function () {
                window.location.href = "/subscriptions";
              }, 1000);
            } else {
              this.$message.error(resp.data.message);
            }
          });
        },
    },
};
</script>
