
<script>
  export default {
    mounted() {
        console.log('Component mounted.')
    },

    methods: {
      test(id) {
        axios.delete('/bookmark/'+ id);

        $('#bookmark-'+id).fadeOut(300);
      }
    }

  }
</script>
