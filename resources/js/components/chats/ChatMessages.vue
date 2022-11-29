<template>
  <ul class="chat">
    <li class="left clearfix" v-for="message in messages" :key="message.id">
      <div class="clearfix">
        <p>
           <strong><a href="">{{ message.user.name }} </a>: </strong> {{ message.message }}
        </p>
      </div>
    </li>
  </ul>
</template>
<script>
export default {
  props: ["messages"],
};
</script>
