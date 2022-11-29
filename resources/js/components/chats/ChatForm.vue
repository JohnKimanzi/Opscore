<template>
  <form v-loading="loading" @submit.prevent="sendMessage" method="POST">
    <div class="input-group">
      <div class="col-sm-6">
        <div class="form-group">
          <label class="col-form-label">Recipient</label>
          <select
            name="recipient"
            v-model="recipient"
            class="form-control"
            required
          >
            <option
              :value="recipient.id"
              v-for="(recipient, index) in recipientData"
              :key="index"
            >
              {{ recipient.name }}
            </option>
          </select>
        </div>
      </div>
      <div class="col-sm-12">
        <input
          id="btn-input"
          type="text"
          name="message"
          class="form-control input-sm"
          placeholder="Type your message here..."
          v-model="newMessage"
          @keyup.enter="sendMessage"
        />
      </div>
      <!-- <input
        type="hidden"
        name="user_id"
        class="form-control"
        v-model="user_id"
      /> -->
      <span class="input-group-btn">
        <button
          class="btn btn-success submit-btn col-12"
          type="submit"
          @click="sendMessage"
        >
          Send
        </button>
      </span>
    </div>
  </form>
</template>
<script>
export default {
  //Takes the "user" props from <chat-form> … :user="{{ Auth::user() }}"></chat-form> in the parent chat.blade.php.
  // props: ["user_id"],
  props: {
    recipients: Array,
  },
  data() {
    return {
      recipientData: this.recipients,
      newMessage: "",
      // user_id: [],
      recipient: [],
      loading: false,
    };
  },
  methods: {
    sendMessage() {
      event.preventDefault();
      this.loading = true;
      //Emit a "messagesent" event including the user who sent the message along with the message content
      //   this.$emit("messagesent", {
      const config = {
        headers: {},
      };
      const formData = new FormData();

      formData.append("message", this.newMessage);
      // formData.append("user_id", this.user_id);
      formData.append("recipient", this.recipient);

      axios.post("messages", formData, config).then((response) => {
        this.loading = false;
        if (response.data.status) {
          this.$message.success(response.data.message);
        } else {
          this.$message.error(response.data.message);
        }
      });
    },
  },
};
</script>
