<template>
  <div class="row justify-space-between">
      <div>
          Plan: {{plan.name}}
      </div>
      <div>
          SMS Credits: {{plan.smsCredit | truncateThousand}}
      </div>
      <div>
          Email Credits: {{plan.emailCredit | truncateThousand}}
      </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {}
    },
    methods: {},
    computed: {
        plan(){
            return this.$store.state.user.plan
        }
    }
  }

</script>
